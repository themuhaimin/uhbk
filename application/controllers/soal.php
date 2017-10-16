<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Soal extends MY_Controller
{
    public $data = array(
                        'modul'         => 'siswa',
                        'breadcrumb'    => 'Siswa',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'ujian/soal',
                        'form_action'   => '',
                        'form_value'    => '',
                        'option_kelas'  => '',
                         );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Soal_model', 'soal', TRUE);
		$this->load->model('Tahun_ajar_model', 't_ajaran', TRUE);
		//ujian aktif 
		$ujian_aktif=$this->soal->ujian_aktif();
		foreach ($ujian_aktif as $row){
		$ujian_aktif= $row->id_ujian;
		$waktu_ujian= $row->waktu;
		$jumlah_soal= $row->jumlah_soal;
		}
		$this->session->set_userdata('id_ujian',$ujian_aktif);
		$this->session->set_userdata('waktu_ujian',$waktu_ujian);
		// data siswa yang melakukan ujian
		//$this->session->set_userdata('nis','1236');
		//mengatur jumlah soalyang muncul
		
		//tahun ajaran aktif
		$t_aktif = $this->t_ajaran->t_ajaran_aktif();
		foreach($t_aktif as $row)
        {
            $this->session->set_userdata('id_ajar',$row->id_ajar);
        }
		$this->session->set_userdata('limit',$jumlah_soal);
		$this->data['anu']='aaaa';
	}

    public function index()
	
	{

	$this->data['main_view'] ='ujian/soal';
	//acak soal
	$id_ujian=$this->session->userdata('id_ujian');
	$limit=$this->session->userdata('limit');
	$soal=$this->soal->acak_soal($id_ujian,$limit);
	$jumlah_soal_isi=$this->soal->jumlah_soal($id_ujian);
	$jumlah_soal_isi= $jumlah_soal_isi->num_rows();
	
	//jika sudah selesai ujian
	$hasil=$this->soal->hasil_ujian($this->session->userdata('nis'),$id_ujian);
	if($hasil){
		foreach ($hasil as $row){
			$status= $row->status;
		}
	}
	else {
		   $status= '1';
	}
if ($status=='2'){
	redirect('soal/hasil');
	}
	 
else if ($jumlah_soal_isi>=$limit){
	foreach ($soal as $row) {
	$hasil[]=$row->id_soal;
	}
	//waktu berjalan
	$waktu=$this->soal->hasil();
	if($waktu){
	foreach ($waktu as $row) {
	  $this->data['sisa_waktu']=$row->waktu;
	     }
	}
	else {
	$this->data['sisa_waktu']=$this->session->userdata('waktu_ujian');
	$waktu=$this->session->userdata('waktu_ujian');
	$this->soal->input_waktu($waktu);
	}
	// jika kode acak belum di set maka set kode acak
	if (!$this->session->userdata('kode_acak')){
	$acak=implode('.',$hasil);	
	$this->session->set_userdata('kode_acak',$acak);
	}
	$this->data['kode_acak']= $this->session->userdata('kode_acak');
    $this->load->view('template/template_soal',$this->data);
	}
	else {
	     		 $this->data['main_view']='error/belumtersedia';
				 $this->data['sisa_waktu']='0';
				 $this->load->view('template/template_soal',$this->data);
		  }
	}
	public function butirsoal()
	{
	
        $id_soal=$this->uri->segment(3);
		$this->data['no']=$this->uri->segment(4)+1;
		$id_ujian=$this->session->userdata('id_ujian');
		$nis=$this->session->userdata('nis');
		$soal=$this->soal->cari_soal($id_soal,$id_ujian);
		foreach($soal as $row){
			$this->data['soal'] = $row->soal;
			$this->data['a']= $row->a;
			$this->data['b']= $row->b;
			$this->data['c']= $row->c;
			$this->data['d']= $row->d;
			$this->data['kunci']= $row->kunci;				
			}	
		$jawaban=$this->soal->jawaban($id_soal,$nis);
			if($jawaban){
				foreach($jawaban as $row){
						$this->data['jawab']= $row->jawaban;			
						}
				} else {
				$this->data['jawab']="";
				}
				
		$this->load->view('ujian/butirsoal',$this->data);
		//echo $this->session->userdata('id_ujian');
	}
	public function optionclick()
	{
	$id_soal=$this->uri->segment(3);
	$kunci=$this->uri->segment(4);
	$nis=$this->session->userdata('nis');
	$terisi=$this->soal->cekoption($id_soal,$nis);
	if ($terisi){
	$this->soal->updatejawaban($id_soal,$kunci);
	       } else {
	$this->soal->tambahjawaban($id_soal,$kunci);
	       }
	}
	public function updatewaktu() {
	$waktu=$this->uri->segment(3);
	$this->soal->updatewaktu($waktu);
	}
	public function logout() {
	$this->session->unset_userdata();
	}
	public function kirim() {
	$nis= $this->session->userdata("nis");
	$id_ujian=$this->session->userdata("id_ujian");
	$nilai= $this->soal->total_nilai($nis,$id_ujian);
	foreach ($nilai as $row){
			$skor= $row->skors;
		}
		$nilai= ($skor/$this->session->userdata("limit"))*100;
		$this->soal->kirim($nis,$id_ujian,$nilai);
		echo "aaaaa";
	}
	public function hasil() {
		$nis= $this->session->userdata("nis");
		$id_ujian=$this->session->userdata("id_ujian");
		$hasil=$this->soal->hasil_ujian($nis,$id_ujian);
		foreach ($hasil as $row){
		$this->data['nilai']= $row->nilai;
		$this->data['nama']= $row->nama;
		$this->data['waktu']= $row->waktu;
		$this->data['mapel']= $row->mapel;
		}
		$this->data['main_view'] ='ujian/hasil';
		$this->data['sisa_waktu']=0;
		$this->load->view('template/template_hasil',$this->data);
	}
	
}
/* End of file soal.php */
/* Location: ./application/controllers/soal.php */