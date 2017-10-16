<?php if (!defined('BASEPATH')) exit ('No redirect access allowed');
class Nilai_model extends CI_Model
{
	public $table='mengajar';
	function __construct()
	{
		parent::__construct();
	}
	function kelas($id,$mapel)
	{
		$this->db->where(array('username'=>$id,'id_mapel'=>$mapel));
		$this->db->join('rombel','mengajar.id_kelas=rombel.id_kelas');
		$query=$this->db->get($this->table);
		return $query->result();
	}
	function mapel($id)
	{
		$this->db->where('username',$id);
		$this->db->select('*');
		$this->db->group_by('mengajar.id_mapel');
		$this->db->join('mapel','mengajar.id_mapel=mapel.id_mapel');
		$query=$this->db->get($this->table);
		return $query->result();
	}
	function siswa($kelas)
	{
		$this->db->where('id_kelas',$kelas);
		$this->db->select('*');
		$query=$this->db->get('siswa');
		return $query->result();
	}
	function kd($mapel)
	{
		$this->db->where('id_mapel',$mapel);
		$this->db->select('*');
		$query=$this->db->get('kd');
		return $query->result();
	}
	function kd_select($mapel,$id_kd)
	{
		$this->db->where('id_mapel',$mapel);
		$this->db->where('id_kd',$id_kd);
		$this->db->select('*');
		$query=$this->db->get('kd');
		return $query->result();
	}
	function simpan_nilai($id_siswa,$id_mapel,$id_kd,$nilai)
    {
		$siswa = array(
            'id_siswa' => $id_siswa,
            'id_mapel' => $id_mapel,
            'id_kd' => $id_kd,
			'nilai' =>$nilai
        );
        $this->db->insert($this->db_tabel, $siswa);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
}