<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		
		$this->load->view('user/index',$this->get_data());
	}
	
	/**
	 * Activate user account
	 */
	public function confirmation($confirmation) {
		$this->load->model('User_model');
		if ($user = $this->User_model->check_confirmation($confirmation)) {
			$this->set_currentuser($user);
			$this->messages[] = lang('app_confirmation_ok');
		} else {
			$this->errors[] = sprintf(lang('app_confirmation_error'),CONTACT_EMAIL);
		}
		$this->load->view('welcome/home',$this->get_data());
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */