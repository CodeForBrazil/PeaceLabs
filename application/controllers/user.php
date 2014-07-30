<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->view('welcome/home');
	}
	
	/**
	 * login user and redirect to previous page
	 */
	function login();
		
	}

/* End of file user.php */
/* Location: ./application/controllers/user.php */