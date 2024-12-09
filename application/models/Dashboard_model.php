<?php


class Dashboard_model extends CI_Model{
    public function getProfile($id){
        $this->db->where('id', $id);
        return $query = $this->db->get('tb_login')->row_array();
    }

    public function getBookingHariIni() {
        $this->db->select('b.id, b.pemesan_id, b.lapangan_id, b.tanggal, b.jenis_transaksi, b.total_harga, 
                           l.nama_lapangan, u.username AS nama_pemesan');
        $this->db->from('booking b');
        $this->db->join('lapangan l', 'b.lapangan_id = l.id', 'left'); 
        $this->db->join('tb_login u', 'b.pemesan_id = u.id', 'left');
        $this->db->where('b.tanggal', date('Y-m-d'));
        $this->db->order_by('b.jam_awal', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getAllBooking() {
        $this->db->select('b.id, b.pemesan_id, b.lapangan_id, b.tanggal, b.jenis_transaksi, b.total_harga, 
                           l.nama_lapangan, u.username AS nama_pemesan');
        $this->db->from('booking b');
        $this->db->join('lapangan l', 'b.lapangan_id = l.id', 'left'); 
        $this->db->join('tb_login u', 'b.pemesan_id = u.id', 'left');
        $this->db->order_by('b.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    public function Total_mount() {
        $tahun = date('Y');
        $bulan = date('m');

        $this->db->select_sum('total_harga');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $query = $this->db->get('booking');
        return $query->row()->total_harga;
    }

    public function Total_day() {
        $this->db->select_sum('total_harga');
        $this->db->where('tanggal', date('Y-m-d'));
        $query = $this->db->get('booking');
        return $query->row()->total_harga;
    }

    public function booking_day() {
        $this->db->where('tanggal', date('Y-m-d'));
        return $this->db->count_all_results('booking');
    }

    public function getAllUser() {
        $this->db->select('*');
        $this->db->from('tb_login');
        $this->db->where('level', 'user');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCountUser()
    {
        $this->db->where('level', 'user');
        return $this->db->count_all_results('tb_login');
    }

}