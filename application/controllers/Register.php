<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->model('User_model');
    }

    public function index() {
        if (!isset($_SESSION['user']) && !isset($_SESSION['admin']))
            $this->load->view('register');
    }

    public function update() {
        if (isset($_SESSION['user'])) {
            $data = array();
            $params['email'] = $_SESSION['user'];
            $query = $this->Profile_model->getRecord($params);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->load->view('profile', $data);
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updateAction() {
        if (isset($_POST['txtfname']) && isset($_POST['txtlname']) && isset($_POST['txtphone']) && isset($_POST['txtstreet']) && isset($_POST['txtcity']) && isset($_POST['txtstate']) && isset($_POST['txtpin'])) {

            $fname = $this->db->escape_str($_POST['txtfname']);
            $lname = $this->db->escape_str($_POST['txtlname']);
            $email = $this->db->escape_str($_POST['txtemail']);
            $phone = $this->db->escape_str($_POST['txtphone']);
            $street = $this->db->escape_str($_POST['txtstreet']);
            $city = $this->db->escape_str($_POST['txtcity']);
            $state = $this->db->escape_str($_POST['txtstate']);
            $pin = $this->db->escape_str($_POST['txtpin']);
            $password = $this->db->escape_str($_POST['txtpass']);
            $password_conf = $this->db->escape_str($_POST['txtpassconf']);

            $sq = $this->db->escape_str($_POST['txtsq']);
            $ans = $this->db->escape_str($_POST['txtans']);

            //Array init
            $data = array();

            if ($password != $password_conf) {
                $data['error'] = "Password not match !";
                $query = $this->Profile_model->getRecord(array('email' => $email));
                $data['row'] = $query->row();
                return $this->load->view('profile', $data);
            }

            $params = array(
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone' => $phone,
                'street' => $street,
                'city' => $city,
                'state' => $state,
                'pin' => $pin,
                'sq' => $sq,
                'ans' => $ans
            );

            $params2 = array(
                'email' => $email,
                'password' => $password
            );

            $ret = $this->Profile_model->updateRecord($params);
            $ret2 = $this->User_model->updatePass($params2);
            if ($ret && $ret2) {
                $data['success'] = "Profile updated successfully";
                $query = $this->Profile_model->getRecord(array('email' => $email));
                $data['row'] = $query->row();
                $this->load->view('profile', $data);
            } else {
                $data['error'] = "Profile updation failed";
                $query = $this->Profile_model->getRecord(array('email' => $email));
                $data['row'] = $query->row();
                $this->load->view('profile', $data);
            }
        } else {
            $data['error'] = "Registration failed";
            $this->load->view('profile', $data);
        }
    }

    public function newUser() {

        if (isset($_POST['txtfname']) && isset($_POST['txtlname']) && isset($_POST['txtemail']) && isset($_POST['txtpass']) && isset($_POST['txtpassconf']) && isset($_POST['txtphone']) && isset($_POST['txtstreet']) && isset($_POST['txtcity']) && isset($_POST['txtstate']) && isset($_POST['txtpin'])) {

            //extract($_POST);
            $fname = $this->db->escape_str($_POST['txtfname']);
            $lname = $this->db->escape_str($_POST['txtlname']);
            $email = $this->db->escape_str($_POST['txtemail']);
            $pass = $this->db->escape_str($_POST['txtpass']);
            $passconf = $this->db->escape_str($_POST['txtpassconf']);
            $phone = $this->db->escape_str($_POST['txtphone']);
            $street = $this->db->escape_str($_POST['txtstreet']);
            $city = $this->db->escape_str($_POST['txtcity']);
            $state = $this->db->escape_str($_POST['txtstate']);
            $pin = $this->db->escape_str($_POST['txtpin']);

            $sq = $this->db->escape_str($_POST['txtsq']);
            $ans = $this->db->escape_str($_POST['txtans']);

            //Array init
            $data = array();

            //Check for existing username
            if ($this->User_model->isExist($email)) {
                $data['error'] = "Username already exist";
                $this->load->view('register', $data);
                return;
            }
            //End
            //Password confirm check
            if (!($pass == $passconf)) {
                $data['error'] = "Password mismatch";
                $this->load->view('register', $data);
            }
            //End

            $params = array(
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone' => $phone,
                'street' => $street,
                'city' => $city,
                'state' => $state,
                'pin' => $pin,
                'sq' => $sq,
                'ans' => $ans
            );

            $ret = $this->Profile_model->addRecord($params);
            $params = array(
                'username' => $email,
                'password' => $pass,
            );
            $ret2 = $this->User_model->addRecord($params);
            if ($ret && $ret2) {
                $_SESSION['user'] = $email;
                $_SESSION['user_name'] = $fname;
                $_SESSION['user_phone'] = $phone;
                redirect(base_url(), 'refresh');
            } else {
                $data['error'] = "Registration failed";
                $this->load->view('register', $data);
            }
        } else {
            $data['error'] = "Registration failed";
            $this->load->view('register', $data);
        }
    }

}
