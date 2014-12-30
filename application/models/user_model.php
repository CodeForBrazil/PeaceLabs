<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

/**
 * User model.
 */
class User_model extends MY_Model
{

  /**
   * Table name.
   */
  const TABLE_NAME = 'user';
  const ACTIVITY_TABLE_NAME = 'activity';

  // Roles
  const ROLE_DEFAULT = 0;
  const ROLE_ADMIN = 1;

  // Status
  const STATUS_DISABLE = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_WAITING = 2;
  const STATUS_NO_ACCOUNT = 3;
  
  // Other
  const NO_NAME = "----";

  // Table fields
  public $id;
  public $email;
  public $name = NULL;
  public $password = NULL;
  public $avatar;
  public $alias;
  public $bio;
  public $city;
  public $roles = self::ROLE_DEFAULT;
  public $confirmation;
  public $dateadd = 0;
  public $dateupdate = 0;
  public $status = self::STATUS_ACTIVE;
  public $creator_id = NULL;
  public $user_id = NULL;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }

  /**
   * A fake user is a user that has been created by another user to be added to an activity. 
   * This user isn't a registered Lets user
   * @return boolean
   */
  public function is_fake() {
  	return !is_null($this->creator_id);
  }
  
  
  /**
   * Return a string with user denomination
   * @return string
   */
  public function get_name() {
    $name = trim($this->name);
    empty($name) and $name = $this->alias;
	empty($name) and $name = self::NO_NAME;
    return $name;
  }
  
  /**
   * Returns user url
   */
  public function get_url() {
  	return site_url("user/view/".$this->id);
  }
  
  /**
   * Returns user avatar media model
   */
  public function get_avatar($style=NULL) {
  	if (!is_null($this->avatar)) {
  		$this->load->model('Media_model');
		$avatar = $this->Media_model->get_by_id($this->avatar);
		if ($path = $avatar->get_path($style))
			return $path;
  	}
	
	return ($this->is_fake())?DEFAULT_AVATAR_FAKE:DEFAULT_AVATAR;
  }
  
  /**
   * Returns all activities
   */
  public function get_activities() {
  	if (isset($this->id)) {
	  	$this->load->model('Activity_model');
		return $this->Activity_model->get_by_owner($this->id);
  	}
	return false;
  }
  
  /**
   * Checks if user is within a specific role.
   *
   * @param int $role 
   * @return boolean
   */
  public function is($role)
  {
    return $role & $this->roles;
  }
  
  /**
   * Create a fake user
   */
  public function create_fake($name,$creator_id) {
	$user = new User_model(array(
		'name' => $name,
		'creator_id' => $creator_id,
	));
	$user->insert();
	return $user;
  }
  
  /** 
   * Create a new user
   */
  public function create_user($name,$creator_id) {
  	if ( empty($this->email) || 
  		 empty($this->password) ) 
  		return false;

	$this->set_alias(FALSE);

	return $this->insert();
  }
   
  /**
   * Inserts the current user on database.
   *
   * @return boolean
   */
  public function insert()
  {
  	if ( empty($this->email) && empty($this->creator_id) ) 
  		return false;

	$this->dateadd = gmdate("Y-m-d H:i:s");
	$this->dateupdate = gmdate("Y-m-d H:i:s");

	$res = parent::insert();
	
	return $res;
  }

  /**
   * Updates the current user to database.
   *
   * @return boolean
   */
  public function update()
  {
  	if ( empty($this->email) && empty($this->creator_id) ) 
  		return false;

	$this->dateupdate = gmdate("Y-m-d H:i:s");

	$res = parent::update();

	return $res;
  }

  /**
   * Gets all users.
   *
   * @return array
   */
  public function get_all()
  {
    $query = $this->db->get(self::TABLE_NAME);
	return $this->get_self_results($query);
  }
  
  /**
   * Gets all active users (excluding fakes)
   */
  public function get_all_active()
  {
  	$this->db->where('creator_id IS NULL')
		->select(self::TABLE_NAME.'.*')
  		->join(self::ACTIVITY_TABLE_NAME, self::ACTIVITY_TABLE_NAME.'.owner = '.self::TABLE_NAME.'.id','left outer')
		->group_by(self::TABLE_NAME.'.id')
  		->order_by('count('.self::ACTIVITY_TABLE_NAME.'.id)=0, rand()');
	return $this->get_all();
  }

  /**
   * Gets an user by its e-mail.
   *
   * @param string $email 
   * @return User_model|null
   */
  public function get_by_email($email)
  {
    $query = $this->db->get_where(self::TABLE_NAME, array('email' => $email));
    return $this->get_first_self_result($query);
  }

  /**
   * Gets an user by its alias.
   *
   * @param string $alias 
   * @return User_model|null
   */
  public function get_by_alias($alias)
  {
    $query = $this->db->get_where(self::TABLE_NAME, array('alias' => $alias));
    return $this->get_first_self_result($query);
  }

  /**
   * Encrypts the given password using database ENCODE function.
   *
   * @param string $password 
   * @return string
   */
  public function encrypt_password($password)
  {
    $sql = "SELECT ENCODE(?, ?) AS `password`";
    $query = $this->db->query($sql, array($password, ENCODE_CODE_WORD));
    return $query->num_rows() > 0 ? $query->row()->password : null;
  }
  
  /**
   * reset user password
   *
   * @return string
   */
  public function reset_password() {
  	if (!isset($this->id)) return false;
	
  	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr(str_shuffle($chars),0,8);
  
  	log_message('info',"Password changed: $password");
  
  	$this->password = $this->encrypt_password($password);
	$this->update();
  	
  	return $password; 
  }

  /**
   * Set user confirmation code
   * 
   * @return string
   */
  public function set_confirmation() {
  	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $confirmation = substr(str_shuffle($chars),0,24);
	
	$this->confirmation = $confirmation;
	$this->status = self::STATUS_WAITING;

	return $confirmation;
  }
  
  /**
   * Check if confirmation is OK
   * 
   * @return user
   */
  public function check_confirmation($confirmation) {
  	if (empty($confirmation)) return false;
    $query = $this->db->get_where(self::TABLE_NAME, array('confirmation' => $confirmation));
    if ($query->num_rows() > 0) {
    	$user = $this->get_first_self_result($query);
    	$user->confirmation = NULL;
		$user->status = self::STATUS_ACTIVE;
		$user->update();
		return $user;
    } else {
        return false;
    }
  }
  
  /**
   * Add a new avatar image to user profile
   */
  public function add_avatar($path) {
  	$this->load->model('Media_model');
	
	// removing old avatar
	if (!is_null($this->avatar)) {
		$media_old = $this->Media_model->get_by_id($this->avatar);
		if ($media_old) $media_old->delete();
	}	
	
	//saving new avatar
	$media = new Media_model();
	if ($media->insert($path)) {
		$this->avatar = $media->id;
		return $this->update();
	} else {
		return false;
	}
	
  }
  
  /**
   * Search users from string
   * @param $key string to search
   * @return array of user values ('id' => user_id, 'text' => text responding to $key)
   */
  public function search_user($key,$user = FALSE) {
  	
	$extra = ($user)?" OR creator_id = ".$user->id:'';
  	$where = "(name LIKE '%$key%' OR email LIKE '%$key%') AND (creator_id IS NULL$extra)";
  	
	$query = $this->db->where($where)->get(self::TABLE_NAME);
	
	$users = $this->get_self_results($query);
	
	$res = array();
	foreach ($users as $user) {
		if (stripos($user->name,$key) !== FALSE)
			$res[$user->id] = array('id' => $user->id, 'text' => $user->name);
		else {
			if (stripos($user->email,$key) !== FALSE)
				$res[$user->id] = array('id' => $user->id, 'text' => $user->email);
		}
	}
	
  	return array_values($res);
  }
   
  /**
   * Format object name into url alias
   * THIS FUNCTION SAVES THE NEW ALIAS IF ALIAS WAS EMPTY
   * 
   * @return string
   */
	protected function set_alias($save = TRUE) {
		$alias = $this->alias;
		if (empty($alias)) {
			$max = 30;
			$table = array(
		        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
		        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
		        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
		        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
		        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
		        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
		        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
		        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
		    );
			$base = substr(preg_replace("/[^a-zA-Z0-9]+/", "_", strtr($this->get_name(), $table)),0,$max);
			$i = 1;
			$query = $this->db->get_where(self::TABLE_NAME,array('alias' => $base));
			while ($query->num_rows() > 0) {
				$alias = $base.'_'.$i++;
				$query = $this->db->get_where(self::TABLE_NAME,array('alias' => $alias));
			}
			$this->alias = $alias;
			if ($save) $this->update();
		}
		return $alias;	
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */