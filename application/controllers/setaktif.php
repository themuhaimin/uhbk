<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ujian extends CI_Controller
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
        // hapus data temporary proses update
        $this->session->unset_userdata('id_ujian_sekarang', '');

        // cari data siswa
        $siswa = $this->ujian->cari_semua($offset);

        // ada data siswa, tampilkan
        if ($siswa)
        {
            $tabel = $this->ujian->buat_tabel($siswa);
            $this->data['tabel_data'] = $tabel;

            // Paging
            // http://localhost/absensi2014/siswa/halaman/2
            $this->data['pagination'] = $this->ujian->paging(site_url('ujian/halaman'));
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
        $this->data['breadcrumb']  = 'Ujian > Tambah';
        $this->data['main_view']   = 'ujian/ujian_form';
        $this->data['form_action'] = 'ujian/tambah';

        // option kelas, untuk menu dropdown
     //   $kelas = $this->kelas->cari_semua();

    
        // if submit
        if($this->input->post('submit'))
        { 
            // validasi sukses
           if($this->ujian->validasi_tambah())
            {
                if($this->ujian->tambah())
                {
                    $this->session->set_flashdata('pesan', 'Proses tambah data berhasil.');
                    redirect('ujian');
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

    public function edit($id_ujian = NULL)
    {
        $this->data['breadcrumb']  = 'Siswa > Edit';
        $this->data['main_view']   = 'ujian/ujian_form';
        $this->data['form_action'] = 'ujian/edit/' . $id_ujian;

        // option kelas
        // Mencegah error http://localhost/absensi2014/siswa/edit/$nis (edit tanpa ada parameter)
        // Ada parameter
        if( ! empty($id_ujian))
        {
            // submit
            if($this->input->post('submit'))
            {
                // validasi berhasil
                if($this->ujian->validasi_edit() === TRUE)
                {
                    //update db
                    $this->ujian->edit($id_ujian);
                    $this->session->set_flashdata('pesan', 'Proses update data berhasil.');

                    redirect('ujian');
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
                $ujian = $this->ujian->cari($id_ujian);
                foreach($ujian as $key => $value)
                {
                    $this->data['form_value'][$key] = $value;
                }

                // set temporary data untuk edit
                $this->session->set_userdata('id_ujian_sekarang', $ujian->id_ujian);

                $this->load->view('template/template', $this->data);
            }
        }
        // tidak ada parameter $nis di URL, kembalikan ke halaman siswa
        else
        {
            redirect('ujian');
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

		$this->data['breadcrumb']  = 'Ujian>Set Aktif';
        $this->data['main_view']   = 'ujian/set_aktif';
        $this->data['form_action'] = 'ujian/insert_aktif';
		$this->load->view('template/template', $this->data);
	}

}
/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */