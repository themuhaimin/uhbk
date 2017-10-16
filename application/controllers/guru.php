<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public $data = array(
                        'modul'         => 'Guru',
                        'breadcrumb'    => 'Pengelolaan Guru',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'guru/guru',
                        'form_action'   => '',
                        'form_value'    => '',
                        'option_kelas'  => '',
                         );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Guru_model', 'guru', TRUE);
		$this->load->model('Kelas_model', 'kelas', TRUE);
		//status
        $this->data['option_status'][1] = 'Aktif';
		$this->data['option_status'][0] = 'Tidak Aktif';


	}

    public function index($offset = 0)
	{
        // cari data guru
        $guru = $this->guru->cari_semua($offset);

        // ada data guru, tampilkan
        if ($guru)
        {
            $tabel = $this->guru->buat_tabel($guru);
            $this->data['tabel_data'] = $tabel;

            // Paging
            // http://localhost/absensi2014/guru/halaman/2
            $this->data['pagination'] = $this->guru->paging(site_url('guru/halaman'));
        }
        // tidak ada data guru
        else
        {
            $this->data['pesan'] = 'Tidak ada data Guru.';
        }
        $this->load->view('template/template', $this->data);
	}

    public function tambah()
    {
        $this->data['breadcrumb']  = 'Guru > Tambah';
        $this->data['main_view']   = 'guru/guru_form';
        $this->data['form_action'] = 'guru/tambah';

        // option kelas, untuk menu dropdown
        $kelas = $this->kelas->cari_semua();

        // option jabatan
            $this->data['option_jabatan'][1] = "Administrator";
			$this->data['option_jabatan'][2] = "Guru";

        // if submit
        if($this->input->post('submit'))
        {
            // validasi sukses
            if($this->guru->validasi_tambah())
            {
                if($this->guru->tambah())
                {
                    $this->session->set_flashdata('pesan', 'Proses tambah data berhasil.');
                    redirect('guru');
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
            }
        }
        // if no submit
        else
        {
            $this->load->view('template/template', $this->data);
        }
    }

    public function edit($nip = NULL)
    {
        $this->data['breadcrumb']  = 'Guru > Edit';
        $this->data['main_view']   = 'guru/guru_form';
        $this->data['form_action'] = 'guru/edit/' . $nip;

	// option jabatan
            $this->data['option_jabatan'][1] = "Administrator";
			$this->data['option_jabatan'][2] = "Guru";
        
        // Mencegah error http://localhost/absensi2014/guru/edit/$nip (edit tanpa ada parameter)
        // Ada parameter
        if( ! empty($nip))
        {
            // submit
            if($this->input->post('submit'))
            {
                // validasi berhasil
                if($this->guru->validasi_edit() === TRUE)
                {
                    //update db
                    $this->guru->edit($this->session->userdata('nip_sekarang'));
                    $this->session->set_flashdata('pesan', 'Proses update data berhasil.');

                    redirect('guru');
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
                $guru = $this->guru->cari($nip);
                foreach($guru as $key => $value)
                {
                    $this->data['form_value'][$key] = $value;
                }

                // set temporary data untuk edit
                $this->session->set_userdata('nip_sekarang', $guru->nip);

                $this->load->view('template/template', $this->data);
            }
        }
        // tidak ada parameter $nip di URL, kembalikan ke halaman guru
        else
        {
            redirect('guru');
        }
    }

    public function hapus($nip = NULL)
    {
        if( ! empty($nip))
        {
            if($this->guru->hapus($nip))
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data berhasil.');
                redirect('guru');
            }
            else
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
                redirect('guru');
            }
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
            redirect('guru');
        }
    }

    public function is_nip_exist()
    {
        $nip_sekarang  = $this->session->userdata('nip_sekarang');
        $nip_baru      = $this->input->post('nip');

        if ($nip_baru === $nip_sekarang)
        {
            return TRUE;
        }
        else
        {
            // cek database untuk nip yang sama
            $query = $this->db->get_where('guru', array('nip' => $nip_baru));
            if($query->num_rows() > 0)
            {
                $this->form_validation->set_message('is_nip_exist',
                                                    "Guru dengan NIP $nip_baru sudah terdaftar");
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
	public function coba()
    {

	}

}
/* End of file guru.php */
/* Location: ./application/controllers/guru.php */