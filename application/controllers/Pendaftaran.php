<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        $data['list_diklat'] = $this->diklat_model->get_all();
        $this->load->view('pendaftaran/form', $data);
    }

    public function get_tahun($diklat_id) {
        $tahun = $this->diklattahun_model->get_all();
        $result = array();
        foreach($tahun as $t) {
            if($t->diklat_id == $diklat_id && $t->is_exist == 1) {
                $result[] = $t;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function get_schedule($tahun_id) {
        $jadwal = $this->schedule_model->get_all($tahun_id);
        header('Content-Type: application/json');
        echo json_encode($schedule);
    }

    public function simpan() {
        // Proses simpan pendaftaran di sini
        // ...
        $this->session->set_flashdata('success', 'Pendaftaran berhasil!');
        redirect('pendaftaran');
    }
}
