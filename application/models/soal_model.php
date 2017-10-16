<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Soal_model extends CI_Model {
    //cek Ujian yang diaktifkan
	public function ujian_aktif()
	{
              return $this->db->select('*')
						->where('status','1')
                        ->get('ujian')
                        ->result();
	}
	public function jumlah_soal($id_ujian)
	{
              return $this->db->query("select * from soal where id_ujian='$id_ujian'");
	}
	public function acak_soal($id_ujian,$limit)
	{
              return $this->db->select('*')
						->where('id_ujian',$id_ujian)
						->limit($limit,0)
						->order_by('id_soal','RANDOM')
                        ->get('soal')
                        ->result();
	}
    // keluarkan soal
    public function cari_soal($id_soal,$id_ujian)
	{
              return $this->db->select('*')
                        ->where('id_soal',$id_soal)
						->where('id_ujian',$id_ujian)
                        ->get('soal')
                        ->result();
	}
	//lihat yang dijawab
	public function jawaban($id_soal,$nis)
	{
              return $this->db->select('*')
						->where('id_soal',$id_soal)
						->where('nis',$nis)
						->where('id_ajar',$this->session->userdata('id_ajar'))
                        ->get('jawaban')
                        ->result();
	}
// lihat waktu tersisa
    public function hasil()
	{
	$id_ujian = $this->session->userdata('id_ujian');
	$nis = $this->session->userdata('nis');
              return $this->db->select('*')
                        ->where('nis',$nis)
						->where('id_ujian',$id_ujian)
						->where('id_ajar',$this->session->userdata('id_ajar'))
                        ->get('hasil')
                        ->result();
	}
    public function cari($nis)
    {
        return $this->db->where('nis', $nis)
            ->limit(1)
            ->get($this->db_tabel)
            ->row();
    }

   
    public function hitung_semua()
    {
        return $this->db->count_all($this->db_tabel);
    }
	public function cekoption($id_soal,$nis)
    {
		  $id_ujian = $this->session->userdata('id_ujian');
	      return $this->db->select('*')
                        ->where('id_soal',$id_soal)
						->where('nis',$nis)
						->where('id_ujian',$id_ujian)
						->where('id_ajar',$this->session->userdata('id_ajar'))
                        ->get('jawaban')
                        ->result();
						
	}
    public function tambahjawaban($id_soal,$kunci)
    {	
		$option=$this->input->post('RadioGroup1');
		if($option==$kunci) {
		$skor="1";
		}
		else {
		$skor="0";
		}
        $jawaban = array(
			'id_soal' => $id_soal,
            'nis' => $this->session->userdata('nis'),
            'id_ujian' => $this->session->userdata('id_ujian'),
            'jawaban' => $option,
			'skor' => $skor,
			'id_ajar'=>$this->session->userdata('id_ajar')
        );
        $this->db->insert('jawaban', $jawaban);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function updatejawaban($id_soal,$kunci)
    {
	    $option=$this->input->post('RadioGroup1');
		if($option==$kunci) {
		$skor="1";
		}
		else {
		$skor="0";
		}
        $jawaban = array(
            'jawaban'=>$option,
			'skor'=> $skor,
        );
		$id_ujian=$this->session->userdata('id_ujian');
		$nis=$this->session->userdata('nis');
        // update db
        $this->db->where('id_soal', $id_soal);
		$this->db->where('nis', $nis);
		$this->db->where('id_ujian', $id_ujian);
		$this->db->where('id_ajar', $this->session->userdata('id_ajar'));
        $this->db->update('jawaban', $jawaban);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function updatewaktu($waktu)
    {
        $waktu = array(
            'waktu'=>$waktu,
        );
		$id_ujian=$this->session->userdata('id_ujian');
		$nis=$this->session->userdata('nis');
        // update db
		$this->db->where('nis', $nis);
		$this->db->where('id_ujian', $id_ujian);
		$this->db->where('id_ajar',$this->session->userdata('id_ajar'));
        $this->db->update('hasil', $waktu);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function input_waktu($waktu)
    {   
        $hasil = array(
            'waktu'=>$waktu,
			'id_ujian'=>$this->session->userdata('id_ujian'),
			'id_ajar'=>$this->session->userdata('id_ajar'),
		    'nis'=>$this->session->userdata('nis'),
        );
        // insert db
        $this->db->insert('hasil', $hasil);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function soal_terisi($id_soal)
    {
	$nis=$this->session->userdata('nis');
	$id_ajar=$this->session->userdata('id_ajar');
	 $query= $this->db->query("SELECT * FROM jawaban where id_soal='$id_soal' and nis=$nis and id_ajar=$id_ajar;");
  
		$num = $query->num_rows();
		return $num;

	}
		public function total_nilai($nis,$id_ujian)
    {
		$id_ajar=$this->session->userdata('id_ajar');
		$sql=$this->db->query("SELECT SUM(skor) as skors FROM `jawaban` where id_ujian='$id_ujian' and nis=$nis and id_ajar=$id_ajar");
		return $sql->result();
	}
	//mengirim hasil ujian
		public function kirim($nis,$id_ujian,$nilai)
    {
		$id_ajar=$this->session->userdata('id_ajar');
		$kirim = array(
			'nilai'=>$nilai,
		    'status'=>'2',
			'id_ajar'=>$this->session->userdata('id_ajar')
        );
		$this->db->where('nis', $nis);
		$this->db->where('id_ujian', $id_ujian);
		$this->db->where('id_ajar', $id_ajar);
        $this->db->update('hasil', $kirim);
	}
	public function hasil_ujian($nis,$id_ujian)
    {	
	$nis=$this->session->userdata('nis');
	$id_ajar=$this->session->userdata('id_ajar');
	$query= $this->db->query("SELECT siswa.nama,nilai,hasil.waktu,hasil.status,ujian.mapel FROM `hasil`
	join ujian ON ujian.id_ujian=hasil.id_ujian
	join siswa ON siswa.nis=hasil.nis 
	where hasil.id_ujian='$id_ujian' and hasil.nis=$nis and hasil.id_ajar=$id_ajar");
 	return $num = $query->result();
	}

	
	 


}
/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */