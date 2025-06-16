<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Diklat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kategori = $this->input->get('kategori');
        $data['kategori_list'] = $this->Diklat_model->get_kategori();
        $data['diklat'] = $this->Diklat_model->get_filtered($kategori);
        $this->load->view('Diklat/Diklat_List', $data);
    }

    public function add()
    {
        $data['kategori_list'] = $this->Diklat_model->get_kategori(); // ← ini penting
        $this->load->view('Diklat/Diklat_Form', $data);
    }

    public function insert()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $data['kategori_list'] = $this->Diklat_model->get_kategori();
            $this->load->view('Diklat/Diklat_Form', $data);
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'nama_diklat' => $this->input->post('nama_diklat'),
                'kode_diklat' => $this->input->post('kode_diklat'),
                'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
                'check_kesehatan' => $this->input->post('check_kesehatan'),
                'is_exist' => 1
            ];
            $this->Diklat_model->insert($data);
            redirect('Diklat');
        }
    }

    public function edit($id)
    {
        $data['row'] = $this->Diklat_model->get_by_id($id);
        $data['kategori_list'] = $this->Diklat_model->get_kategori();
        $this->load->view('Diklat/Diklat_Form', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_diklat' => $this->input->post('nama_diklat'),
            'kode_diklat' => $this->input->post('kode_diklat'),
            'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
            'check_kesehatan' => $this->input->post('check_kesehatan')
        ];
        $this->Diklat_model->update($id, $data);
        redirect('Diklat');
    }

    public function delete($id)
    {
        $data['row'] = $this->Diklat_model->get_by_id($id);
        $this->load->view('Diklat/Diklat_Delete', $data);
    }

    public function destroy($id)
    {
        $this->Diklat_model->delete($id); // soft delete
        redirect('Diklat');
    }

    public function persyaratan($id)
    {
        // sementara hanya tampil teks
        echo "Halaman Persyaratan untuk Diklat ID: " . $id;
    }

    public function tahun($id)
    {
        // sementara hanya tampil teks
        echo "Halaman Tahun Diklat untuk Diklat ID: " . $id;
    }

    private function _rules()
    {
        $this->form_validation->set_rules('nama_diklat', 'Nama Diklat', 'required');
        $this->form_validation->set_rules('kode_diklat', 'Kode Diklat', 'required');
        $this->form_validation->set_rules('jenis_diklat_id', 'Kategori', 'required');
        $this->form_validation->set_rules('check_kesehatan', 'Pemeriksaan Kesehatan', 'required');
    }
}
