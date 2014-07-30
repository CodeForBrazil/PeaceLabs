<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

/**
 * User identity model.
 */
class User_identity_model extends MY_Model
{

  /**
   * Table name.
   */
  const TABLE_NAME = 'user_identity';
  
  /** Types */
  const TYPE_NAME = 'name';
  const TYPE_EMAIL = 'email';

 // Table fields
  public $id;
  public $type;
  public $value;
  public $user_id = NULL;
  public $creator_id = NULL;
  public $weight = 1;

  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }

  /**
   * Get by value.
   *
   * @param string $value 
   * @return User_model|null
   */
  public function get_by_value($value,$type = NULL)
  {
    $value = (string) $value;
	if (!is_null($type)) $this->db->where(array('type' => $type));
    $query = $this->db->from(self::TABLE_NAME)->like('value',$value)->get();
	return $this->get_first_self_result($query);
  }

  /**
   * Get all by user_id
   * @param $user_id
   * @param $type (optional)
   */
  public function get_all($user_id,$type = NULL) {
    $user_id = (int) $user_id;
	if (!is_null($type)) $this->db->where(array('type' => $type));
    $query = $this->db->get_where($this->TABLE_NAME, array('user_id' => $user_id));
    return $this->get_self_results($query);
  }
  
  /**
   * If identity exists, link it to user else create new one
   */
  public function match($value,$type,$user_id) {
  	$query = $this->db->from(self::TABLE_NAME)->like('value',$value)->where('type',$type)->get();
	if ($query->num_rows() > 0) {
		$identity = $this->get_first_self_result($query);
		if (!is_null($identity->user_id) && $identity->user_id != $user_id) {
			log_message('warning',"Identity match error for $value,$type, $user_id");
			return false;
		} else {
			$identity->user_id = $user_id;
			return $identity->update();
		}
	} else {
		$identity = new User_identity_model();
		$identity->value = $value;
		$identity->type = $type;
		$identity->user_id = $user_id;
		$identity->creator_id = $user_id;
		return $identity->insert();
	}
  }
  
}

/* End of file user_identity_model.php */
/* Location: ./application/models/user_identity_model.php */