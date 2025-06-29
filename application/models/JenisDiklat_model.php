<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDiklat_model extends CI_Model
{
    private $table = 'scre_jenis_diklat';

    public function get_all()
    {
        $this->db->order_by('sorting', 'asc');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }
}
