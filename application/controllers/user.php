<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index($id=NULL)
	{
		$user = $this->getUser($id);
		$this->set_data('user',$user);
		$this->load->view('user/index',$this->get_data());
	}
	
	/** 
	 * User view page (idem index)
	 */
	public function view($id=NULL) {
		$this->index($id);
	}
	
	/**
	 * User settings page
	 */
	public function settings($id=NULL)
	{
		$user = $this->getUser($id,User_model::ROLE_ADMIN);
		$this->set_data('user',$user);
		$this->load->view('user/settings',$this->get_data());
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

	/**
	 * Check if id is null and set it to current_user id or redirect to home
	 */
	protected function getUser($id = NULL,$role = NULL) {
		$user = FALSE;
	 	if ( is_null($id) && $this->check_user(NULL,FALSE) ) {
			$user = $this->get_currentuser();
	 	} else {
	 		if (is_null($role) || $this->check_user($role,FALSE)) {
		 		$this->load->model('User_model');
				$user = $this->User_model->get_by_id($id);
	 		}
		}
		if (!$user) redirect('/');
		return $user;
	}
	 

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */