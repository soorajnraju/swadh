<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addRecord($params) {
        $sql = "INSERT INTO `order` (`payment_id`,`username`,`item`,`qty`,`date`,`order_status`) VALUES ('" . $params['payment_id'] . "','" . $params['username'] . "','" . $params['item'] . "'," . $params['qty'] . ",'" . $params['date'] . "','" . $params['order_status'] . "')";
        $query = $this->db->query($sql);
    }

    public function getRecord($params) {
        $sql = "SELECT * FROM `order` WHERE username='" . $params['username'] . "' ORDER BY `date` DESC LIMIT 10";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updateRecord($params) {
        $sql = "UPDATE `order` SET `order_status`='" . $params['status'] . "' WHERE `payment_id`='" . $params['payment_id'] . "'";
        $this->db->query($sql);
    }

}
