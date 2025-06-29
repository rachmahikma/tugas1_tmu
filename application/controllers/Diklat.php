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
        $all = $this->Diklat_model->get_filtered($kategori);

        // Urutkan manual berdasarkan ID ASC (kalau perlu)
        usort($all, function ($a, $b) {
            return strcmp($a->id, $b->id);
        });

        // Tambahkan properti no_urut untuk setiap item
        foreach ($all as $i => $row) {
            $row->no_urut = $i + 1;
        }

        $data['diklat'] = $all;

        $this->load->view('diklat/Diklat_List', $data);
    }

    public function add()
    {
        $data['kategori_list'] = $this->Diklat_model->get_kategori(); // ← ini penting
        $this->load->view('Diklat/Diklat_Form', $data);
    }

    public function insert()
    {
        $data = [
            'id' => $this->input->post('id'), // boleh kosong, auto generate
            'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
            'kode_diklat' => $this->input->post('kode_diklat'),
            'nama_diklat' => $this->input->post('nama_diklat')
        ];

        $this->Diklat_model->insert($data);

        // Kirim notifikasi flashdata
        $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
        redirect('Diklat');
    }


    public function edit($id)
    {
        $data['row'] = $this->Diklat_model->get_by_id($id);
        $data['kategori_list'] = $this->Diklat_model->get_kategori(); // ← tambahkan ini
        $this->load->view('Diklat/Diklat_Form', $data);
    }

    public function update($id)
    {
        $this->load->model('Diklat_model');

        $data = [
            'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
            'kode_diklat' => $this->input->post('kode_diklat'),
            'nama_diklat' => $this->input->post('nama_diklat')
        ];

        $this->Diklat_model->update($id, $data);
        redirect('Diklat');
    }

    public function delete($id)
    {
        $this->load->model('Diklat_model');
        $this->Diklat_model->delete($id);
        redirect('Diklat');
    }
    public function destroy($id)
    {
        $this->Diklat_model->delete($id); // soft delete
        redirect('Diklat');
    }

    public function persyaratan($diklat_id)
    {
        $this->load->model('Persyaratan_model');

        $data['diklat_id'] = $diklat_id;
        $data['template_persyaratan'] = $this->Persyaratan_model->get_template_belum_dipilih($diklat_id);
        $data['persyaratan_dipilih'] = $this->Persyaratan_model->get_selected_by_diklat($diklat_id);

        $this->load->view('diklat/persyaratan_view', $data);
    }




    public function tambah_persyaratan($diklat_id, $persyaratan_id)
    {
        $data = [
            'id' => uniqid(),
            'diklat_id' => $diklat_id,
            'persyaratan_id' => $persyaratan_id
        ];
        $this->db->insert('scre_diklat_persyaratan', $data);
        $this->session->set_flashdata('success', 'Persyaratan berhasil ditambahkan.');
        redirect('Diklat/persyaratan/' . $diklat_id);
    }



    public function hapus_persyaratan($diklat_id, $persyaratan_id)
    {
        $this->db->where('diklat_id', $diklat_id);
        $this->db->where('persyaratan_id', $persyaratan_id);
        $this->db->delete('scre_diklat_persyaratan');

        $this->session->set_flashdata('success', 'Persyaratan berhasil dihapus.');
        redirect('Diklat/persyaratan/' . $diklat_id);
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
