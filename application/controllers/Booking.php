<?php
class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lapangan_model');
        $this->load->model('Booking_model');
        $this->load->model('Dashboard_model');
        $this->load->model('User_model');
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    public function detailLapangan($id){
        $data['title'] = "Detail Lapangan";
        $data['lapangan'] = $this->Lapangan_model->getLapanganID($id);   
        
        $this->load->view('templates/header', $data);
        $this->load->view('booking/booking_view', $data);
        $this->load->view('templates/footer');
    }

    public function check_availability() {
        $lapangan_id = $this->input->post('lapangan_id');
        $tanggal = $this->input->post('tanggal');
        $jam_awal = $this->input->post('jam_awal');
        $jam_akhir = $this->input->post('jam_akhir');

        if ($this->Booking_model->is_time_slot_booked($lapangan_id, $tanggal, $jam_awal, $jam_akhir)) {
            echo json_encode(['status' => 'booked']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function submit_booking() {
        $lapangan_id = $this->input->post('lapangan_id');
        $tanggal = $this->input->post('tanggal');
        $jam_booking = $this->input->post('jam_booking');
        $level = $this->session->userdata('level');
        $pemesan_id = $this->session->userdata('id');
    
        if (empty($jam_booking)) {
            $this->session->set_flashdata('error', 'Silakan pilih minimal satu slot waktu.');
            redirect($level === 'admin' ? 'dashboard/booking' : 'user/booking');
        }
    
        // Urutkan jam booking
        sort($jam_booking);
        $slot_awal = explode('-', $jam_booking[0]);
        $slot_akhir = explode('-', $jam_booking[count($jam_booking) - 1]);
        $jam_awal = $slot_awal[0];
        $jam_akhir = $slot_akhir[1];
    
        // Periksa slot waktu yang bentrok
        if ($this->Booking_model->is_time_slot_booked($lapangan_id, $tanggal, $jam_awal, $jam_akhir)) {
            $this->session->set_flashdata('error', 'Slot waktu yang dipilih sudah dibooking.');
            redirect($level === 'admin' ? 'dashboard/booking' : 'user/booking');
        }
    
        // Hitung total harga
        $lapangan = $this->Lapangan_model->getLapanganID($lapangan_id);
        $total_jam = count($jam_booking);
        $total_harga = $lapangan['harga_per_jam'] * $total_jam;
    
        // Jenis transaksi
        $jenis_transaksi = ($level === 'admin') ? 'offline' : 'online';
    
        // Simpan data ke sesi untuk pembayaran
        $data_booking = [
            'pemesan_id' => $pemesan_id,
            'lapangan_id' => $lapangan_id,
            'tanggal' => $tanggal,
            'jam_awal' => $jam_awal,
            'jam_akhir' => $jam_akhir,
            'total_harga' => $total_harga,
            'jenis_transaksi' => $jenis_transaksi
        ];
        $this->session->set_userdata('data_booking', $data_booking);
    
        // Redirect ke pembayaran
        redirect('booking/payment');
    }

    public function payment() {
        $data['booking'] = $this->session->userdata('data_booking');
       
    
        if (empty($data['booking'])) {
            $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
            redirect($this->session->userdata('level') === 'admin' ? 'dashboard/booking' : 'user/booking');
        }

        if($this->session->userdata('level') === "admin"){
            $title['title'] = "pambayaran";
            $data['konten'] = $this->load->view('booking/payment_view', $data,true);
            $data['hargaDay'] = $this->Dashboard_model->Total_day();
            $data['hargaMount'] = $this->Dashboard_model->Total_mount();
            $data['bookingDay'] = $this->Dashboard_model->booking_day();
            $data['users'] = $this->Dashboard_model->getCountUser();
            $this->load->view('templates/header',$title);
            $this->load->view('dashboard/admin_view', $data);
            $this->load->view('templates/footer');
        }else{
            $pemesan_id = $this->session->userdata('id');
            $title['title'] = "pambayaran";
            $data['konten'] = $this->load->view('booking/payment_view', $data,true);
            $data['bookings'] = $this->User_model->getBookingUser($pemesan_id);
            $data['bookingHari'] = $this->User_model->bookingHari($pemesan_id);
            $data['allBookings'] = $this->User_model->allBookings($pemesan_id);
            $this->load->view("templates/header", $title);
            $this->load->view('user/user_view', $data);
            $this->load->view('templates/footer');
        }
    }

    public function confirm_booking() {
        $booking = $this->session->userdata('data_booking');
    
        if (empty($booking)) {
            $this->session->set_flashdata('error', 'Data booking tidak valid.');
            redirect($this->session->userdata('level') === 'admin' ? 'dashboard/booking' : 'user/booking');
        }
    
        $this->Booking_model->insert_booking($booking);
        $this->session->unset_userdata('data_booking');
    
        $this->session->set_flashdata('success', 'Booking berhasil disimpan!');
        redirect($this->session->userdata('level') === 'admin' ? 'dashboard/booking' : 'user/booking');
    }
    
    
    
    
  public function get_available_slots(){
      
        $lapangan_id = $this->input->post('lapangan_id');
        $tanggal = $this->input->post('tanggal');

        
        if (empty($lapangan_id) || empty($tanggal)) {
            $lapangan_id = 1;
            $tanggal = date('Y-m-d');
        }

       
        $all_slots = [
            '06:00-07:00', '07:00-08:00', '08:00-09:00',
            '09:00-10:00', '10:00-11:00', '11:00-12:00',
            '12:00-13:00', '13:00-14:00', '14:00-15:00',
            '15:00-16:00', '16:00-17:00', '17:00-18:00'
        ];

        // Ambil slot yang sudah dibooking berdasarkan lapangan_id dan tanggal
        $booked_slots = $this->Booking_model->get_booked_slots($lapangan_id, $tanggal);

        // Tentukan slot yang tersedia
        $available_slots = [];
        foreach ($all_slots as $slot) {
            // Jika slot tidak ada di dalam daftar booked_slots, maka slot tersebut tersedia
            $available_slots[$slot] = !in_array($slot, $booked_slots);
        }

       
        echo json_encode($available_slots);
    }


}
?>
