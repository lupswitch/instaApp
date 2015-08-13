<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
	  parent::__construct();
	}

	function index()
	{
		$this->load->model('User');
		$this->User->logout();
		redirect('https://api.instagram.com/oauth/authorize/?client_id=af54f552f52e411aa2ec47903b272c93&redirect_uri=http://myapp-ccompera.c9.io/index.php/Authorize/get_code&response_type=code', 'refresh');
	}
 }
