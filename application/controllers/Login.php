<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Profile_model');
    }

    public function index() {
        if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
            $this->load->view('login');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function auth() {
        if (isset($_POST['txtuser']) && isset($_POST['txtpass'])) {
            $username = $this->db->escape_str($_POST['txtuser']);
            $password = $this->db->escape_str($_POST['txtpass']);
            if (!$username == '' && !$password == '') {
                $ret = $this->User_model->match($username, $password);
                if ($ret) {
                    $query = $this->Profile_model->getRecord(array('email' => $username));
                    $row = $query->row();
                    $_SESSION['user'] = $username;
                    $_SESSION['user_name'] = $row->firstname;
                    $_SESSION['user_phone'] = $row->phone;
                    if (isset($_SESSION['frmCart']) && $_SESSION['frmCart'] == 1) {
                        $_SESSION['frmCart'] = 0;
                        redirect('cart/view', 'refresh');
                    }
                    redirect('welcome', 'refresh');
                } else {
                    $this->load->view('login', array('error' => 1));
                }
            } else {
                $this->load->view('login', array('warning' => 1));
            }
        } else {
            $this->load->view('login', array('warning' => 1));
        }
    }

    public function terminate() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            session_destroy();
            $this->load->view('login');
        }
    }

    public function recover() {
        if (isset($_POST['submit'])) {
            $username = $this->db->escape_str($_POST['txtuser']);
            $password = $this->db->escape_str($_POST['txtpass']);
            $password_conf = $this->db->escape_str($_POST['txtpassconf']);
            $ans = $this->db->escape_str($_POST['txtans']);
            if ($password != $password_conf) {
                //echo "<script>alert('Password not match') ; window.location.href = '" . base_url('login/#myModal') . "'</script>";
                return $this->load->view('login', ['pass_not_match' => 1]);
            }
            $params = array('username' => $username, 'email' => $username, 'password' => $password);
            $query = $this->Profile_model->getSec($params);
            $row = $query->row();
            $real_ans = $row->ans;
            if ($real_ans == $ans) {
                if ($this->User_model->updatePass($params)) {
                    //echo "<script>alert('Password successfully updated') ; window.location.href = '" . base_url('login/#myModal') . "'</script>";
                    return $this->load->view('login', ['success_update' => 1]);
                }
            } else {
                //echo "<script>alert('Answer didnt match') ; window.location.href = '" . base_url('login/#myModal') . "'</script>";
                return $this->load->view('login', ['ans_not_match' => 1]);
            }
        }
    }

}
