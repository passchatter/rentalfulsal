<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Validasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Lapangan_model');
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        if (!$this->Validasi_model->is_admin()) {
            redirect('user');
        }
    }

    public function index() {
        $bookings['bookings'] = $this->Dashboard_model->getBookingHariIni();
        $bookings['titlebooking'] = "Daftar Booking Hari Ini";
        $data['konten'] = $this->load->view('dashboard/booking_das',$bookings,true);
        $data['hargaDay'] = $this->Dashboard_model->Total_day();
        $data['hargaMount'] = $this->Dashboard_model->Total_mount();
        $data['bookingDay'] = $this->Dashboard_model->booking_day();
        $data['users'] = $this->Dashboard_model->getCountUser();
        $title['title'] = 'dashboard';
        $this->load->view("templates/header", $title);
        $this->load->view("dashboard/admin_view",$data);
        $this->load->view("templates/footer");
    }

    public function lapangan(){
        $lapangan['lapangan'] = $this->Lapangan_model->getAllLapangan();
        $data['konten'] = $this->load->view('dashboard/lapangan_das',$lapangan,true);
        $data['hargaDay'] = $this->Dashboard_model->Total_day();
        $data['hargaMount'] = $this->Dashboard_model->Total_mount();
        $data['bookingDay'] = $this->Dashboard_model->booking_day();
        $data['users'] = $this->Dashboard_model->getCountUser();
        $title['title'] = 'lapangan';
        $this->load->view("templates/header", $title);
        $this->load->view("dashboard/admin_view",$data);
        $this->load->view("templates/footer");
    }


    public function user(){
        $users['users'] = $this->Dashboard_model->getAllUser();
        $data['konten'] = $this->load->view('dashboard/user_das',$users,true);
        $data['hargaDay'] = $this->Dashboard_model->Total_day();
        $data['hargaMount'] = $this->Dashboard_model->Total_mount();
        $data['bookingDay'] = $this->Dashboard_model->booking_day();
        $data['users'] = $this->Dashboard_model->getCountUser();
        $title['title'] = 'user';
        $this->load->view("templates/header", $title);
        $this->load->view("dashboard/admin_view",$data);
        $this->load->view("templates/footer");
    }

    public function booking(){
        $bookings['bookings'] = $this->Dashboard_model->getAllBooking();
        $bookings['titlebooking'] = "Daftar Semua Booking";
        $lapangan['lapangan'] = $this->Lapangan_model->getAllLapangan();
        $data['form'] = $this->load->view('user/booking_user',$lapangan,true);
        $data['konten'] = $this->load->view('dashboard/booking_das',$bookings,true);
        $data['hargaDay'] = $this->Dashboard_model->Total_day();
        $data['hargaMount'] = $this->Dashboard_model->Total_mount();
        $data['bookingDay'] = $this->Dashboard_model->booking_day();
        $data['users'] = $this->Dashboard_model->getCountUser();
        $title['title'] = 'booking';
        $this->load->view("templates/header", $title);
        $this->load->view("dashboard/admin_view",$data);
        $this->load->view("templates/footer");
    }

}
