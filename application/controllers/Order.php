<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->library('Instamojo');
    }

    public function index() {
        if (isset($_SESSION['user'])) {
            $params = array('username' => $_SESSION['user']);
            $query = $this->Order_model->getRecord($params);
            if ($query->num_rows() > 0) {
                $data = array('query' => $query);
                $this->load->view('order', $data);
            } else {
                $data = array('error' => "You don't performed any purchases yet");
                $this->load->view('order', $data);
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    //Done by the user
    public function cancel($payment_id) {
        $params = array('payment_id' => $payment_id, 'type' => 'TAN', 'body' => 'Order canceled by the user');
        $response = $this->instamojo->refundCreate($params);
        /* print_r($response);
          exit(); */
        if ($response['status'] == 'Refunded') {
            $params = array('status' => 'refunded', 'payment_id' => $payment_id);
            $this->Order_model->updateRecord($params);
            redirect('order', 'refresh');
        }
    }

    //Admin operation over orders, marking
    public function approve($payment_id) {
        $params = array('status' => 'approved', 'payment_id' => $payment_id);
        $this->Order_model->updateRecord($params);
        redirect('dash/order', 'refresh');
    }

    public function reject($payment_id) {

        $params = array('payment_id' => $payment_id, 'type' => 'TAN', 'body' => 'Order canceled by the user');
        $response = $this->instamojo->refundCreate($params);
        /* print_r($response);
          exit(); */
        if ($response['status'] == 'Refunded') {
            $params = array('status' => 'rejected', 'payment_id' => $payment_id);
            $this->Order_model->updateRecord($params);
            redirect('dash/order', 'refresh');
        }
    }

    public function delivered($payment_id) {
        $params = array('status' => 'delivered', 'payment_id' => $payment_id);
        $this->Order_model->updateRecord($params);
        redirect('dash/order', 'refresh');
    }

    //Admin operation end
}
