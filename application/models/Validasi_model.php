<?php
class Validasi_model extends CI_Model {

    public function is_admin() {

        $level = $this->session->userdata('level');

        if ($level === 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function is_user() {

        $level = $this->session->userdata('level');
        if ($level === 'user') {
            return true;
        } else {
            return false;
        }
    }
    
}
