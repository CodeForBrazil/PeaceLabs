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

  // Roles
  const ROLE_DEFAULT = 0;
  const ROLE_ADMIN = 1;

  // Status
  const STATUS_DISABLE = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_WAITING = 2;

  // Table fields
  public $id;
  public $email;
  public $name = NULL;
  public $password = NULL;
  public $role = self::ROLE_DEFAULT;
  public $confirmation;
  public $dateadd = 0;
  public $dateupdate = 0;
  public $status = self::STATUS_ACTIVE;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
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
   * Create a new identity or link it to user if exists
   */
  protected function match_identity() {
/*  	$this->load->model('User_identity_model');
	$res = $this->User_identity_model->match($value,$type,$user_id);
	if (!$res) {
		$this->load->helper('email');
		admin_report("Problem matching identity $value","Data given: value = $value, type = $type, user_id = $user_id");
	}*/
	return true;
  }

  /**
   * Inserts the current user on database.
   *
   * @return boolean
   */
  public function insert()
  {
  	if (	empty($this->email) || 
  			empty($this->password) || 
  			$this->get_by_email($this->email)) 
  		return false;
	
	$this->dateadd = gmdate("Y-m-d H:i:s");
	$this->dateupdate = gmdate("Y-m-d H:i:s");
	$res = parent::insert();
	
	if ($res) $this->match_identity();
	
	return $res;
  }

  /**
   * Updates the current user to database.
   *
   * @return boolean
   */
  public function update()
  {
  	if ( empty($this->email) ) 
  		return false;

	$this->dateupdate = gmdate("Y-m-d H:i:s");
	$res = parent::update();
	
	if ($res) $this->match_identity();
	
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
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */