<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorize extends CI_Controller {

	function __construct()
	{		
		parent::__construct();
	}

	function index()
	{
		
		echo '<h1>Authorize</h1>';		
		
	}
	
	/*
	 * Function for the Instagram callback url
	 */
	function get_code() {

		// Load the User model
		$this->load->model('user');
	
		// Make sure that there is a GET variable of code
		if(isset($_GET['code']) && $_GET['code'] != '') {
			$auth_response = $this->instagram_api->authorize($_GET['code']);
			$this->session->set_userdata('instagram-token', $auth_response->access_token);
			if ($this->session->has_userdata('is-logged-in') && $this->session->userdata('is-logged-in') === TRUE)
			{
				/* DEBUG : ?><h2><?php echo "Je suis deja log !!"; ?></h2><?php */
				redirect('index.php/carte');
				return ;
			}
			// Set up session variables containing some useful Instagram data
			$this->session->set_userdata('instagram-username', $auth_response->user->username);
			$this->session->set_userdata('instagram-profile-picture', $auth_response->user->profile_picture);
			$this->session->set_userdata('instagram-uid', $auth_response->user->id);
			$this->session->set_userdata('instagram-full-name', $auth_response->user->full_name);
			$this->session->set_userdata('is-logged-in', TRUE);
			$this->session->set_userdata('welcomed', FALSE);

			// Create a user if needed and a log in the database
			$this->user->login();
			/* DEBUG : ?><h2><?php echo "J'ai fait plein de trucs"; ?></h2><?php */
			redirect('index.php/carte');

		} else {
			
			// There was no GET variable so erase all session data that might be here and redirect back to the homepage
			$this->user->logout();
			redirect('index.php/welcome');
		}
	}
}
