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

        $tahun_kode = $this->input->get('tahun_id'); // ganti ke tahun_kode
        $diklat_kode = $this->input->get('diklat_id'); // ganti ke diklat_kode

        $tahun_pelaksanaan = null;
        if ($tahun_kode) {
            $tahun_pelaksanaan = $this->schedule_model->get_tahun_pelaksanaan_from_tahun_kode($tahun_kode);
        }

        $segment = isset($_GET['per_page']) ? (int)$_GET['per_page'] : $this->uri->segment(3);
        $start = (is_numeric($segment) && (int)$segment < 99999) ? (int)$segment : 0;

        $total_rows = $this->schedule_model->count_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan);

        $query_string = http_build_query(array_filter([
            'tahun_id' => $tahun_kode,
            'diklat_id' => $diklat_kode
        ]));
        $base_url = site_url('Schedule/tahun');
        if ($query_string) {
            $base_url .= '?' . $query_string;
        }

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

        $jadwal = $this->schedule_model->get_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan, $limit, $start);

        $data = [
            'jadwal' => $jadwal,
            'pagination' => $this->pagination->create_links(),
            'diklat_nama' => !empty($jadwal) ? ($jadwal[0]->nama_diklat ?? '-') : '-',
            'jenis_diklat' => !empty($jadwal) ? ($jadwal[0]->jenis_diklat ?? '-') : '-',
            'list_tahun' => $this->schedule_model->get_all_tahun(),
            'list_diklat' => $this->schedule_model->get_all_diklat(),
            'tahun_id' => $tahun_kode,
            'diklat_id' => $diklat_kode,
            'start' => $start
        ];

        $this->load->view('schedule/Schedule_list', $data);
    }

    public function show_by_diklat($diklat_kode)
    {
        $limit = 200;
        $start = 0;

        $jadwal = $this->schedule_model->get_by_diklat($diklat_kode, $limit, $start);

        $data = [
            'jadwal' => $jadwal,
            'pagination' => '',
            'diklat_nama' => $this->schedule_model->get_diklat_name($diklat_kode),
            'jenis_diklat' => $this->schedule_model->get_jenis_diklat($diklat_kode),
            'diklat_id' => $diklat_kode,
            'list_tahun' => $this->schedule_model->get_all_tahun(),
            'start' => $start,
            'tahun_id' => null
        ];

        $this->load->view('schedule/Schedule_list', $data);
    }

    public function show_by_tahun_diklat($tahun_kode = null, $diklat_kode = null)
    {
        $tahun_pelaksanaan = $this->schedule_model->get_tahun_pelaksanaan_from_tahun_kode($tahun_kode);
        $jadwal = $this->schedule_model->get_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan, 100, 0);

        $data = [
            'jadwal' => $jadwal,
            'diklat_nama' => $this->schedule_model->get_diklat_name($diklat_kode),
            'jenis_diklat' => $this->schedule_model->get_jenis_diklat($diklat_kode),
            'diklat_id' => $diklat_kode,
            'tahun_id' => $tahun_kode,
            'list_tahun' => $this->schedule_model->get_all_tahun(),
            'list_diklat' => $this->schedule_model->get_all_diklat(),
            'start' => 0
        ];

        $this->load->view('schedule/Schedule_list', $data);
    }
}
