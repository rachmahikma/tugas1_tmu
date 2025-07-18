<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    public function get_tahun_pelaksanaan_from_tahun_kode($tahun_kode)
    {
        $this->db->select('tahun');
        $this->db->from('scre_diklat_tahun');
        $this->db->where('kode_unik', $tahun_kode);
        $result = $this->db->get()->row();
        return $result ? (int) $result->tahun : null;
    }

    public function get_by_diklat($diklat_kode, $limit = 100, $start = 0)
    {
        $this->db->select('jadwal.*, diklat.nama_diklat, diklat.jenis_diklat');
        $this->db->from('scre_diklat_jadwal jadwal');
        $this->db->join('scre_diklat diklat', 'jadwal.diklat_kode = diklat.kode_unik', 'left');
        $this->db->where('jadwal.diklat_kode', $diklat_kode);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
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
        $this->db->select('kode_unik, nama_diklat, jenis_diklat');
        $this->db->from('scre_diklat');
        $this->db->order_by('nama_diklat', 'ASC');
        return $this->db->get()->result();
    }

    public function get_diklat_name($diklat_kode)
    {
        return $this->db->get_where('scre_diklat', ['kode_unik' => $diklat_kode])->row()->nama_diklat ?? '-';
    }

    public function get_jenis_diklat($diklat_kode)
    {
        return $this->db->get_where('scre_diklat', ['kode_unik' => $diklat_kode])->row()->jenis_diklat ?? '-';
    }

    public function get_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan, $limit = 100, $start = 0)
    {
        $this->db->select('jadwal.*, diklat.nama_diklat, diklat.jenis_diklat');
        $this->db->from('scre_diklat_jadwal jadwal');
        $this->db->join('scre_diklat diklat', 'jadwal.diklat_kode = diklat.kode_unik', 'left');
        $this->db->where('jadwal.diklat_kode', $diklat_kode);

        if (!empty($tahun_kode)) {
            $this->db->where('jadwal.diklat_tahun_kode', $tahun_kode);
        }

        if (!empty($tahun_pelaksanaan)) {
            $this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun_pelaksanaan);
            $this->db->where('jadwal.pelaksanaan_mulai IS NOT NULL');
        }

        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function count_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan)
    {
        $this->db->from('scre_diklat_jadwal jadwal');
        $this->db->where('jadwal.diklat_kode', $diklat_kode);

        if (!empty($tahun_kode)) {
            $this->db->where('jadwal.diklat_tahun_kode', $tahun_kode);
        }

        if (!empty($tahun_pelaksanaan)) {
            $this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun_pelaksanaan);
            $this->db->where('jadwal.pelaksanaan_mulai IS NOT NULL');
        }

        return $this->db->count_all_results();
    }
}
