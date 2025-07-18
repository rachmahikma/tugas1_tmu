<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    public function get_all_tahun()
    {
        return $this->db->get('tahun_diklat')->result();
    }

    public function get_all_diklat()
    {
        return $this->db->get('diklat')->result();
    }

    public function get_tahun_pelaksanaan_from_tahun_kode($tahun_kode)
    {
        $this->db->where('kode_tahun', $tahun_kode);
        $query = $this->db->get('tahun_diklat')->row();
        return $query ? $query->tahun_pelaksanaan : null;
    }

    public function count_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan)
    {
        $this->db->from('jadwal_diklat');
        if ($diklat_kode) {
            $this->db->where('kode_diklat', $diklat_kode);
        }
        if ($tahun_kode) {
            $this->db->where('kode_tahun', $tahun_kode);
        }
        return $this->db->count_all_results();
    }

    public function get_by_diklat_tahun($diklat_kode, $tahun_kode, $tahun_pelaksanaan, $limit, $start)
    {
        $this->db->select('jd.*, d.nama_diklat, d.jenis_diklat, td.tahun_pelaksanaan');
        $this->db->from('jadwal_diklat jd');
        $this->db->join('diklat d', 'jd.kode_diklat = d.kode_diklat', 'left');
        $this->db->join('tahun_diklat td', 'jd.kode_tahun = td.kode_tahun', 'left');

        if ($diklat_kode) {
            $this->db->where('jd.kode_diklat', $diklat_kode);
        }
        if ($tahun_kode) {
            $this->db->where('jd.kode_tahun', $tahun_kode);
        }
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function get_by_diklat($diklat_kode, $limit, $start)
    {
        $this->db->select('jd.*, d.nama_diklat, d.jenis_diklat, td.tahun_pelaksanaan');
        $this->db->from('jadwal_diklat jd');
        $this->db->join('diklat d', 'jd.kode_diklat = d.kode_diklat', 'left');
        $this->db->join('tahun_diklat td', 'jd.kode_tahun = td.kode_tahun', 'left');
        $this->db->where('jd.kode_diklat', $diklat_kode);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function get_diklat_name($diklat_kode)
    {
        $this->db->where('kode_diklat', $diklat_kode);
        $query = $this->db->get('diklat')->row();
        return $query ? $query->nama_diklat : '-';
    }

    public function get_jenis_diklat($diklat_kode)
    {
        $this->db->where('kode_diklat', $diklat_kode);
        $query = $this->db->get('diklat')->row();
        return $query ? $query->jenis_diklat : '-';
    }
}
