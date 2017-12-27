<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function getAll() {
        $sql = "SELECT * FROM `product`";
        $query = $this->db->query($sql);
        $data = array('query' => $query);
        return $data;
    }

    public function get9() {
        $sql = "SELECT * FROM `product` LIMIT 9";
        $query = $this->db->query($sql);
        $data = array('query' => $query);
        return $data;
    }

    public function get1($pid) {
        $sql = "SELECT * FROM `product` WHERE pid=" . $pid . "";
        $query = $this->db->query($sql);
        $data = array('query' => $query);
        return $data;
    }

    public function getProductName($pid) {
        $sql = "SELECT product_name FROM `product` WHERE pid=" . $pid . "";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->product_name;
    }

    public function getProductPrice($pid) {
        $sql = "SELECT product_price FROM `product` WHERE pid=" . $pid . "";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->product_price;
    }

    public function getProductFile($pid) {
        $sql = "SELECT filename FROM `product` WHERE pid=" . $pid . "";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->filename;
    }

    public function add($params) {
        $sql = "INSERT INTO `product`(`product_name`,`product_price`,`product_desc`,`filename`) VALUES('" . $params['product_name'] . "','" . $params['product_price'] . "','" . $params['product_desc'] . "','" . $params['filename'] . "')";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($params) {
        if (isset($params['filename'])) {
            $sql = "UPDATE `product` SET `product_name`='" . $params['product_name'] . "',`product_price`='" . $params['product_price'] . "',`product_desc`='" . $params['product_desc'] . "',`filename`='" . $params['filename'] . "' WHERE `pid`='" . $params['pid'] . "'";
            if ($this->db->query($sql)) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE `product` SET `product_name`='" . $params['product_name'] . "',`product_price`='" . $params['product_price'] . "',`product_desc`='" . $params['product_desc'] . "' WHERE `pid`='" . $params['pid'] . "'";
            if ($this->db->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function remove($pid) {
        $sql = "DELETE FROM `product` WHERE `pid`='" . $pid . "'";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

}
