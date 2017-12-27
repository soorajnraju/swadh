<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hook extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Payment_model');
    }

    public function index() {

        /*
          Basic PHP script to handle Instamojo RAP webhook.
         */

        $data = $_POST;
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.
        $ver = explode('.', phpversion());
        $major = (int) $ver[0];
        $minor = (int) $ver[1];
        if ($major >= 5 and $minor >= 4) {
            ksort($data, SORT_STRING | SORT_FLAG_CASE);
        } else {
            uksort($data, 'strcasecmp');
        }
        // You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
        // Pass the 'salt' without <>
        $mac_calculated = hash_hmac("sha1", implode("|", $data), "d8f85a5d9c62444880051d22ba472780");
        if ($mac_provided == $mac_calculated) {
            if ($data['status'] == "Credit") {
                // Payment was successful, mark it as successful in your database.
                // You can acess payment_request_id, purpose etc here.
                $params = array(
                    'payment_request_id' => $data['payment_request_id'],
                    'payment_id' => $data['payment_id'],
                    'status' => $data['status'],
                );
                $this->Payment_model->updateSuccessRecord($params);
            } else {
                // Payment was unsuccessful, mark it as failed in your database.
                // You can acess payment_request_id, purpose etc here.
                $params = array(
                    'payment_request_id' => $data['payment_request_id'],
                    'status' => $data['status'],
                );
                $this->Payment_model->updateFailedRecord($params);
            }
        } else {
            echo "MAC mismatch";
        }
    }

}
