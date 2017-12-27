<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function match($username, $password) {
        $sql = "SELECT * FROM `user` WHERE username='" . $username . "' and password='" . $password . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addRecord($params) {
        $sql = "INSERT INTO `user` VALUES('" . $params['username'] . "','" . $params['password'] . "')";
        $ret = $this->db->query($sql);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }

    public function isExist($username) {
        $sql = "SELECT * FROM `user` WHERE username='" . $username . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePass($params) {
        $sql = "UPDATE `user` SET password='" . $params['password'] . "' WHERE username='" . $params['email'] . "'";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

}
