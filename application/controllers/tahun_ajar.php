<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tahun_ajar extends CI_Controller
{
    public $data = array(
                        'modul'         => 'tahun_ajaran',
                        'breadcrumb'    => 'Kelola Tahun Ajaran',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'tahun_ajar/tahun_ajaran',
                        'form_action'   => 'tahun_ajar/set_aktif',
                        'form_value'    => '',
                        'option_kelas'  => '',
                         );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Tahun_ajar_model', 't_ajaran', TRUE);
		$this->load->model('Butir_soal_model', 'butir_soal', TRUE);
		// option semester
				$this->data['option_semester']['Gasal'] = "Semester Gasal";
				$this->data['option_semester']['Genap'] = "Semester Genap";
	}

     public function index($offset = 0)
	{
        // hapus data temporary proses update
        $this->session->unset_userdata('id_ujian_sekarang', '');

        // cari data siswa
        $tahun = $this->t_ajaran->cari_semua($offset);

        // ada data siswa, tampilkan
        if ($tahun)
        {
            $tabel = $this->t_ajaran->buat_tabel($tahun);
            $this->data['tabel_data'] = $tabel;

            // Paging
            // http://localhost/absensi2014/siswa/halaman/2
            $this->data['pagination'] = $this->t_ajaran->paging(site_url('ujian/halaman'));
        }
        // tidak ada data siswa
        else
        {
            $this->data['pesan'] = 'Tidak ada data siswa.';
        }
        $this->load->view('template/template', $this->data);
	}

    public function tambah()
    {
        $this->data['breadcrumb']  = 'Tahun Ajaran > Tambah';
        $this->data['main_view']   = 'tahun_ajar/t_ajaran_form';
        $this->data['form_action'] = 'tahun_ajar/tambah';

        // option kelas, untuk menu dropdown
     //   $kelas = $this->kelas->cari_semua();

    
        // if submit
        if($this->input->post('submit'))
        { 
            // validasi sukses
           if($this->t_ajaran->validasi_tambah())
            {
                if($this->t_ajaran->tambah())
                {
                    $this->session->set_flashdata('pesan', 'Proses tambah data berhasil.');
                   redirect('tahun_ajar');
                }
                else
                {
                    $this->data['pesan'] = 'Proses tambah data gagal.';
                    $this->load->view('template/template', $this->data);
                }
            }
            // validasi gagal
            else
            {
                $this->load->view('template/template', $this->data);
				echo "aaaaa";
            }
			
        }
        // if no submit
        else
        {
            $this->load->view('template/template', $this->data);
        }
    }

    public function edit($id_tahun = NULL)
    {
        $this->data['breadcrumb']  = 'Tahun Ajaran > Edit';
        $this->data['main_view']   = 'tahun_ajar/t_ajaran_form';
        $this->data['form_action'] = 'tahun_ajar/edit/' . $id_tahun;

        // option kelas
        // Mencegah error http://localhost/absensi2014/siswa/edit/$nis (edit tanpa ada parameter)
        // Ada parameter
        if( ! empty($id_tahun))
        {
            // submit
            if($this->input->post('submit'))
            {
                // validasi berhasil
                if($this->t_ajaran->validasi_edit() === TRUE)
                {
                    //update db
                    $this->t_ajaran->edit($id_tahun);
                    $this->session->set_flashdata('pesan', 'Proses update data berhasil.');

                    redirect('tahun_ajar');
                }
                // validasi gagal
                else
                {
                    $this->load->view('template/template', $this->data);
                }

            }
            // tidak disubmit, form pertama kali dimuat
            else
            {
                // ambil data dari database, $form_value sebagai nilai default form
                $tahun = $this->t_ajaran->cari($id_tahun);
                foreach($tahun as $key => $value)
                {
                    $this->data['form_value'][$key] = $value;
                }

                // set temporary data untuk edit
                $this->session->set_userdata('id_tahun_sekarang', $tahun->id_ajar);

                $this->load->view('template/template', $this->data);
            }
        }
        // tidak ada parameter $nis di URL, kembalikan ke halaman siswa
        else
        {
            redirect('tahun_ajar');
        }
    }

    public function hapus($id_ujian = NULL)
    {
        if( ! empty($id_ujian))
        {
            if($this->ujian->hapus($id_ujian))
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data berhasil.');
                redirect('ujian');
            }
            else
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
                redirect('ujian');
            }
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
            redirect('ujian');
        }
    }
	//Pengelolaan butir soal
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
                    //update db
                    $this->t_ajaran->insert_aktif();
                    $this->session->set_flashdata('pesan', 'Aktifasi Tahun Ajaran Berhasil.');
                    redirect('tahun_ajar');
	}

}
/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */