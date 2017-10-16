<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelola_rombel extends CI_Controller {

    public $data = array(
                        'modul'         => 'kelas',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'kelola_rombel/rombel',
                        'form_action'   => '',
                        'form_value'    => '',
                        );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Rombel_model', 'rombel', TRUE);
		$this->load->model('Siswa_model', 'siswa', TRUE);
		$this->load->model('Kelas_model', 'kelas', TRUE);
		$this->load->model('Tahun_ajar_model', 't_ajaran', TRUE);
		$t_aktif = $this->t_ajaran->t_ajaran_aktif();
		foreach($t_aktif as $row)
        {
            $id_ajaran = $row->id_ajar;
        }
		$this->session->set_userdata('id_ajaran',$id_ajaran);
    }

	public function index($kelas=null)
	{
		//bikin session kelas aktif
		$this->session->set_userdata('id_kelas',$kelas);
		//id ajaran aktif
		$id_ajaran=$this->session->userdata('id_ajaran');
		// Cari semua data rombel
        $rombel = $this->rombel->cari($kelas,$id_ajaran);
		$this->data['id_kelas']    = $kelas;
		//kelas aktif
		$kelas = $this->kelas->aktif($kelas);
		foreach($kelas as $row){
		$kelas=$row->kelas;
		}
		$this->data['breadcrumb']    = 'Pengelolaan Paralel untuk Siswa Kelas '.$kelas;
        // data kelas ada, tampilkan
        if ($rombel)
        {
            // buat tabel
            $tabel = $this->rombel->buat_tabel($rombel);
            $this->data['tabel_data'] = $tabel;
            $this->load->view('template/template', $this->data);
        }
        // data rombel tidak ada
        else
        {
            $this->data['pesan'] = 'Belum ada data siswa di rombel ini.';
            $this->load->view('template/template', $this->data);
        }
	}
		public function halaman($kelas=null)
	{
		//id ajaran aktif
		$id_ajaran=$this->session->userdata('id_ajaran');
		// Cari semua data rombel
        $rombel = $this->rombel->cari($kelas,$id_ajaran);
		$this->data['id_kelas']    = $kelas;
		//kelas aktif
		$kelas = $this->kelas->aktif($kelas);
		foreach($kelas as $row){
		$kelas=$row->kelas;
		}
		$this->data['breadcrumb']    = 'Pengelolaan Paralel untuk Siswa Kelas '.$kelas;
        // data kelas ada, tampilkan
        if ($rombel)
        {
            // buat tabel
            $tabel = $this->rombel->buat_tabel($rombel);
            $this->data['tabel_data'] = $tabel;
            $this->load->view('template/template', $this->data);
        }
        // data rombel tidak ada
        else
        {
            $this->data['pesan'] = 'Belum ada data siswa di rombel ini.';
            $this->load->view('template/template', $this->data);
        }
	}

    public function tambah($offset=null,$idnya_kelas=null)
    {
		$id_kelas=$this->session->userdata('id_kelas');
		$this->data['breadcrumb']  = 'rombel > Tambah';
        $this->data['main_view']   = 'kelola_rombel/tambah_ke_paralel';
        $this->data['form_action'] = 'kelola_rombel/simpanParalel/'.$id_kelas;
		//data siswa yang sudah masuk paralel
		$exist=$this->rombel->sudah_masuk_paralel($this->session->userdata('id_ajaran'));
		// cari data siswa
        $siswa = $this->rombel->cari_siswa($offset,$exist);

        // ada data siswa, tampilkan
        if ($siswa)
        {
            $tabel = $this->rombel->buat_tabel_siswa($siswa);
            $this->data['tabel_data'] = $tabel;

            // Paging
            // http://localhost/absensi2014/siswa/halaman/2
            $this->data['pagination'] = $this->rombel->paging(site_url('kelola_rombel/tambah/'),$exist);
        }
        // tidak ada data siswa
        else
        {
            $this->data['pesan'] = 'Data kosong. Siswa sudah masuk di kelas masing-masing.';
        }
        $this->load->view('template/template', $this->data);
    }
	
    
    public function hapus($nis, $id_kelas= NULL)
    {
        // pastikan id_kelas yang akan dihapus
        if( ! empty($nis))
        {
            if($this->rombel->hapus($nis))
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data berhasil.');
                redirect('kelola_rombel/index/'.$id_kelas);
            }
            else
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
                redirect('kelola_rombel/index/'.$id_kelas);
            }
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
            redirect('kelola_rombel/index/'.$id_kelas);
        }
    }
	public function simpanParalel($id_kelas = NULL)
    {
	if (isset($_POST['siswa_tambah'])){
		$data= $this->input->post('siswa_tambah');
			foreach ($data as $nis){
				$this->rombel->simpanParalel($nis,$id_kelas);
				}
		$this->session->set_flashdata('pesan', 'Siswa berhasil ditambahkan');
			redirect('kelola_rombel/tambah/');
			} else {
		$this->session->set_flashdata('pesan', 'Tidak ada data yang dipilih, silakan pilih salah satu nama.');
            redirect('kelola_rombel/tambah/');
			}
		
		
	}
	
}
/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */