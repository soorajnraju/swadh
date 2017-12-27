<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Search_model');
    }

    public function index() {
        $this->load->view('search');
    }

    public function find() {
        if (isset($_POST['txtsearch'])) {
            $param = $this->db->escape_str($_POST['txtsearch']);
            $query = $this->Search_model->find($param);
            if ($query->num_rows() > 0) {
                $this->load->view('search', array('query' => $query));
            } else {
                $this->load->view('search', array('error' => 'Product not found !'));
            }
        }
    }

}
