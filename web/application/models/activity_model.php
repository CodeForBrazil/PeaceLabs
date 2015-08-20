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
  public $name;
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
	return $this->config->item('default_image');
  }
    
  /**
   * Get users interested in activity
   * @return array of activity_user row including a 'user' field with the user object model
   */
  protected $_activity_users = NULL;
  public function get_users() {
  	if (is_null($this->_activity_users)) {
	   	$this->_activity_users = array();
	   	if ($this->id) {
	  		$this->load->model('User_model');
	   		$query = $this->db->get_where(self::ACTIVITY_USER_TABLE_NAME, array('activity_id' => $this->id));
	    	foreach ($query->result() as $row) {
	    		$row = (array)$row;
	    		$user = $this->User_model->get_by_id($row['user_id']);
				$row['user'] = $user;
	    		$this->_activity_users[$row['user_id']] =  $row; 
			}
	   	}
  	}
	return array_values($this->_activity_users);
  }
  
  /**
   * Get activity owner
   */
  public function get_owner() {
  	$this->load->model('User_model');
	return $this->User_model->get_by_id($this->owner);
  	
  }
  
  /**
   * Get activity update url
   */
  public function get_update_url() {
  	return site_url('activity/update/'.$this->id);
  }
  
  /**
   * Check if user has applied to current activity
   * @param $user
   * @return boolean
   */
  public function has_applied($user) {
  	$this->get_users(); // setting $this->_activity_users
  	return (isset($this->_activity_users[$user->id]));
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
   * Set the activity user list by applying all new user and disclaiming all user not in $user_list
   * @param $user_list : list of user keys. Keys can be either a number for the user id or a string for a new fake user to create
   * 
   */
  public function set_users($user_list) {
  	if ($this->id) {
	  	$this->load->model('User_model');
		$users = $this->get_users();
		$users_ids = array_keys($this->_activity_users);
//		$this->db->delete(self::ACTIVITY_USER_TABLE_NAME,array('activity_id'=>$this->id));
	  	foreach($user_list as $user_key) {
	  		$user_key = trim($user_key);
  			if (empty($user_key)) continue;
	  		if (!in_array($user_key,$users_ids)) {
				$user = (is_numeric($user_key))?
							$this->User_model->get_by_id($user_key):
							$this->User_model->create_fake($user_key,$this->owner);
				if ($user)
					$this->apply($user);
				else return FALSE;
	  		} else {
				if(($key = array_search($user_key, $users_ids)) !== false) unset($users_ids[$key]);
			}
	  	}
		foreach ($users_ids as $user_id) {
			$user = $this->User_model->get_by_id($user_id);
			if ($user) $this->disclaim($user);
			else return FALSE;
		}
  	}
	return TRUE;
  }
  
  /**
   * Register a user in activity
   */
  public function apply($user,$comment=NULL) {
  	$activity_user = array('activity_id'=>$this->id,'user_id'=>$user->id);
	$query = $this->db->get_where(self::ACTIVITY_USER_TABLE_NAME,$activity_user);
	$res = TRUE;
	if ($query->num_rows() == 0) {
		if (!is_null($comment)) $activity_user['comment'] = $comment;
		$res = $this->db->insert(self::ACTIVITY_USER_TABLE_NAME,$activity_user);
		if ($res) unset($this->_activity_users);
	}
	return $res;
  }
  
  /**
   * Unregister user from activity
   */
  public function disclaim($user) {
  	$activity_user = array('activity_id'=>$this->id,'user_id'=>$user->id);
	if ($user->is_fake() && count($user->get_activities()==0)) $user->delete();
  	return $this->db->delete(self::ACTIVITY_USER_TABLE_NAME,$activity_user);
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