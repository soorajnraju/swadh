<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addRecord($params) {
        $sql = "INSERT INTO `profile` VALUES ('" . $params['fname'] . "','" . $params['lname'] . "','" . $params['email'] . "','" . $params['phone'] . "','" . $params['street'] . "','" . $params['city'] . "','" . $params['state'] . "','" . $params['pin'] . "','" . $params['sq'] . "', '" . $params['ans'] . "')";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecord($params) {
        $sql = "SELECT p.*, u.password FROM `profile` p"
                . " LEFT JOIN `user` u ON p.email=u.username"
                . " WHERE `email`='" . $params['email'] . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updateRecord($params) {
        $sql = "UPDATE `profile` SET `firstname`='" . $params['fname'] . "',`lastname`='" . $params['lname'] . "',`phone`='" . $params['phone'] . "',`street`='" . $params['street'] . "',`city`='" . $params['city'] . "',`pin`='" . $params['pin'] . "', `sq`='" . $params['sq'] . "', `ans`='" . $params['ans'] . "' WHERE `email`='" . $params['email'] . "'";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSec($params) {
        $sql = "SELECT sq, ans FROM `profile` WHERE email='" . $params['username'] . "'";
        return $this->db->query($sql);
    }

}
