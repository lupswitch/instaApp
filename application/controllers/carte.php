<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carte extends CI_Controller {

	function __construct()
	{
	  parent::__construct();
	}

	function index()
	{
		/* REDIRECT THE USER TO THE AUTHENTIFICATION PAGE IF HE'S NOT LOGGED BUT TRIED TO FORCE ACCESS TO THE 'CARTE' PAGE*/
		if (!$this->session->has_userdata('is-logged-in') || $this->session->userdata('is-logged-in') === FALSE)
		{
			redirect('https://api.instagram.com/oauth/authorize/?client_id=af54f552f52e411aa2ec47903b272c93&redirect_uri=https://ccompera.herokuapp.com/index.php/authorize/get_code&response_type=code', 'refresh');
		}

		$this->load->view('carte_view');
	}
};
