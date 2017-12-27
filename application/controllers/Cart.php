<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Payment_model');
        $this->load->library('Instamojo');
    }

    public function index() {
        redirect(base_url('cart/view'), 'refresh');
    }

    public function view() {
        $cart_data = array();
        if (isset($_SESSION['cart'])) {
            for ($i = 0; $i < $this->limit; $i++) {
                if (isset($_SESSION['cart'][$i])) {
                    $pid = $_SESSION['cart'][$i]['pid'];
                    $product_name = $this->Product_model->getProductName($pid);
                    $product_price = $this->Product_model->getProductPrice($pid);
                    $filename = $this->Product_model->getProductFile($pid);
                    $cart_data[$i]['product_price'] = $product_price;
                    $cart_data[$i]['product_name'] = $product_name;
                    $cart_data[$i]['filename'] = $filename;
                    $cart_data[$i]['pid'] = $pid;
                }
            }
            //print_r($cart_data); exit();
            //print_r($_SESSION['cart']); exit();
            $data = array('cart_data' => $cart_data, 'limit' => $this->limit);
            $this->load->view('cart', $data);
        } else {
            $this->load->view('cart');
        }
    }

    public function add() {
        //Cart limit, While Cart is full
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > $this->limit) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
        //While cart is not empty
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            for ($i = 0; $i < $this->limit; $i++) {
                if (isset($_SESSION['cart'][$i]['pid']) && $_SESSION['cart'][$i]['pid'] == $_POST['pid']) {
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    /* echo "Item already in the cart";
                      exit(); */
                } else {
                    if (!isset($_SESSION['cart'][$i]['pid'])) {
                        $_SESSION['cart'][$i]['pid'] = $_POST['pid'];
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    }
                }
            }
        }
        //while cart is empty
        else {
            $_SESSION['cart'][0]['pid'] = $_POST['pid'];
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
            /* echo "Item added to the cart";
              exit(); */
        }
    }

    public function remove($pid) {
        //print_r($_SESSION['cart']);exit();
        $i = 0;
        for (; $i < $this->limit; $i++) {
            if (isset($_SESSION['cart'][$i]))
                if ($_SESSION['cart'][$i]['pid'] == $pid) {
                    break;
                }
        }
        unset($_SESSION['cart'][$i]);
        redirect('/cart/view', 'refresh');
    }

    //Need edit and well check
    public function checkout() {
        if (!isset($_SESSION['user'])) {
            $ref = $_SERVER['HTTP_REFERER'];
            $_SESSION['frmCart'] = 1;
            redirect('login', 'refresh');
        }

        //Adding quantity into session

        for ($i = 0; $i < $this->limit; $i++) {
            if (isset($_SESSION['cart'][$i])) {
                if ($_SESSION['cart'][$i]['pid'] == $_POST['pid' . $i]) {
                    $_SESSION['cart'][$i]['qty'] = $_POST['qty' . $i];
                }
            }
        }
        //

        $vtotal = 0;
        $total = $_POST['total'];
        for ($i = 0; $i < $this->limit; $i++) {
            if (isset($_POST['pid' . $i])) {
                $unitprice = $this->Product_model->getProductPrice($_POST['pid' . $i]);
                $vtotal += $unitprice * $_POST['qty' . $i];
            }
        }

        if ($vtotal == $total) {
            //Process payment
            $pay_load = array(
                'amount' => $total,
                'purpose' => 'Swath Purchase',
                //'webhook' => 'https://soorajnraju.com/projects/ecom/hook/',
                'redirect_url' => 'https://soorajnraju.com/projects/ecom/thank/',
                'buyer_name' => $_SESSION['user_name'],
                'email' => $_SESSION['user'],
                'phone' => $_SESSION['user_phone'],
                'send_email' => false,
                'send_sms' => false,
            );
            $response = $this->instamojo->paymentRequestCreate($pay_load);
            $params = array();
            $params['username'] = $_SESSION['user'];
            $params['request_id'] = $response['id'];
            $params['amount'] = $response['amount'];
            $params['status'] = $response['status'];
            $params['date'] = date('Y-m-d');
            if ($this->Payment_model->addRecord($params))
                redirect($response['longurl'], 'refresh');
        }
        else {
            //Intruder presence
            echo "Intruder";
        }
    }

    //Warning cart will detroy 
    /* public function removeCart(){
      unset($_SESSION['cart']);
      session_destroy();
      echo "session destroyed";
      } */
}
