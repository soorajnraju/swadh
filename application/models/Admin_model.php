<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function match($username, $password) {
        $sql = "SELECT * FROM `admin` WHERE username='" . $username . "' and password='" . $password . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
