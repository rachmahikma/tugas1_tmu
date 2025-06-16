<?php
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($username, $password) {
        // Pastikan input tidak kosong
        $username = trim(strtolower($username));
        $password = trim($password);

        if (empty($username) || empty($password)) {
            log_message('error', 'Login gagal: Username atau password kosong.');
            return false;
        }

        $query = $this->db->get_where('scre_user', ['username' => $username]);
        $user = $query->row();

        if (!$user) {
            log_message('error', 'Login gagal: User tidak ditemukan untuk username - ' . $username);
            return false;
        }

        if (!password_verify($password, $user->password)) {
            log_message('error', 'Login gagal: Password salah untuk username - ' . $username);
            return false;
        }

        log_message('info', 'User berhasil login: ' . json_encode($user));
        return $user;
    }
}
