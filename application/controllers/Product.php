<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function view($pid) {
        $data = $this->Product_model->get1($pid);
        $this->load->view('product', $data);
    }

    public function add() {
        if (isset($_SESSION['admin'])) {
            $this->load->view('product_new');
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function addAction() {
        if (isset($_SESSION['admin'])) {
            $data = array();
            if (isset($_POST['txtproductname']) && isset($_POST['txtproductprice']) && isset($_POST['txtproductdesc'])) {
                $target_dir = "./uploads/";
                $target_file = '';
                $product_name = $this->db->escape_str($_POST['txtproductname']);
                $product_price = $this->db->escape_str($_POST['txtproductprice']);
                $product_desc = $this->db->escape_str($_POST['txtproductdesc']);
                if (isset($_FILES["productimage"]["tmp_name"])) {
                    $tmpname = $_FILES["productimage"]["tmp_name"];
                    $filename = md5(basename($_FILES["productimage"]["name"]));
                    $target_file = $target_dir . $filename;
                    if (move_uploaded_file($tmpname, $target_file)) {
                        $data['success'] = 1;
                    } else {
                        $data['error'] = 1;
                    }
                } else {
                    $data['error'] = 1;
                }
                $params = array(
                    'product_name' => $product_name,
                    'product_price' => $product_price,
                    'product_desc' => $product_desc,
                    'filename' => $filename,
                );
                if ($this->Product_model->add($params)) {
                    if (isset($data['error'])) {
                        $data['success'] = 1;
                        unset($data['error']);
                    }
                    $this->load->view('product_new', $data);
                } else {
                    $data['error'] = 1;
                    $this->load->view('product_new', $data);
                }
            } else {
                $data['error'] = 1;
                $this->load->view('product_new', $data);
            }
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function edit($pid) {
        if (isset($_SESSION['admin'])) {
            $ret = $this->Product_model->get1($pid);
            $query = $ret['query'];
            $row = $query->row();
            $data['row'] = $row;
            $this->load->view('product_edit', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function editAction() {
        if (isset($_SESSION['admin'])) {
            $data = array();
            if (isset($_POST['txtproductname']) && isset($_POST['txtproductprice']) && isset($_POST['txtproductdesc']) && isset($_POST['pid'])) {
                $target_dir = "./uploads/";
                $target_file = '';
                $pid = $_POST['pid'];
                $filename = '';
                $product_name = $this->db->escape_str($_POST['txtproductname']);
                $product_price = $this->db->escape_str($_POST['txtproductprice']);
                $product_desc = $this->db->escape_str($_POST['txtproductdesc']);
                if (isset($_FILES["productimage"]["tmp_name"])) {
                    $tmpname = $_FILES["productimage"]["tmp_name"];
                    $filename = md5(basename($_FILES["productimage"]["name"]));
                    $target_file = $target_dir . $filename;
                    if (move_uploaded_file($tmpname, $target_file)) {
                        /* $param['filename']=$target_file;
                          $this->load->library('ResizeImage', $param);//
                          $this->resizeimage->resizeTo(800, 300, 'exact');//
                          $this->resizeimage->saveImage($target_file);// */
                        $data['success'] = 1;
                    } else {
                        $data['error'] = 1;
                    }
                }
                $params = array(
                    'pid' => $pid,
                    'product_name' => $product_name,
                    'product_price' => $product_price,
                    'product_desc' => $product_desc,
                );

                if (isset($data['success'])) {
                    $params['filename'] = $filename;
                }

                if ($this->Product_model->update($params)) {
                    if (isset($data['error'])) {
                        $data['success'] = 1;
                        unset($data['error']);
                    }
                    $this->load->view('product_edit', $data);
                } else {
                    $data['error'] = 1;
                    $this->load->view('product_edit', $data);
                }
            } else {
                $data['error'] = 1;
                $this->load->view('product_edit', $data);
            }
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function remove($pid) {
        $this->Product_model->remove($pid);
        redirect('dash/product', 'refresh');
    }

}
