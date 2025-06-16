<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDiklat_model extends CI_Model
{

    private $table = 'scre_jenis_diklat';

    public function get_all()
    {
        return $this->db
            ->where('is_exist', 1)
            ->order_by('sorting', 'ASC')
            ->get('scre_jenis_diklat')
            ->result();
    }


    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function soft_delete($id)
    {
        return $this->db->where('id', $id)->update($this->table, ['is_exist' => 0]);
    }
    public function get_dropdown_jenis_diklat()
    {
        $this->db->select('jenis_diklat');
        $this->db->where('is_exist', 1);
        $this->db->group_by('jenis_diklat');
        $this->db->order_by('jenis_diklat');
        return $this->db->get('scre_jenis_diklat')->result();
    }

}
