<?php


class Login_model extends CI_model{
    public function register($data){
        return $this->db->insert('tb_login', $data);
    }
}