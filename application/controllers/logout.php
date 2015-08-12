<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
	  parent::__construct();
	}

	function index()
	{
		$this->load->model('user');
		$this->user->logout();
		redirect('https://api.instagram.com/oauth/authorize/?client_id=32eeefd942b649b0b2b42b59a27f5add&redirect_uri=http://demo.local.42.fr:8080/index.php/authorize/get_code&response_type=code', 'refresh');
	}
 }
