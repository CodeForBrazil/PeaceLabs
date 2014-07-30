<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

// This file contains: MY_Model

/**
 * Custom Model
 */
class MY_Model extends CI_Model
{
  /**
   * Table name.
   */
  protected $TABLE_NAME;

 /**
   * Class constructor.
   *
   * @param array $data 
   * @return Object_model 
   */
  public function __construct($data = array()) {
    parent::__construct();
	
    $this->load->helper('data');
    import_data($this, $data);
  }

  /**
   * Inserts the current row on database.
   *
   * @return boolean
   */
  public function insert() {
    $result = $this->db->insert($this->TABLE_NAME, $this);
    if ($result)
      $this->id = $this->db->insert_id();
    return $result;
  }

  /**
   * Update the current row on database.
   *
   * @return boolean
   */
  public function update() {
  	return $this->db->where('id', $this->id)->update($this->TABLE_NAME, $this);
  }

  /**
   * Update or Insert the current row on database depending on id
   *
   * @return boolean
   */
  public function save() {
  	return (isset($this->id)) ?$this->update():$this->insert();
  }


  /**
   * Deletes the current object media from database.
   *
   * @return boolean
   */
  public function delete() {
    return $this->db->where('id', $this->id)->delete($this->TABLE_NAME);
  }

  /**
   * Gets an object media by its id.
   *
   * @param int $id 
   * @return Object_media_model|null
   */
  public function get_by_id($id)
  {
    $id = (int) $id;
    $query = $this->db->get_where($this->TABLE_NAME, array('id' => $id));
    return $this->get_first_self_result($query);
  }
  
  /**
   * Return a list of models from query results
   */
  protected function get_self_results($query) {
   	$result = array();
	$class = get_class($this);
    foreach ($query->result() as $row) { $result[] =  new $class($row); }
    return $result;
  }  

  /**
   * Returns the first result as model
   */
  protected function get_first_self_result($query) {
  	$class = get_class($this);
    return $query->num_rows() > 0 ? new $class(array_shift($query->result())) : null;
  }  
  
} 


/* End of file MY_Mode.php */
/* Location: ./application/core/MY_Model.php */
