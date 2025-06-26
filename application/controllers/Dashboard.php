<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Tidak ada cek login di sini agar halaman bisa diakses publik
    }

    public function index() {
        // Jika sudah login, tampilkan nama; jika belum, beri default
        $data['nama_lengkap'] = $this->session->userdata('nama_lengkap') ?? 'Pengunjung';

        // Tampilkan view dashboard
        $this->load->view('dashboard', $data);
    }
}
