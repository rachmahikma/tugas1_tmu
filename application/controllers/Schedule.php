<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Schedule_model', 'schedule_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $limit = 20;
        $tahun_id = $this->input->get('tahun_id');
        $diklat_id = $this->input->get('diklat_id');

        // Ambil segment offset dulu sebelum query
        $segment = $this->uri->segment(3);
        $start = (is_numeric($segment) && (int) $segment < 99999) ? (int) $segment : 0;

        // Hitung total data berdasarkan filter
        $total_rows = $this->schedule_model->count_by_diklat_tahun($diklat_id, $tahun_id);

        // Bangun base URL agar pagination tetap menjaga query string
        $base_url = site_url('Schedule/index');
        $query_string = http_build_query(array_filter([
            'tahun_id' => $tahun_id,
            'diklat_id' => $diklat_id
        ]));
        if ($query_string) {
            $base_url .= '?' . $query_string;
        }

        // Konfigurasi pagination
        $config = [
            'base_url' => $base_url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'uri_segment' => 3,
            'reuse_query_string' => true,
            'full_tag_open' => '<nav><ul class="pagination">',
            'full_tag_close' => '</ul></nav>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link']
        ];
        $this->pagination->initialize($config);

        // Ambil data jadwal sesuai filter dan pagination
		
        $jadwal = $this->schedule_model->get_by_diklat_tahun($diklat_id, $tahun_id, $limit, $start);

        // Info diklat jika tersedia
        $data['diklat_nama'] = !empty($jadwal) ? ($jadwal[0]->nama_diklat ?? '-') : '-';
        $data['jenis_diklat'] = !empty($jadwal) ? ($jadwal[0]->jenis_diklat ?? '-') : '-';

        // Ambil list diklat dan tahun untuk filter dropdown
        $data['list_tahun'] = $this->schedule_model->get_all_tahun();
        $data['list_diklat'] = $this->schedule_model->get_all_diklat();

        // Kirim semua ke view
        $data['jadwal'] = $jadwal;
        $data['pagination'] = $this->pagination->create_links();
        $data['tahun_id'] = $tahun_id;
        $data['diklat_id'] = $diklat_id;
        $data['start'] = $start;

        $this->load->view('schedule/Schedule_list', $data);
    }
}
