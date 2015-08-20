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
	
	$this->initialize_lang();
	
    $user_id = $this->session->userdata('user_id');
    if ( ! empty($user_id))
    {
      $this->load->model('User_model');
      $this->set_data('current_user', $this->User_model->get_by_id($user_id));
    }
    $this->output->set_header('Content-Type: text/html; charset='.$this->config->item('charset'));

	$this->check_post();
  }  
  
  /**
   * Language initializer
   */
  function initialize_lang() 
  {
	$ci =& get_instance();
 
	$available_languages = $ci->config->item('available_languages');
	if (isset($_GET['lang']) && in_array($_GET['lang'],array_keys($available_languages))) {
		$lang = $_GET['lang'];
	} else {
        $lang = $ci->session->userdata('lang');
        if (!$lang) $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
	$ci->session->set_userdata(array('lang'=>$lang));

	$available_locales = $ci->config->item('available_locales');
	if ( in_array($lang,array_keys($available_locales)) ) {
		setlocale(LC_ALL, $available_locales[$lang]);
	} else {
	 	setlocale(LC_ALL, $ci->config->item('locale'));
	}

	if ( in_array($lang,array_keys($available_languages)) ) {
		$lang_dir = $available_languages[$lang];
		if ($lang != $ci->config->item('language')) {
			$ci->lang->switch_lang($lang_dir);
		}
	}
  }
  
	/**
	 * check if post is cross-site (like login, register, password retrieval)
	 *
	 * @return void
	 */
	function check_post() {
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
							if (isset($_GET['from']) && ($redirect = $_GET['from'])) redirect($redirect);
						}
					}
					if (!$current_user) {
						$this->set_data('open_modal','login');
					}
					break;
				
				case 'register':
					$this->form_validation->set_rules('register_email', lang('app_email'), 'required|valid_email');
					$this->form_validation->set_rules('register_password', lang('app_password'), 'required|min_length[5]|max_length[15]');
					$this->form_validation->set_rules('confirm_password', lang('app_confirm_password'), 'required|matches[register_password]');
	
					if ($this->form_validation->run() !== FALSE) {
						$email    = $this->input->post('register_email');
						$password = $this->input->post('register_password');

						// check if email already exists
						$this->load->model('User_model');
						if ($this->User_model->email_exists($email)) {
							$this->errors[] = sprintf(lang('app_register_email_exists_error'),$email);
							$this->set_data('open_modal','register');
						} else {
							$current_user = $this->register($email,$password);
							if ($current_user) {
								$this->load->helper('email');
								email_user_confirmation($current_user);
								admin_report("New user: $email","Check his profil: ".$current_user->get_url());
								redirect(site_url('user/settings'));
							} else {
								$this->errors[] = sprintf(lang('app_register_error'),$email);
								$this->set_data('open_modal','register');
							}
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

				case 'new_activity':
					if (!$this->save_activity()) $this->set_data('open_modal','newActivity');
					break;

				case 'apply':
					$this->form_validation->set_rules('comment', lang('app_apply_comment'), 'max_length[1000]');
					
					if ($this->form_validation->run() !== FALSE) {
						$this->apply();
					} else {
						$this->set_data('open_modal','apply');
					}	
					break;

			}
				
		}
		
	}

  /**
   * Get current user
   */
  public function get_currentuser() {
  	return $this->get_data('current_user');
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
    $current_user = $this->get_currentuser();
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
   * @param string $email 
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
   * Update or insert an activity.
   *
   * @return boolean
   */
  protected function save_activity()
  {
	$current_user = $this->get_currentuser();
	$activity_id = $this->input->post('id');
	if (!$current_user) {
		$this->errors[] = lang('app_no_current_user_error');
		return FALSE;
	} else {
		$this->form_validation->set_rules('name', lang('app_activity_name'), 'required');
		
		if ($this->form_validation->run() !== FALSE) {
			$this->load->model('activity_Model');
			
			$activity = new activity_Model();
			if ($activity_id) $activity->id = $activity_id;
			$activity->name = $this->input->post('name');
			$activity->owner = $current_user->id;
			if ($description = $this->input->post('description')) $activity->description = trim($description);
			
			if ($activity->save()) {
				
				$activity_users = $this->input->post('activity_users');
				$activity_users = ($activity_users)?explode(',',$activity_users):array();
				$activity->set_users($activity_users);
				
				return TRUE;
			} else {
				$this->errors[] = sprintf(lang('app_activity_save_error'),$this->config->item('contact_email'));
			}
		} else {
			return FALSE;
		}
	}
  	
  }
  
  /**
   * Register current user for activity
   */
  protected function apply()
  {
	$current_user = $this->get_currentuser();
	if (!$current_user) {
		$this->errors[] = lang('app_no_current_user_error');
		return FALSE;
	}
	$activity_id = $this->input->post('id');
  	$this->load->model('activity_Model');
	$activity = new Activity_model; //unnecessary
	$activity = $this->activity_Model->get_by_id($activity_id);

	$comment = $this->input->post('comment');
	if (!$comment || empty($comment)) $comment = NULL;
	
	if ($activity && $activity->apply($current_user,$comment)) {
		$this->messages[] = lang('app_apply_success');
		$this->load->helper('email');
		email_activity_apply($activity,$current_user,$comment);
		return TRUE;
	} else {
		$this->errors[] = lang('app_apply_error');
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
  protected function output_json($var)
  {
    $json = json_encode($var);
    $this->output->set_header('Content-Type: application/json; charset='.$this->config->item('charset'));
    $this->output->set_header('Content-Length: '.strlen($json));
    $this->output->set_output($json);
  }
  
  /**
   * Redirect to referer
   * @param $url fallback redirect
   */
  protected function redirect_referer($url='/')
  {
	$this->load->library('user_agent');
	redirect(($this->agent->is_referral())?$this->agent->referrer():$url);
  }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */