<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public $data = array(
                        'modul'         => 'kelas',
                        'breadcrumb'    => 'Kelas',
                        'pesan'         => '',
                        'pagination'    => '',
                        'tabel_data'    => '',
                        'main_view'     => 'kelas/kelas',
                        'form_action'   => '',
                        'form_value'    => '',
                        );

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('Kelas_model', 'kelas', TRUE);
    }

	public function index()
	{
        // hapus data temporary proses update
        $this->session->unset_userdata('id_kelas_sekarang', '');
        $this->session->unset_userdata('kelas_sekarang', '');

        // Cari semua data kelas
        $kelas = $this->kelas->cari_semua();

        // data kelas ada, tampilkan
        if ($kelas)
        {
            // buat tabel
            $tabel = $this->kelas->buat_tabel($kelas);
            $this->data['tabel_data'] = $tabel;
            $this->load->view('template/template', $this->data);
        }
        // data kelas tidak ada
        else
        {
            $this->data['pesan'] = 'Tidak ada data kelas.';
            $this->load->view('template/template', $this->data);
        }
	}

    public function tambah()
    {
        $this->data['breadcrumb']  = 'Kelas > Tambah';
        $this->data['main_view']   = 'kelas/kelas_form';
        $this->data['form_action'] = 'kelas/tambah';
		// option tingkat
				$this->data['option_tingkat'][7] = "7 (Tujuh)";
				$this->data['option_tingkat'][8] = "8 (Delapan)";
				$this->data['option_tingkat'][9] = "9 (Sembilan)";
        // submit
        if($this->input->post('submit'))
        {
            // validasi sukses
            if($this->kelas->validasi_tambah())
            {
                if($this->kelas->tambah())
                {
                    $this->session->set_flashdata('pesan', 'Proses tambah data berhasil.');
                    redirect('kelas');
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
        // no submit
        else
        {
            $this->load->view('template/template', $this->data);
        }
    }

    public function edit($id_kelas = NULL)
    {
        $this->data['breadcrumb']  = 'Kelas > Edit';
        $this->data['main_view']   = 'kelas/kelas_form';
        $this->data['form_action'] = 'kelas/edit/' . $id_kelas;

        // pastikan id_kelas ada
        if( ! empty($id_kelas))
        {
            // submit
            if($this->input->post('submit'))
            {
                // validasi berhasil
                if($this->kelas->validasi_edit() === TRUE)
                {
                    //update db
                    $this->kelas->edit($this->session->userdata('id_kelas_sekarang'));
                    $this->session->set_flashdata('pesan', 'Proses update data berhasil.');

                    redirect('kelas');
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
                // ambil data dari database, $form_value sebagai nilai dafault form
                $kelas = $this->kelas->cari($id_kelas);
                foreach($kelas as $key => $value)
                {
                    $this->data['form_value'][$key] = $value;
                }
				// option tingkat
				$this->data['option_tingkat'][7] = "7 (Tujuh)";
				$this->data['option_tingkat'][8] = "8 (Delapan)";
				$this->data['option_tingkat'][9] = "9 (Sembilan)";
                // set temporary data for edit
                $this->session->set_userdata('id_kelas_sekarang', $kelas->id_kelas);
                $this->session->set_userdata('kelas_sekarang', $kelas->kelas);

                $this->load->view('template/template', $this->data);
            }
        }
        // tidak ada parameter id_kelas, kembalikan ke halaman kelas
        else
        {
            redirect('kelas');
        }
    }

    public function hapus($id_kelas = NULL)
    {
        // pastikan id_kelas yang akan dihapus
        if( ! empty($id_kelas))
        {
            if($this->kelas->hapus($id_kelas))
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data berhasil.');
                redirect('kelas');
            }
            else
            {
                $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
                redirect('kelas');
            }
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Proses hapus data gagal.');
            redirect('kelas');
        }
    }

    // callback, apakah id_kelas sama? untuk proses edit
    function is_id_kelas_exist()
    {
        $id_kelas_sekarang 	= $this->session->userdata('id_kelas_sekarang');
        $id_kelas_baru		= $this->input->post('id_kelas');

        // jika id_kelas baru dan id_kelas yang sedang diedit sama biarkan
        // artinya id_kelas tidak diganti
        if ($id_kelas_baru === $id_kelas_sekarang)
        {
            return TRUE;
        }
        // jika id_kelas yang sedang diupdate (di session) dan yang baru (dari form) tidak sama,
        // artinya id_kelas mau diganti
        // cek di database apakah id_kelas sudah terpakai?
        else
        {
            // cek database untuk id_kelas yang sama
            $query = $this->db->get_where('kelas', array('id_kelas' => $id_kelas_baru));

            // id_kelas sudah dipakai
            if($query->num_rows() > 0)
            {
                $this->form_validation->set_message('is_id_kelas_exist',
                                                    "Kelas dengan kode $id_kelas_baru sudah terdaftar");
                return FALSE;
            }
            // id_kelas belum dipakai, OK
            else
            {
                return TRUE;
            }
        }
    }

    // callback, apakah nama kelas sama? untuk proses edit
    // penjelasan kurang lebih sama dengan is_id_kelas_exist
    function is_kelas_exist()
    {
        $kelas_sekarang 	= $this->session->userdata('kelas_sekarang');
        $kelas_baru		= $this->input->post('kelas');

        if ($kelas_baru === $kelas_sekarang)
        {
            return TRUE;
        }
        else
        {
            // cek database untuk nama kelas yang sama
            $query = $this->db->get_where('kelas', array('kelas' => $kelas_baru));
            if($query->num_rows() > 0)
            {
                $this->form_validation->set_message('is_kelas_exist',
                                                    "Kelas dengan nama $kelas_baru sudah terdaftar");
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
}
/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */