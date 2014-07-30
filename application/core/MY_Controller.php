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
  public $debug = array();
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
    }
    $this->output->set_header('Content-Type: text/html; charset='.$this->config->item('charset'));

  }

	/**
	 * execute login with post parameters
	 *
	 * @return void
	 */
	function check_login() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if ($this->is_post()) {
			$this->form_validation->set_error_delimiters('','');
			switch ($this->input->post('form_name')) {
				case 'login':
					$this->form_validation->set_rules('login_email', lang('app_email'), 'required|valid_email');
					$this->form_validation->set_rules('login_password', lang('app_password'), 'required');
					
					$current_user = false;
					if ($this->form_validation->run() !== FALSE) {
						$email    = $this->input->post('login_email');
						$password = $this->input->post('login_password');
					
						if ($current_user = $this->login($email,$password)) {
							$redirect = $this->input->post('redirect');
							if (!empty($redirect)) redirect($redirect);
						}
					}
					if (!$current_user) {
						$this->set_data('open_modal','login');
					}
					break;
				
				case 'register':
					$this->form_validation->set_rules('register_email', lang('app_email'), 'required|valid_email|is_unique[user.email]');
					$this->form_validation->set_rules('register_password', lang('app_password'), 'required|min_length[5]|max_length[15]');
					$this->form_validation->set_rules('confirm_password', lang('app_confirm_password'), 'required|matches[register_password]');
	
					if ($this->form_validation->run() !== FALSE) {
						$email    = $this->input->post('register_email');
						$password = $this->input->post('register_password');
						$current_user = $this->register($email,$password);
						if ($current_user) {
							$this->load->helper('email');
							email_user_confirmation($current_user);
						}
					} else {
						$this->set_data('open_modal','register');
					}					
					break;

				case 'password':
					$this->form_validation->set_rules('password_email', lang('app_email'), 'required|valid_email');

					if ($this->form_validation->run() !== FALSE) {
						$email = $this->input->post('password_email');
						if ($this->retrieve_password($email)) {
							$this->messages[] = sprintf(lang('app_retrieve_password_success'),$email);
						} else {
							$this->errors[] = sprintf(lang('app_retrieve_password_error'),$email);
						}
					} else {
						$this->set_data('open_modal','password');
					}					
					break;

			}
				
		}
		
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
   * @param string $email 
   * @param string $password 
   * @return boolean
   */
  protected function login($email,$password)
  {
	$this->load->model('User_model');
	$user = $this->User_model->get_by_email($email);
	$password = $this->User_model->encrypt_password($password);
  	if ( !is_null($user) && ($password === $user->password) ) {
		$this->set_currentuser($user);
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
  protected function register($email,$password)
  {
	$this->load->model('User_model');
	$user = new User_model();
	$user->email = $email;
	$user->password = $this->User_model->encrypt_password($password);
	$user->set_confirmation();
	if ($user->insert()) {
		$this->set_currentuser($user);
		return $user;
	}
	else
		return FALSE;
  }

  /**
   * Retrieve user password.
   *
   * @param int $type 
   * @param boolean $redirect 
   * @return boolean
   */
  protected function retrieve_password($email)
  {
	$this->load->model('User_model');
	if ($user = $this->User_model->get_by_email($email)) {
		$password = $user->reset_password();

		$this->load->helper('email');
		email_user_password($user,$email,$password);
		
		return TRUE;
	} else {
		return FALSE;
	}
  }

  
  /**
   * Set user as current user
   */
  protected function set_currentuser($user)
  {
  	if ($user) {
		$this->session->set_userdata('user_id', $user->id);
	    $this->set_data('current_user', $user);
  	}
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
  	if (defined('ENVIRONMENT') && in_array(ENVIRONMENT,array('development'))) $this->_data['debug'] = $this->debug;
	
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
  
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */