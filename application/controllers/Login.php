<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }
        $this->load->view('login/login'); // Sesuaikan dengan nama file view yang baru
    }

    public function proses() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('login'));
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->verify_login($username, $password);

        if ($user) {
            $this->session->set_userdata([
                'login' => true,
                'id_user' => $user->id,
                'nama_lengkap' => $user->nama_lengkap,
                'username' => $user->username,
                'type' => $user->type
            ]);

            switch ($user->type) {
                case 'A': redirect(base_url('admin/dashboard')); break;
                case 'OL': redirect(base_url('loket/dashboard')); break;
                case 'OK': redirect(base_url('kesehatan/dashboard')); break;
                case 'OP': redirect(base_url('pelatihan/dashboard')); break;
                case 'OA': redirect(base_url('akademik/dashboard')); break;
                default: redirect(base_url('dashboard')); break;
            }
        } else {
            log_message('error', 'Login failed for username: ' . $username);
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect(base_url('login'));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
