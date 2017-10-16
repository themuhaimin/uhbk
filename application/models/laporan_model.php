<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public $db_tabel    = 'siswa';
    public $per_halaman = 10;
    public $offset      = 0;

public function id_ajar_aktif(){
		$this->load->model('Tahun_ajar_model', 't_ajaran', TRUE);
		$t_aktif = $this->t_ajaran->t_ajaran_aktif();
		foreach($t_aktif as $row)
        {
            $id_ajar = $row->id_ajar;
        }
		return $id_ajar;
	}
	public function tahun_ajaran(){
		$id_ajar=$this->id_ajar_aktif();
		return $this->db->select('*')
                        ->where('id_ajar',$id_ajar)
                        ->get('t_ajaran')
                        ->result();
	}
    public function cari_semua($mapel,$kelas)
	{
		$id_ajar=$this->id_ajar_aktif();
        return $this->db->select('siswa.nis,siswa.nama,hasil.nilai')
                        ->from($this->db_tabel)
						->join('t_paralel','t_paralel.nis=siswa.nis')
						->join('hasil','hasil.nis=siswa.nis','left')
                        ->where('hasil.id_ajar',$id_ajar)
						->where('hasil.id_ujian',$mapel)
						->where('t_paralel.id_kelas',$kelas)
                        ->get()
                        ->result();
	}

    public function cari($nis)
    {
        return $this->db->where('nis', $nis)
            ->limit(1)
            ->get($this->db_tabel)
            ->row();
    }

    public function buat_tabel($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'NIS', 'Nama', 'Nilai');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->nis,
                $row->nama,
				$row->nilai
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    public function paging($base_url)
    {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $this->hitung_semua(),
            'per_page'         => $this->per_halaman,
            'num_links'        => 4,			
			'use_page_numbers' => TRUE,
            'first_link'       => '&#124;&lt; First',
            'last_link'        => 'Last &gt;&#124;',
            'next_link'        => 'Next &gt;',
            'prev_link'        => '&lt; Prev',
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function hitung_semua()
    {
        return $this->db->count_all($this->db_tabel);
    }

    public function kode_diujikan()
    {
        return $this->db->select('*')
					->get('ujian')
					->result();
    }
	public function show_kelas($mapel)
    {
		 $id_ajar=$this->id_ajar_aktif();
		 $sql=$this->db->query("SELECT distinct t_paralel.id_kelas,kelas.kelas FROM `hasil`
								join t_paralel on t_paralel.nis=hasil.nis
								join kelas on kelas.id_kelas=t_paralel.id_kelas where hasil.id_ujian='$mapel' AND hasil.id_ajar='$id_ajar'");
                  return  $sql->result();
	}
	public function rekap($mapel,$id_kelas)
	{
		$sql = "SELECT `siswa`.`nis` as nis, `siswa`.`nama` as nama, `hasil`.`nilai` as nilai, IF(nilai<75, 'Tidak Tuntas', 'Tuntas') as keterangan FROM (`siswa`) JOIN `t_paralel` ON `t_paralel`.`nis`=`siswa`.`nis` LEFT JOIN `hasil` ON `hasil`.`nis`=`siswa`.`nis` WHERE `hasil`.`id_ajar` = '2' AND `hasil`.`id_ujian` = '$mapel' AND `t_paralel`.`id_kelas` = '$id_kelas'";
		return $this->db->query($sql);
	}
	    public function cari_analisa($mapel)
	{
		$id_ajar=$this->id_ajar_aktif();
        $sql=$this->db->query("SELECT soal,id_soal as id,(SELECT SUM(skor) FROM `jawaban` where id_soal=id and id_ajar='$id_ajar') as skornya,(SELECT COUNT(nis) FROM `jawaban`
				where id_soal=id and id_ajar='$id_ajar') as penjawab,(SELECT skornya/penjawab) as kesukaran,(SELECT SUM(skor) FROM `jawaban` 
				join hasil on (hasil.nis=jawaban.nis and  hasil.id_ujian=jawaban.id_ujian and  hasil.id_ajar=jawaban.id_ajar) where jawaban.id_soal=id and jawaban.id_ajar='$id_ajar' and hasil.nilai>'50') as atas,(SELECT SUM(skor) FROM `jawaban` 
				join hasil on (hasil.nis=jawaban.nis and  hasil.id_ujian=jawaban.id_ujian and  hasil.id_ajar=jawaban.id_ajar) where jawaban.id_soal=id and jawaban.id_ajar='$id_ajar' and hasil.nilai<='50') as bawah FROM `soal` where id_ujian='$mapel'");
		return  $sql->result();
	}
	   public function buat_tabel_analisa($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'ID_Soal', 'Soal', '% Kesukaran', 'Kesukaran', 'Dy Pembeda','Kriteria');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {   if($row->kesukaran<0.1){
			$ket="Sangat Sukar";
			} else if($row->kesukaran<0.25){
			$ket="Sukar";
			} else if($row->kesukaran<0.75){
			$ket="Sedang";
			} else if($row->kesukaran<0.9){
			$ket="Mudah";
			} else {
			 $ket="Sangat Mudah";
			}
			//menghindari null anggota atas
			if($row->atas<1){
				$atas=0;
			} else {
				$atas=$row->atas;
			}
			//menghindari null anggota bawah
			if($row->bawah<1){
				$bawah=0;
			} else {
				$bawah=$row->bawah;
			}
			//hitung  Daya Pembeda
			if($atas==0){// mengatasi division by zero
				$beda=0;
			} else {
			$beda=(($atas-$bawah)/$atas);
			}
			if($beda<0.05){
				$kriteria="Soal Perlu Diganti";
			} else if($beda<0.1){
				$kriteria="Soal Perlu Direvisi";
			} else {
				$kriteria="Soal Layak Digunakan";
			}
            $this->table->add_row(
                ++$no,
                $row->id,
                $row->soal,
				round($row->kesukaran,1),
				$ket,
				$beda,
				$kriteria
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }


}
/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */