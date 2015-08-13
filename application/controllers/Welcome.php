<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (!$this->session->has_userdata('is-logged-in') || $this->session->userdata('is-logged-in') === FALSE)
		{
			redirect('https://api.instagram.com/oauth/authorize/?client_id=af54f552f52e411aa2ec47903b272c93&redirect_uri=http://myapp-ccompera.c9.io/index.php/Authorize/get_code&response_type=code', 'refresh');
		}
		else
		{
			redirect('Carte');
		}
	}
}
