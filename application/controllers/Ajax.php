<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Ajax
 *
 * @author <soorajnraju>
 */
class Ajax extends CI_Controller {

    public function __contsruct() {
        parent::__construct();
    }

    public function getProfile() {
        $this->load->model('Profile_model');
        $username = $this->db->escape_str($_POST['txtuser']);
        $params = array('username' => $username);
        $query = $this->Profile_model->getSec($params);
        if ($query->num_rows() <= 0) {
            echo "<span class='error' style='color:red; font-weight: bold'>Invalid username</span>";
            return;
        }
        $row = $query->row();
        $html = "<span class='question'>Security Question: " . $row->sq . "</span>"
                . "<input class='form-control input-lg' type='text' name='txtans' style='display: block;' placeholder='Answer'/>";
        echo $html;
    }

}
