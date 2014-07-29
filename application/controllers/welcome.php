<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->view('welcome/home');
	}

	/**
	 * Page displaying the current theme.
	 */
	public function theme()
	{
		$this->load->view('welcome/theme');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */