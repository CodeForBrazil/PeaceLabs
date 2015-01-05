<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index($id=NULL)
	{	
		$user = $this->getUser((is_null($id))?NULL:(int)$id);
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
	 * User view page from alias
	 */
	public function alias($alias=NULL) {
		$user = $this->getUser($alias);
		$this->set_data('user',$user);
		$this->load->view('user/index',$this->get_data());
	}
	
	/**
	 * User settings page
	 */
	public function settings($id=NULL)
	{
	    $this->load->helper('form');
	    $this->load->library('form_validation');
		$this->load->model('User_model');
		
		$user = $this->getUser($id,User_model::ROLE_ADMIN);
		
		if ( $this->is_post() ) {
		    $this->form_validation->set_rules('name', lang('app_name'), 'max_length[100]');
		    $this->form_validation->set_rules('bio', lang('app_bio'), 'max_length[1000]');
		    $this->form_validation->set_rules('city', lang('app_city'), 'max_length[100]');

			$alias = $this->input->post('alias');
			if ($alias != $user->alias) {
			    $this->form_validation->set_rules('alias', lang('app_alias'), 'max_length[50]|is_unique[user.alias]');
			}

			$email = $this->input->post('email');
			if ($email != $user->email || empty($email)) {
			    $this->form_validation->set_rules('email', lang('app_email'), 'required|valid_email');
			}
			
			$password = $this->input->post('password');
			if (!empty($password)) {
			    $this->form_validation->set_rules('password', lang('app_password'), 'min_length[5]|max_length[15]');
			    $this->form_validation->set_rules('password_confirm', lang('app_confirm_password'), 'required|matches[password]');
			}
	
			if ($this->form_validation->run()) {
				$user->name = $this->input->post('name');
				$user->email = $this->input->post('email');
				$user->bio = $this->input->post('bio');
				$user->city = $this->input->post('city');
				$user->alias = $this->input->post('alias');
				
				if (!empty($password)) $user->password = $user->encrypt_password($password);
	
		        if ($user->update()) {

					$this->load->library('upload');
					if ( (!empty($_FILES['avatar']['tmp_name'])) && ($this->upload->do_upload('avatar')) ) {
						$data = $this->upload->data();
						$user->add_avatar($data['full_path']);
					}

		        	$current_user = $this->get_currentuser();
					if ($user->id == $current_user->id) {
						$current_user = $user;
						$this->set_data('current_user',$current_user);
					}
		        	$this->messages[] = lang('app_user_save_success');
		        } else {
		        	$this->errors[] = sprintf(lang('app_user_save_error'),$this->config->item('contact_email'));;
				}
			}
		}
		
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
			$this->errors[] = sprintf(lang('app_confirmation_error'),$this->config->item('contact_email'));
		}
		$this->load->view('welcome/home',$this->get_data());
	}
	
	/**
	 * User identities search action
	 * @param int $user_id
	 * @param string $key
	 * @return output json
	 */
	public function search_identities($key = NULL) {
	  	if ($key == null && isset($_GET['q'])) $key = $_GET['q'];
	    $key = urldecode($key);
			
		$this->load->model('User_model');
		
		$users = $this->User_model->search_user($key,$this->get_currentuser());
		
	    $return = array(
	    'query' => $this->db->last_query(),
	    'more' => false,
	    'status' => 'OK',
	    'results' => $users,
		);
	
	    $this->output_json($return);
	}
	 
	/**
	 * if id is null and get current user
	 * if id is int, get user by id
	 * if id is string, get user by alias
	 * if user not found redirect to home
	 */
	protected function getUser($id = NULL,$role = NULL) {
		$user = FALSE;
	 	if ( is_null($id) && $this->check_user(NULL,FALSE) ) {
			$user = $this->get_currentuser();
	 	} else {
	 		if (is_null($role) || $this->check_user($role,FALSE)) {
		 		$this->load->model('User_model');
				if (is_int($id))
					$user = $this->User_model->get_by_id($id);
				else
					$user = $this->User_model->get_by_alias($id);
	 		}
		}
		if (!$user) redirect('/');
		return $user;
	}
	 
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */