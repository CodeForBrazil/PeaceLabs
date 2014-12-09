<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->view('welcome/home',$this->get_data());
	}

	/**
	 * Page displaying the current theme.
	 */
	public function theme()
	{
		$this->load->view('welcome/theme');
	}

	/**
	 * Page with todo list.
	 */
	public function todo()
	{
		$this->load->view('welcome/todo');
	}

	/**
	 * Sign out action.
	 *
	 * @return void
	 */
	public function out()
	{
	    $this->session->sess_destroy();
	    redirect('/');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */