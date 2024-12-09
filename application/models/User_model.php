<?php

class User_model extends CI_Model{
    public function getProfile(){
        return $this->db->get('tb_login')->result_array();
    }

    public function getBookingUser($id){
        $this->db->select('booking.*, lapangan.nama_lapangan');
        $this->db->from('booking');
        $this->db->join('lapangan', 'lapangan.id = booking.lapangan_id', 'left');
        $this->db->where('booking.pemesan_id', $id);
        $this->db->order_by('booking.tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function bookingHari($pemesan_id)
    {
        $this->db->where('pemesan_id', $pemesan_id);
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        return $this->db->count_all_results('booking');
    }
  
    public function allBookings($pemesan_id)
    {
        $this->db->where('pemesan_id', $pemesan_id);
        return $this->db->count_all_results('booking');
    }

    


}