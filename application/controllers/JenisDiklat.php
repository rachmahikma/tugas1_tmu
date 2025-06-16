<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDiklat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('JenisDiklat_model');
    }

    public function index()
    {
        $data['jenis_diklat'] = $this->JenisDiklat_model->get_all();
        $this->load->view('JenisDiklat/Jenis_Diklat_List', $data);
    }

    public function add()
    {
        $data['dropdown_jenis'] = $this->JenisDiklat_model->get_dropdown_jenis_diklat();
        $this->load->view('JenisDiklat/Jenis_Diklat_Form', $data);
    }


    public function insert()
    {
        $data = [
            'id' => $this->input->post('id'),
            'jenis_diklat' => $this->input->post('jenis_diklat'),
            'category' => $this->input->post('category'),
            'sorting' => $this->input->post('sorting'),
            'is_exist' => 1
        ];
        $this->JenisDiklat_model->insert($data);
        redirect('JenisDiklat');
    }

    public function edit($id)
    {
        $data['row'] = $this->JenisDiklat_model->get_by_id($id);
        $data['dropdown_jenis'] = $this->JenisDiklat_model->get_dropdown_jenis_diklat();
        $this->load->view('JenisDiklat/Jenis_Diklat_Form', $data);
    }

    public function update($id)
    {
        $data = [
            'jenis_diklat' => $this->input->post('jenis_diklat'),
            'category' => $this->input->post('category'),
            'sorting' => $this->input->post('sorting')
        ];
        $this->JenisDiklat_model->update($id, $data);
        redirect('JenisDiklat');
    }

    public function delete($id)
    {
        $data['row'] = $this->JenisDiklat_model->get_by_id($id);
        $this->load->view('JenisDiklat/Jenis_Diklat_Confirm_Delete', $data);
    }

    public function destroy($id)
    {
        $this->JenisDiklat_model->soft_delete($id);
        redirect('JenisDiklat');
    }
}
