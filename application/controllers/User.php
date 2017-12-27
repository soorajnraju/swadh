<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin']))
            redirect('admin', 'refresh');
        $this->load->model('Profile_model');
    }

    public function view($username) {
        $params['email'] = base64_decode($username);
        $query = $this->Profile_model->getRecord($params);
        $data = array();
        if ($query->num_rows() > 0) {
            $data['query'] = $query;
            $this->load->view('user_info', $data);
        } else {
            $data['error'] = "No data available !";
            $this->load->view('user_info', $data);
        }
    }

}
