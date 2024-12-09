<?php


class Login extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Login_model");
    }

    function index(){
        $data['title'] = "login";
        $this->load->view("templates/header", $data);
        $this->load->view("auth/login_view");
        $this->load->view("templates/footer");
    }

    function register(){
        $data['title'] = "register";
        $this->load->view("templates/header", $data);
        $this->load->view("auth/register_view");
        $this->load->view("templates/footer");
    }

    function prosesRegister(){
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_login.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_login.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');


        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'register';
            $this->load->view("templates/header", $data);
            $this->load->view('auth/register_view');
            $this->load->view('templates/footer');
        } else {
            // Proses data
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'level' => 'user',
            ];

            
            if ($this->Login_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('login/');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
                $this->load->view('login/register');
            }
        }
    }

    public function proseslogin(){
        $Username = $this->input->post('Username');
        $Password = $this->input->post('Password');

        $sql = "SELECT * FROM tb_login WHERE username = ?";
        $query = $this->db->query($sql, array($Username));

        if ($query->num_rows() > 0) {
            $data = $query->row();
            if (password_verify($Password, $data->password)) {
                $array = array(
                    'id' => $data->id,
                    'username' => $data->username,
                    'email' => $data->email,
                    'nama_lengkap' => $data->nama_lengkap,
                    'level' => $data->level,
                );
                $this->session->set_userdata($array);

                if ($data->level === 'admin') {
                    redirect('dashboard', 'refresh');
                } else if ($data->level === 'user') {
                    redirect('user', 'refresh');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Password Salah...');
                redirect('login', 'refresh');
            }
        } else {

            $this->session->set_flashdata('pesan', 'Username tidak ditemukan...');
            redirect('login', 'refresh');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}