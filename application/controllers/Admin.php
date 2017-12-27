<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            redirect('dash', 'refresh');
        }
        if (isset($_SESSION['user'])) {
            redirect('welcome', 'refresh');
        } else {
            $this->load->view('admin_login');
        }
    }

    public function auth() {
        if (isset($_POST['txtuser']) && isset($_POST['txtpass'])) {
            $username = $this->db->escape_str($_POST['txtuser']);
            $password = $this->db->escape_str($_POST['txtpass']);
            if (!$username == '' && !$password == '') {
                $ret = $this->Admin_model->match($username, $password);
                if ($ret) {
                    $_SESSION['admin'] = $username;
                    redirect('dash', 'refresh');
                } else {
                    $data = array('error' => 1);
                    $this->load->view('admin_login', $data);
                }
            } else {
                $data = array('warning' => 1);
                $this->load->view('admin_login', $data);
            }
        } else {
            $data = array('warning' => 1);
            $this->load->view('admin_login', $data);
        }
    }

    public function terminate() {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            session_destroy();
            //redirect('login/loginuser');
            $this->load->view('admin_login');
            //redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

}
