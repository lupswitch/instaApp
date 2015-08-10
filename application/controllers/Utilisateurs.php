<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

    public function profil() {
        $data = array('nom' => 'Robert');
        $this->load->view('utilisateur/profil', $data);
    }

}
