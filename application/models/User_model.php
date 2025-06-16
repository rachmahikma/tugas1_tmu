<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menyimpan data pengguna ke dalam database dengan transaksi
    public function insert($data) {
        $this->db->trans_start();
        $insert = $this->db->insert('scre_user', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() && $insert) {
            log_message('info', 'User berhasil didaftarkan: ' . json_encode($data));
            return true;
        } else {
            log_message('error', 'Kesalahan saat menyimpan data pengguna: ' . json_encode($data));
            return false;
        }
    }
}
