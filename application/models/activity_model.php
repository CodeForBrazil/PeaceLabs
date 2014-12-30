<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

/**
 * Activity model.
 */
class Activity_model extends MY_Model
{

  /**
   * Table name.
   */
  const TABLE_NAME = 'activity';
  const ACTIVITY_USER_TABLE_NAME = 'activity_user';
  
    // Table fields
  public $id;
  public $title;
  public $description;
  public $image;
  public $group;
  public $privacy;
  public $owner;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }


  /**
   * Returns activity main image 
   * @return media_Model
   */
  public function get_image($style=NULL) {
  	if (!is_null($this->image)) {
  		$this->load->model('Media_model');
		$image = $this->Media_model->get_by_id($this->image);
		if ($path = $image->get_path($style))
			return $path;
  	}
	return DEFAULT_IMAGE;
  }
    
  /**
   * Get users interested in activity
   */
  public function get_users() {
   	$users = array();
   	if ($this->id) {
  		$this->load->model('User_model');
   		$query = $this->db->get_where(self::ACTIVITY_USER_TABLE_NAME, array('activity_id' => $this->id));
    	foreach ($query->result() as $row) {
    		$row = (array)$row;
    		$user = $this->User_model->get_by_id($row['user_id']);
			$row['user'] = $user;
    		$users[] =  $row; 
		}
   	}
	return $users;
  }

  /**
   * Get all activities by owner user_id
   * 
   */
  public function get_by_owner($user_id) {
    $user_id = (int) $user_id;
    $query = $this->db->get_where(self::TABLE_NAME, array('owner' => $user_id));
    return $this->get_self_results($query);
  }
  
  /**
   * Set the activity user list
   */
  public function set_users($user_list) {
  	if ($this->id) {
	  	$this->load->model('User_model');
		$this->db->delete(self::ACTIVITY_USER_TABLE_NAME,array('activity_id'=>$this->id));
	  	foreach($user_list as $user_key) {
			$user = (is_numeric($user_key))?
						$this->User_model->get_by_id($user_key):
						$this->User_model->create_fake($user_key,$this->owner);
			if ($user) {
				$this->db->insert(self::ACTIVITY_USER_TABLE_NAME,array('activity_id'=>$this->id,'user_id'=>$user->id));
			}
	  	}
  	}
	return TRUE;
  }
  
  /**
   * Delete activity
   */
  public function delete() {
  	$this->db->delete(self::ACTIVITY_USER_TABLE_NAME,array('activity_id'=>$this->id));
	return parent::delete();
  }
  
  
}

/* End of file activity_model.php */
/* Location: ./application/models/activity_model.php */