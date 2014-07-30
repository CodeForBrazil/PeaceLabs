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
  public $password = NULL;
  public $role = self::ROLE_DEFAULT;
  public $confirmation;
  public $dateadd = 0;
  public $dateupdate = 0;
  public $status = self::STATUS_ACTIVE;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct();
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
  protected function match_identity($value,$type,$user_id) {
  	$this->load->model('User_identity_model');
	$res = $this->User_identity_model->match($value,$type,$user_id);
	if (!$res) admin_report("Problem matching identity $value","Data given: value = $value, type = $type, user_id = $user_id");
	return $res;
  }

  /**
   * Inserts the current user on database.
   *
   * @return boolean
   */
  public function insert()
  {
	$this->dateadd = gmdate("Y-m-d H:i:s");
	$this->dateupdate = gmdate("Y-m-d H:i:s");
	$res = parent::insert();
  	$this->load->model('User_identity_model');
	if ($res) $this->match_identity($this->email,User_identity_model::TYPE_EMAIL,$this->id);
	return $res;
  }

  /**
   * Updates the current user to database.
   *
   * @return boolean
   */
  public function update()
  {
	$this->dateupdate = gmdate("Y-m-d H:i:s");
	return parent::update();
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
    $email = (string) $email;
  	$this->load->model('User_identity_model');
	$identity = $this->User_identity_model->get_by_value($email,User_identity_model::TYPE_EMAIL);
	return (!is_null($identity->user_id))?$this->get_by_id($identity->user_id):false;
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
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */