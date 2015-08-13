<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

     function __construct()
     {
          parent::__construct();
     }

     function get_uid()
     {
          $this -> db -> select('u_id');
          $this -> db -> from('users');
          $this -> db -> where('ig_id', $this->session->userdata('instagram-uid'));
          $this -> db -> limit(1);
 
          $query = $this -> db -> get();
 
          if($query -> num_rows() == 1)
          {
               return $query->row_array()['u_id'];
          }
               else
          {
               return 0;
          }
     }

     function create()
     {
          $data = array(
               'ig_id' => $this->session->userdata('instagram-uid'),
               'ig_login' => $this->session->userdata('instagram-username')
          );
          $this->db->insert('users', $data);
     }

     function add_log($uid)
     {
          $this->load->helper('date');

          $data = array(
               'u_id' => $uid,
               'l_date' => now()
          );
          $this->db->insert('logs', $data);
          $insert_id = $this->db->insert_id();
          $this->session->set_userdata('current-l_id', $insert_id);
     }

     function addLocation($loc)
     {
          $loc = explode(';', $loc);
          if (empty($loc) || "" === $loc[0] || "" === $loc[1])
               redirect('Logout');
          else
          {
               $data = array(
                    'l_longitude' => $loc[0],
                    'l_latitude' => $loc[1]
               );
               $this->db->where('l_id', $this->session->userdata('current-l_id'));
               $this->db->update('logs', $data);
               $this->session->set_userdata('current-lng', $loc[0]);
               $this->session->set_userdata('current-lat', $loc[1]);
          }
     }

     function login()
     {
          $uid = $this->get_uid();
          if (!$uid)
          {
               $this->create();
               $uid = $this->get_uid();
          }
          $this->add_log($uid);
     }

     function logout()
     {
          // need to go there : "https://instagram.com/accounts/logout/"
          $data = array('current-l_id',
               'instagram-username',
               'instagram-profile-picture',
               'instagram-uid',
               'instagram-full-name',
               'is-logged-in',
               'current-lng',
               'current-lat',
               'welcomed');
          $this->session->unset_userdata($data);
          $this->session->sess_destroy();
     }
}
