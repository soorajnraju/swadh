<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addRecord($params) {
        $sql = "INSERT INTO `payment` (`request_id`,`username`,`amount`,`date`,`status`) VALUES('" . $params['request_id'] . "','" . $params['username'] . "','" . $params['amount'] . "','" . $params['date'] . "','" . $params['status'] . "')";
        if ($this->db->query($sql))
            return true;
        else
            return false;
    }

    //get last payment record of that user
    public function getStatus($params) {
        $sql = "SELECT status FROM `payment` WHERE request_id='" . $params['request_id'] . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updateSuccessRecord($params) {
        $sql = "UPDATE `payment` SET payment_id='" . $params['payment_id'] . "', status='" . $params['status'] . "' WHERE request_id='" . $params['request_id'] . "'";
        $ret = $this->db->query($sql);
    }

    public function updateFailedRecord($params) {
        $sql = "UPDATE `payment` SET status='" . $params['status'] . "' WHERE request_id='" . $params['request_id'] . "'";
        $ret = $this->db->query($sql);
    }

}
