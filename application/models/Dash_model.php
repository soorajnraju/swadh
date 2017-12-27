<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dash_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getRecords() {
        $sql = "SELECT * FROM `order` ORDER BY `date` DESC LIMIT 50";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRecordsPeriod($params) {
        $sql = "SELECT * FROM `order` WHERE `date` BETWEEN '" . $params['start_date'] . "' and '" . $params['end_date'] . "' ORDER BY `date` DESC";
        $query = $this->db->query($sql);
        return $query;
    }

}
