<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

    }

    public function index()
    {
        $this->load->view('dashboard');
    }
}
