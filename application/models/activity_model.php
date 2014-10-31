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
   * Get all activities by owner user_id
   * 
   */
  public function get_by_owner($user_id) {
    $user_id = (int) $user_id;
    $query = $this->db->get_where($this->TABLE_NAME, array('owner' => $user_id));
    return $this->get_self_results($query);
  }
  
}

/* End of file activity_model.php */
/* Location: ./application/models/activity_model.php */