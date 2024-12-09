<?php
class Booking_model extends CI_Model {

    public function get_booking_by_date($lapangan_id, $tanggal) {
        $this->db->where('lapangan_id', $lapangan_id);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get('booking')->result_array();
    }

    public function insert_booking($data) {
        return $this->db->insert('booking', $data);
    }

    public function is_time_slot_booked($lapangan_id, $tanggal, $jam_awal, $jam_akhir) {
        $this->db->where('lapangan_id', $lapangan_id);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jam_awal <', $jam_akhir);
        $this->db->where('jam_akhir >', $jam_awal);
        return $this->db->get('booking')->num_rows() > 0;
    }

    
    public function get_booked_slots($lapangan_id, $tanggal){
        $this->db->select('jam_awal, jam_akhir');
        $this->db->where('lapangan_id', $lapangan_id);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('booking');

        $booked_slots = [];
        foreach ($query->result() as $row) {
           
            $start_time = strtotime($row->jam_awal);
            $end_time = strtotime($row->jam_akhir);

            while ($start_time < $end_time) {
                $slot_start = date('H:i', $start_time);
                $slot_end = date('H:i', strtotime('+1 hour', $start_time));
                $booked_slots[] = $slot_start . '-' . $slot_end;

                $start_time = strtotime('+1 hour', $start_time);
            }
        }

        return $booked_slots;
    }

   

}
?>
