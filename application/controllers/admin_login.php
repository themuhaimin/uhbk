<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login extends CI_Controller
{
    public $data = array('pesan'=> '');

	public function __construct()
    {
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('Login_admin', 'admin', TRUE);
	}

	public function index()
    {
		// status user login = BENAR, pindah ke halaman absen
        if ($this->session->userdata('admin') == TRUE)
        {
			redirect('ujian/beranda');
		}
        // status login salah, tampilkan form login
        else
        {
            // validasi sukses
            if($this->admin->validasi())
            {    $this->session->set_userdata('kcfinder_mati',FALSE);
                // cek di database sukses
                if($this->admin->cek_user())
                {   
					
                    redirect('ujian/beranda');
					
                }
                // cek database gagal
                else
                {
                    $this->data['pesan'] = 'Username atau Password salah.';
                    $this->load->view('login/login_admin', $this->data);
                }
            }
            // validasi gagal
            else
            {
                $this->load->view('login/login_admin', $this->data);
            }
		}
	}
	public function coba(){
			$data=$this->load->model('Login_admin');
			$guru=$this->Login_admin->admin_id($this->session->userdata('nip'));
					foreach ($guru as $row) {
						$guru=$row->nama;
					}
					echo $guru;
	}
	public function logout()
	{
        $this->admin->logout();
		redirect('administrator');
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */