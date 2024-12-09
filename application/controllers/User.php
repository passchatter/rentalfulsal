<?php

class User extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('Validasi_model');
        $this->load->model('User_model');
        $this->load->model('Lapangan_model');
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        if (!$this->Validasi_model->is_user()) {
            redirect('dashboard');
        }
    }

    public function index() {
        $title['title'] = 'dashboard';
        $pemesan_id = $this->session->userdata('id');
        $bookings['bookings'] = $this->User_model->getBookingUser($pemesan_id);
        $data['bookingHari'] = $this->User_model->bookingHari($pemesan_id);
        $data['allBookings'] = $this->User_model->allBookings($pemesan_id);
        $data['konten'] = $this->load->view('user/riwayatbooking_user',$bookings,true);
        $this->load->view('templates/header',$title);
        $this->load->view("user/user_view",$data);
        $this->load->view('templates/footer');
       
    }

    public function booking(){
        $title['title'] = "booking";
        $lapangan['lapangan'] = $this->Lapangan_model->getAllLapangan();
        $data['konten'] = $this->load->view('user/booking_user',$lapangan,true);
        $pemesan_id = $this->session->userdata('id');
        $data['bookingHari'] = $this->User_model->bookingHari($pemesan_id);
        $data['allBookings'] = $this->User_model->allBookings($pemesan_id);
        $this->load->view('templates/header',$title);
        $this->load->view('user/user_view',$data);
        $this->load->view('templates/footer');
    }

}