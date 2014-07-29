<?php
if ( ! defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Base controller with auth check.
 */
class MY_Controller extends CI_Controller
{

  /**
   * Data to send to view.
   *
   * @var array
   */
  private $_data = array();
  protected $debug = array();
  public $messages = array();
  public $errors = array();

  /**
   * Class constructor.
   */
  public function __construct()
  {
    parent::__construct();
	setlocale(LC_ALL, "fr_FR");
    $user_id = $this->session->userdata('user_id');
    if ( ! empty($user_id))
    {
      $this->load->model('User_model');
      $this->set_data('current_user', $this->User_model->get_by_id($user_id));
	  
  	  $this->load->model('Territory_model');
	  $this->set_data('user_territory',$this->Territory_model->get_by_owner($user_id));
    }
    $this->output->set_header('Content-Type: text/html; charset='.$this->config->item('charset'));

  }

  /**
   * Checks if current user is authenticated (has signed in).
   *
   * @param int $type 
   * @param boolean $redirect 
   * @return boolean
   */
  public function check_user($type = null, $redirect = true)
  {
    $current_user = $this->get_data('current_user');
    return $this->validation->check_user($current_user, $type, $redirect);
  }
  
  /**
   * Log a user in.
   *
   * @param int $type 
   * @param boolean $redirect 
   * @return boolean
   */
  public function login($email,$password)
  {
	$this->load->model('User_model');
  	if ( ($user = $this->User_model->get_by_email($email)) && $this->User_model->encrypt_password($password) === $user->password) {
		$this->session->set_userdata('user_id', $user->id);
	    $this->set_data('current_user', $user);
		return $user;
	}
	return false;
  }

  /**
   * Register and log user in.
   *
   * @param string $email 
   * @param string $password 
   * @return boolean
   */
  public function register($email,$password)
  {
	$this->load->model('User_model');
	$this->User_model->email = $email;
	$this->User_model->password = $this->User_model->encrypt_password($password);
	if ($this->User_model->insert()) {
		$user = $this->User_model->get_by_id($this->User_model->id);
		$this->session->set_userdata('user_id', $user->id);
	    $this->set_data('current_user', $user);
		return $user;
	}
	else
		return false;
  }

  /**
   * Was the request submited via POST method?
   *
   * @return boolean
   */
  public function is_post()
  {
    return 'POST' === $this->input->server('REQUEST_METHOD');
  }

  /**
   * Was the request submited via GET method?
   *
   * @return boolean
   */
  public function is_get()
  {
    return 'GET' === $this->input->server('REQUEST_METHOD');
  }

  /**
   * Gets some data by key from controller.
   *
   * @param string $key 
   * @param mixed $default 
   * @return mixed
   */
  protected function get_data($key = null, $default = null)
  {
  	$this->_data['errors'] = $this->errors;
  	$this->_data['messages'] = $this->messages;
    if (null === $key)
    {
      return $this->_data;
    }
    if ( ! (is_string($key) and isset($this->_data[$key])))
    {
      return $default;
    }
    return $this->_data[$key];
  }

  /**
   * Sets a data slot to send to view.
   *
   * @param string $key 
   * @param mixed $value 
   * @return void
   */
  protected function set_data($key, $value = null)
  {
    is_string($key) and $this->_data[$key] = $value;
  }

  /**
   * Outputs an object or array in JSON format with HTTP headers.
   *
   * @param mixed $var 
   * @return void
   */
  public function output_json($var)
  {
    $json = json_encode($var);
    $this->output->set_header('Content-Type: application/json; charset='.$this->config->item('charset'));
    $this->output->set_header('Content-Length: '.strlen($json));
    $this->output->set_output($json);
  }

 /**
   * Check if string contains only alfanumerical characters and - and _ .
   *
   * @param string $str 
   * @return boolean
   */
	public function valid_phone($str)
	{
		if ( preg_match("/[^0-9\+ ]/i", $str))
		{
			$this->form_validation->set_message('valid_phone', lang('app_error_valid_phone'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */