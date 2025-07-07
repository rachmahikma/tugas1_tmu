<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat_model extends CI_Model
{
    private $table = 'scre_diklat';

    // Ambil semua kategori dari tabel scre_jenis_diklat
    public function get_kategori()
    {
        return $this->db
            ->where('is_exist', 1)
            ->order_by('sorting', 'ASC')
            ->get('scre_jenis_diklat')
            ->result();
    }


    // Ambil semua diklat, bisa difilter per kategori
    public function get_filtered($kategori = null)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from($this->table . ' d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.is_exist', 1);
        if ($kategori) {
            $this->db->where('d.jenis_diklat_id', $kategori);
        }
        $this->db->order_by('j.sorting ASC, d.kode_diklat ASC');
        return $this->db->get()->result();
    }

    // Ambil 1 data berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Simpan data baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data berdasarkan ID
    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    // Soft delete: hanya ubah is_exist = 0
    public function delete($id)
    {
        return $this->db->where('id', $id)->update($this->table, ['is_exist' => 0]);
    }
    public function get_all()
    {
        return $this->db->get_where($this->table, ['is_exist' => 1])->result();
    }
    public function get_by_nama_jenis($nama_diklat, $jenis_diklat)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat j', 'd.jenis_diklat_id = j.id');
        $this->db->where('d.nama_diklat', $nama_diklat);
        $this->db->where('j.jenis_diklat', $jenis_diklat);
        return $this->db->get()->row();
    }
    public function get_detail_by_id($id)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.id', $id);
        return $this->db->get()->row();
    }

// ✅ Ambil tahun diklat berdasarkan diklat_id
    public function get_tahun_by_diklat($diklat_id)
    {
        return $this->db
            ->where('diklat_id', $diklat_id)
            ->where('is_exist', 1)
            ->order_by('tahun', 'DESC')
            ->get($this->tahun_table)
            ->result();
    }

    // ✅ Ambil 1 tahun diklat berdasarkan ID tahun
    public function get_tahun_by_id($tahun_id)
    {
        return $this->db->get_where($this->tahun_table, ['id' => $tahun_id])->row();
    }

    // ✅ Insert tahun diklat
    public function insert_tahun($data)
    {
        return $this->db->insert($this->tahun_table, $data);
    }

    // ✅ Update tahun diklat
    public function update_tahun($tahun_id, $data)
    {
        return $this->db->where('id', $tahun_id)->update($this->tahun_table, $data);
    }

    // ✅ Soft delete tahun diklat
    public function delete_tahun($tahun_id)
    {
        return $this->db->where('id', $tahun_id)->update($this->tahun_table, ['is_exist' => 0]);
    }
}
