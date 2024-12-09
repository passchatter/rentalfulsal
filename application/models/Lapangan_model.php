<?php

class Lapangan_model extends CI_Model{
    public function getAllLapangan(){
        return $this->db->get('lapangan')->result_array();
    }
    public function getLapanganID($id){
        return $this->db->get_where('lapangan', ['id' => $id])->row_array();
        
     }
}