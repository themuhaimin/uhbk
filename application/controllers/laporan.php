<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public $data = array(
                        'modul'         => 'ujian',
                        'breadcrumb'    => 'Daftar Nilai Ulangan Harian',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'laporan/laporan',
                        'form_action'   => '',
                        'form_value'    => '',
                        'option_kelas'  => '',
                         );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Laporan_model', 'laporan', TRUE);
		$this->load->helper('fungsidate');
	}

     public function index($offset = 0)
	{
		$this->data['form_action'] = 'laporan/download_pdf_nilai/'.$this->input->post('mapel');

		//mapel yang sudah diujian
		$this->data['option'] = $this->laporan->kode_diujikan();

        // data kelas ada
 
        $this->load->view('template/template', $this->data);
	}
	public function show_kelas($mapel)
	{ 
		$kelas=$this->laporan->show_kelas($mapel);
		echo '<option value="-">--Pilih Kelas--</option>';
		foreach($kelas as $row){
			echo '<option value="'.$row->id_kelas.'">'.$row->kelas.'</option><br>';
		}
	}
	public function keluar_tabel($mapel,$kelas){
		       
        // cari data siswa
        $siswa = $this->laporan->cari_semua($mapel,$kelas);
	    if(!isset($kelas)){
			$kelas=0;
		}
        // ada data siswa, tampilkan
        if ($siswa)
        {
            $tabel = $this->laporan->buat_tabel($siswa);
            echo $tabel;

            // Paging
            // http://localhost/absensi2014/siswa/halaman/2
            $this->data['pagination'] = $this->laporan->paging(site_url('ujian/halaman'));
			echo anchor('laporan/download_pdf_nilai/'.$mapel.'/'.$kelas,'Cetak', array('class' => 'btn tambah btn-success'));
        }
        // tidak ada data siswa
        else
        {
            echo 'Tidak ada data siswa.';
        }
	}
	public function analisis(){
		$this->data['breadcrumb']   ='Analisa Butir Soal Ulangan Harian';
		$this->data['main_view']= 'laporan/analisis';
				//mapel yang sudah diujian
		$this->data['option'] = $this->laporan->kode_diujikan();
        $this->load->view('template/template', $this->data);
	}
	//keluarkan soal yang dianalisa
	public function keluar_analisa($mapel){
		       
        // cari data siswa
        $siswa = $this->laporan->cari_analisa($mapel);
        // ada data siswa, tampilkan
        if ($siswa)
        {
            $tabel = $this->laporan->buat_tabel_analisa($siswa);
            echo $tabel;
        }
	}
	public function download_pdf_nilai($id_mapel, $id_kelas)
    {
        // pastikan error reporting mati, atau file pdf akan corrupt
      error_reporting(0);

        // parameter OK
        if(! empty($id_kelas) && ! empty($id_mapel))
        {
            // kelas
            $kelas = $this->db->select('kelas')->where('id_kelas', $id_kelas)->get('kelas')->row()->kelas;
			//tahun ajaran dan semester
			$this->load->model('Laporan_model', 'laporan', TRUE);
			$t_aktif = $this->laporan->id_ajar_aktif();
			$tahun = $this->db->select('t_ajaran')->where('id_ajar', $t_aktif)->get('t_ajaran')->row()->t_ajaran;
			$semester = $this->db->select('semester')->where('id_ajar', $t_aktif)->get('t_ajaran')->row()->semester;
			//mapel
			$mapel = $this->db->select('mapel')->where('id_ujian', $id_mapel)->get('ujian')->row()->mapel;
			
			
            $parameters=array(
                'paper'=>'A4',
                'orientation'=>'portrait',
            );

            // load library extension class Cezpdf
            // lokasi: ./application/libraries/Pdf.php
            $this->load->library('Pdf', $parameters);

            // pastikan path font benar
            $this->pdf->selectFont(APPPATH.'/third_party/pdf-php/fonts/Helvetica.afm');

            // gambar header, pastikan path gambar benar
           // $this->pdf->ezImage(base_url('asset/images/logo.png'), 100, 100, 'float', 'left');

            // judul rekap
            $this->pdf->ezText("DAFTAR NILAI", 15, array('justification'=> 'centre'));
			$this->pdf->ezText("$mapel", 13, array('justification'=> 'centre'));
			// judul 2
			$this->pdf->ezText("	Kelas  :  $kelas", 13, array('justification'=> 'center'));
			$this->pdf->ezText("SMP N 1 KALIWUNGU", 22, array('justification'=> 'centre','weight'=>'bold'));
            $this->pdf->ezText("Semester $semester Tahun Ajaran $tahun", 15, array('justification'=> 'centre','weight'=>'bold'));
			

            // spasi judul dengan tabel
            $this->pdf->ezSetDy(-15);
			
			  

            // jalankan query
            $query = $this->laporan->rekap( $id_mapel,$id_kelas);

            // persiapkan data (array) untuk tabel pdf
            $no = 0;
            $i = 0;
            $data_rekap=array();
            foreach ($query->result_array() as $key => $value) {
                // jangan ganti urutan 3 baris ini, atau nomor tidak tampil
                $data_rekap[$key] = $value;
                $data_rekap[$i]['no']= ++$no;
                $i++;
            }

            // header tabel pdf
            $column_header=array(
                'no' => 'No',
                'nis'=>'NIS',
                'nama'=>'Nama Siswa',
                'nilai'=>'Nilai',
				'keterangan'=>'Keterangan',
            );
			
            // buat tabel pdf
            $this->pdf->ezTable($data_rekap, $column_header,"",array('width'=>460, 'fontSize'=>'12', 'showLines'=>'1','align'=>'center'));

			$this->pdf->ezSetDy(-5);
			$this->pdf->ezText("Kaliwungu, ".tgl_indo(date('Y-m-d'))."                 ",12,array("justification"=>"right"));
			$this->pdf->ezText("Guru Mata Pelajaran"."                       ",12,array("justification"=>"right"));
			
			$this->pdf->ezSetDy(-30);
			$this->pdf->ezText("............................................"."                ",12,array("justification"=>"right"));
			
            $nama_file = 'DAFNIL_KLS.pdf';

            // force download, nama file sesuai dengan $nama_file
            $this->pdf->ezStream(array('Content-Disposition'=>$nama_file));
        }
        // parameter tidak lengkap
        else
        {
            $this->session->set_flashdata('pesan', 'Proses pembuatan data rekap (PDF) gagal. Parameter tidak lengkap.');
            redirect('laporan');
        }
    }

   
}


/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */