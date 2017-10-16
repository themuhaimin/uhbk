<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Butir_soal extends CI_Controller
{
    public $data = array(
                        'modul'         => 'ujian',
                        'breadcrumb'    => 'Kelola Ujian',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'ujian/ujian',
                        'form_action'   => '',
                        'form_value'    => '',
                        'option_kelas'  => '',
                         );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Ujian_model', 'ujian', TRUE);
		$this->load->model('Butir_soal_model', 'butir_soal', TRUE);
	}

     public function index($offset = 0)
	{
      redirect('ujian/beranda');;
	}
	 public function kelola($id_ujian)
    {
	$mapel=$this->butir_soal->cari_mapel($id_ujian);
	foreach($mapel as $row)
                {
                    $mapel=$row->mapel;
                }
	$this->data['main_view']  ='butir_soal/soal';
	$this->data['breadcrumb']  = 'Kelola Soal '.$mapel;
	   // hapus data temporary proses update
        $this->session->unset_userdata('id_ujian_sekarang', '');

        // cari data siswa
        $ujian = $this->butir_soal->cari_soal($id_ujian);

        // ada data siswa, tampilkan
        if ($ujian)
        {
            $tabel = $this->butir_soal->buat_tabel($ujian);
            $this->data['tabel_data'] = $tabel;

      
        }
        // tidak ada data siswa
        else
        {
            $this->data['pesan'] = 'Soal belum tersedia.';
        }
        $this->load->view('template/template', $this->data);
	
	}
    public function tambah()
    {
		$id_ujian=$this->uri->segment(3);
        $this->data['main_view']   = 'butir_soal/butir_soal_form';
        $this->data['form_action'] = 'butir_soal/tambah/'.$id_ujian;

        // option kunci
		$this->data['kunci']['A']='A';
		$this->data['kunci']['B']='B';
		$this->data['kunci']['C']='C';
		$this->data['kunci']['D']='D';
    
        // if submit
        if($this->input->post('submit'))
        { 
            // validasi sukses
           //if($this->ujian->validasi_tambah())
            //{
                if($this->butir_soal->tambah($id_ujian))
                {
                    $this->session->set_flashdata('pesan', 'Proses tambah data berhasil.');
                    redirect('butir_soal/kelola/'.$id_ujian);
                }
                else
                {
                    $this->data['pesan'] = 'Proses tambah data gagal.';
                    $this->load->view('template/template', $this->data);
                }
            /*}
            // validasi gagal
          else
            {
                $this->load->view('template/template', $this->data);
				echo $id_ujian;
            } */
			
        }
        // if no submit
        else
        {
            $this->load->view('template/template', $this->data);
        }
    }

    public function edit($id_ujian=NULL,$id_soal = NULL)
    {
		
        $this->data['breadcrumb']  = 'Siswa > Edit';
        $this->data['main_view']   = 'butir_soal/butir_soal_form';
        $this->data['form_action'] = 'butir_soal/edit/'.$id_ujian."/".$id_soal;
      // option kunci
            $this->data['kunci']['A'] = "A";
			$this->data['kunci']['B'] = "B";
			$this->data['kunci']['C'] = "C";
			$this->data['kunci']['D'] = "D";
			
        // Ada parameter
        if( ! empty($id_soal))
        {
            // submit
            if($this->input->post('submit'))
            {
                
                    //update db
                 $this->butir_soal->edit($id_soal);
                 $this->session->set_flashdata('pesan', 'Proses update data berhasil.');
                 redirect('butir_soal/kelola/'.$id_ujian);

            }
            // tidak disubmit, form pertama kali dimuat
            else
            {
                // ambil data dari database, $form_value sebagai nilai default form
                $soal = $this->butir_soal->cari($id_soal);
                foreach($soal as $key => $value)
                {
                    $this->data['form_value'][$key] = $value;
                }
                // set temporary data untuk edit
           //     $this->session->set_userdata('id_ujian_sekarang', $soal->id_soal);

               $this->load->view('template/template', $this->data);
            }
        }
        // tidak ada parameter $nis di URL, kembalikan ke halaman siswa
        else
        {
             redirect('butir_soal/kelola/'.$id_ujian);
        }
    }

    public function hapus($id_ujian,$id_soal = NULL)
    {
        if( ! empty($id_soal))
        {
            if($this->butir_soal->hapus($id_soal))
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data berhasil.');
                redirect('butir_soal/kelola/'.$id_ujian);
            }
            else
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
                redirect('butir_soal/kelola/'.$id_ujian);
            }
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
            redirect('butir_soal/kelola/'.$id_ujian);
        }
    }
	public function is_id_ujian_exist()
    {
        $id_ujian_sekarang  = $this->session->userdata('id_ujian_sekarang');
        $id_ujian_baru      = $this->input->post('id_ujian');

        if ($id_ujian_baru === $id_ujian_sekarang)
        {
            return TRUE;
        }
        else
        {
            // cek database untuk nis yang sama
            $query = $this->db->get_where('ujian', array('id_ujian' => $id_ujian_baru));
            if($query->num_rows() > 0)
            {
                $this->form_validation->set_message('is_id_ujian_exist',
                                                    "Kode Ujian dengan kode $id_ujian_baru sudah terdaftar");
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
	public function beranda()
    {

		$this->data['breadcrumb']  = 'Beranda';
        $this->data['main_view']   = 'ujian/beranda';
        $this->data['form_action'] = 'siswa/tambah';
		$this->load->view('template/template', $this->data);
	}
	public function set_aktif()
    {

		$this->data['breadcrumb']  = 'Ujian>Set Aktif';
        $this->data['main_view']   = 'ujian/set_aktif';
        $this->data['form_action'] = 'ujian/insert_aktif';
		$this->load->view('template/template', $this->data);
	}

}
/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */