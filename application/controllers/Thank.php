<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Thank extends CI_Controller {

    public $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Payment_model');
        $this->load->model('Order_model');
        $this->load->library('Instamojo');
    }

    public function index() {
        $request_id = '';
        $payment_id = '';
        $status = '';
        if (isset($_GET['payment_request_id'])) {
            $request_id = $this->db->escape_str($_GET['payment_request_id']);
        }
        if (isset($_GET['payment_id'])) {
            $payment_id = $this->db->escape_str($_GET['payment_id']);
        }
        $ret = $this->instamojo->paymentRequestStatus($request_id);
        //For a safety, because i dont know
        if (isset($ret['payments'][0]['payment_id'])) {
            $payment_id = $ret['payments'][0]['payment_id'];
        }
        if (isset($ret['payments'][0]['status'])) {
            $status = $ret['payments'][0]['status'];
        }
        //On sucesss
        if ($status == 'Credit') {
            $params = array(
                'request_id' => $request_id,
                'payment_id' => $payment_id,
                'status' => $status,
            );
            $this->Payment_model->updateSuccessRecord($params);
            /*
              On success we need to update order table with username, items, quantity, order status etc
              items can be take from cart
             */
            if (isset($_SESSION['cart'])) {
                for ($i = 0; $i < $this->limit; $i++) {
                    if (isset($_SESSION['cart'][$i])) {
                        $pid = $_SESSION['cart'][$i]['pid'];
                        $item = $this->Product_model->getProductName($pid);
                        //$qty=1;//change needed
                        $qty = $_SESSION['cart'][$i]['qty'];
                        $params = array(
                            'payment_id' => $payment_id,
                            'username' => $_SESSION['user'],
                            'item' => $item,
                            'qty' => $qty, //change needed
                            'date' => date('Y-m-d'),
                            'order_status' => 'init',
                        );
                        $this->Order_model->addRecord($params);
                    }
                }
            }
        }
        //On failed
        else {
            $params = array(
                'request_id' => $request_id,
                'status' => $status,
            );
            $this->Payment_model->updateFailedRecord($params);
        }

        $data = array('payment_id' => $payment_id);
        $params = array(
            'request_id' => $request_id,
        );
        $query = $this->Payment_model->getStatus($params);
        $status = $query->row()->status;
        if ($status == 'Credit') {
            $data['status'] = $status;
            unset($_SESSION['cart']);
        } elseif ($status == 'Pending') {
            $data['status'] = 'Pending';
        } else {
            $data['status'] = 'Failed';
        }
        $this->load->view('thank', $data);
    }

}
