<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
	public function get_by_filter($tahun = null, $diklat_id = null, $limit = 20, $start = 0)
	{
		$this->db->select('jadwal.*, diklat.nama_diklat, diklat.jenis_diklat');
		$this->db->from('scre_diklat_jadwal jadwal');
		$this->db->join('scre_diklat diklat', 'jadwal.diklat_id = diklat.id', 'left');

		if (!empty($tahun)) {
			$this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun);
		}

		if (!empty($diklat_id)) {
			$this->db->where('jadwal.diklat_id', $diklat_id);
		}

		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}

	public function count_by_filter($tahun = null, $diklat_id = null)
	{
		$this->db->from('scre_diklat_jadwal jadwal');
		$this->db->join('scre_diklat diklat', 'jadwal.diklat_id = diklat.id', 'left');

		if (!empty($tahun)) {
			$this->db->where('YEAR(jadwal.pelaksanaan_mulai)', $tahun);
		}
		if (!empty($diklat_id)) {
			$this->db->where('jadwal.diklat_id', $diklat_id);
		}


		return $this->db->count_all_results();
	}

	public function get_jadwal_with_pagination($tahun, $diklat_id, $limit, $start)
	{
		return $this->get_by_filter($tahun, $diklat_id, $limit, $start);
	}

	public function get_jadwal_count($tahun, $diklat_id)
	{
		return $this->count_by_filter($tahun, $diklat_id);
	}
}
