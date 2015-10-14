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
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }
  
  
}

/* End of file activity_model.php */
/* Location: ./application/models/activity_model.php */