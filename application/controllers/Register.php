<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);
    }

    public function index() {
        $this->load->view('register/register');
    }

    public function proses() {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[scre_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('type', 'Tipe', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('register');
        }

        $data = [
            'id' => uniqid(),
            'nip' => $this->input->post('nip'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'type' => $this->input->post('type'),
        ];

        $this->User_model->insert($data);
        $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
        redirect('login');
    }
}
