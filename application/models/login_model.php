<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $db_tabel = 'siswa';

    public function load_form_rules()
    {
        $form_rules = array(
                            array(
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'required'
                            ),
        );
        return $form_rules;
    }

    public function validasi()
    {
        $form = $this->load_form_rules();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // cek status user, login atau tidak?
    public function cek_user()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $query = $this->db->where('nis', $username)
                          ->where('password', $password)
                          ->limit(1)
                          ->get($this->db_tabel);

        if ($query->num_rows() == 1)
        {
            $data = array('nis' => $username, 'login' => TRUE);
            // buat data session jika login benar
            $this->session->set_userdata($data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('username' => '', 'login' => FALSE, 'id_ujian' => '','waktu_ujian' => '','limit' => '','kode_acak' => ''));
        $this->session->sess_destroy();
    }
}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */