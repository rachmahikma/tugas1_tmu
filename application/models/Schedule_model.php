<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    public function get_by_diklat_tahun($diklat_id, $tahun_id, $tahun_pelaksanaan = null, $limit = 20, $start = 0)
    {
        $this->db->select('jadwal.*, diklat.nama_diklat, diklat.jenis_diklat');
        $this->db->from('scre_diklat_jadwal jadwal');
        $this->db->join('scre_diklat diklat', 'jadwal.diklat_id = diklat.id', 'left');

        if (!empty($diklat_id)) {
            $this->db->where('jadwal.diklat_id', $diklat_id);
        }

        if (!empty($tahun_id)) {
            $this->db->where('jadwal.diklat_tahun_id', $tahun_id);
        }

        if (!empty($tahun_pelaksanaan)) {
            $this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun_pelaksanaan);
            $this->db->where('jadwal.pelaksanaan_mulai IS NOT NULL');
        }

        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function count_by_diklat_tahun($diklat_id, $tahun_id, $tahun_pelaksanaan = null)
    {
        $this->db->from('scre_diklat_jadwal jadwal');
        $this->db->join('scre_diklat diklat', 'jadwal.diklat_id = diklat.id', 'left');

        if (!empty($diklat_id)) {
            $this->db->where('jadwal.diklat_id', $diklat_id);
        }

        if (!empty($tahun_id)) {
            $this->db->where('jadwal.diklat_tahun_id', $tahun_id);
        }

        if (!empty($tahun_pelaksanaan)) {
            $this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun_pelaksanaan);
            $this->db->where('jadwal.pelaksanaan_mulai IS NOT NULL');
        }

        return $this->db->count_all_results();
    }

    public function get_all_tahun()
    {
        $this->db->select('DISTINCT YEAR(pelaksanaan_mulai) as tahun');
        $this->db->from('scre_diklat_jadwal');
        $this->db->where('pelaksanaan_mulai IS NOT NULL');
        $this->db->order_by('tahun', 'ASC');
        return $this->db->get()->result();
    }

    public function get_all_diklat()
    {
        $this->db->select('id, nama_diklat, jenis_diklat');
        $this->db->from('scre_diklat');
        $this->db->order_by('nama_diklat', 'ASC');
        return $this->db->get()->result();
    }

    public function get_diklat_name($id)
    {
        return $this->db->get_where('scre_diklat', ['id' => $id])->row()->nama_diklat ?? '-';
    }

    public function get_jenis_diklat($id)
    {
        return $this->db->get_where('scre_diklat', ['id' => $id])->row()->jenis_diklat ?? '-';
    }

    public function get_tahun_by_diklat($diklat_id)
    {
        $this->db->select('DISTINCT diklat_tahun_id');
        $this->db->from('scre_diklat_jadwal');
        $this->db->where('diklat_id', $diklat_id);
        $this->db->order_by('diklat_tahun_id', 'ASC');
        return $this->db->get()->result();
    }
}
