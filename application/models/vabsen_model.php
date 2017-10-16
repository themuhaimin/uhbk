<?php

class Vabsen_model extends CI_Model {

    public $db_tabel = 'absen';

    // cari data absen di kelas yang dipilih pada semester yang sedang aktif
	public function rekap($nis, $id_semester)
	{
		$this->db->where(array('absen.nis'=>$nis,'absen.id_semester'=>$id_semester));
		$this->db->select('*');
		$this->db->join('siswa','siswa.nis=absen.nis');
		$query=$this->db->get('absen');
		return $query->result();
		}
		public function biodata($nis)
	{
		$this->db->where(array('nis'=>$nis));
		$this->db->select('*');
		$this->db->distinct('*');
		$query=$this->db->get('siswa');
		return $query->result();
		}
}