<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends MY_Controller {

	/**
	 * Update Page
	 */
	public function update($id)
	{
		$id = (int) $id;
		$this->load->model('activity_Model');
		$activity = $this->activity_Model->get_by_id($id);
		$this->set_data('activity',$activity);
		$this->load->view('activity/update',$this->get_data());
	}

	
}

/* End of file activity.php */
/* Location: ./application/controllers/activity.php */