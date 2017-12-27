<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function find($param) {
        $sql = "SELECT * FROM `product` WHERE `product_name` LIKE '%" . $param . "%' ORDER BY `product_name` ASC LIMIT 100";
        $query = $this->db->query($sql);
        return $query;
    }

}
