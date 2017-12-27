<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin']))
            redirect('admin', 'refresh');
        $this->load->model('Dash_model');
        $this->load->model('Product_model');
    }

    public function index() {
        if (!isset($_SESSION['admin'])) {
            redirect('admin', 'refresh');
        } else {
            //Admin things
            $query = $this->Dash_model->getRecords();
            $data = array();
            if ($query->num_rows() > 0) {
                $data['query'] = $query;
            } else {
                $data['error'] = 'No data available';
            }
            $this->load->view('dash', $data);
        }
    }

    public function report() {
        $this->load->view('dash_report');
    }

    public function order() {
        $this->load->view('dash_order');
    }

    public function orderAction() {
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start = date('Y-m-d', strtotime($_POST['start_date']));
            $end = date('Y-m-d', strtotime($_POST['end_date']));
            $params = array('start_date' => $start, 'end_date' => $end);
            $query = $this->Dash_model->getRecordsPeriod($params);
            if ($query->num_rows() > 0) {
                $this->load->view('dash_order', array('query' => $query));
            } else {
                $this->load->view('dash_order', array('error' => 'No data available !'));
            }
        }
    }

    public function product() {
        $ret = $this->Product_model->getAll();
        $query = $ret['query'];
        $data = array();
        if ($query->num_rows() > 0) {
            $data['query'] = $query;
            $this->load->view('dash_product', $data);
        } else {
            $data['error'] = 'No data available !';
            $this->load->view('dash_product', $data);
        }
    }

}
