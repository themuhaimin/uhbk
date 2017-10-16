<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru_model extends CI_Model {

    public $db_tabel    = 'guru';
    public $per_halaman = 7;
    public $offset      = 0;

    // rules form validasi, proses TAMBAH
    private function load_form_rules_tambah()
    {
        $form = array(
                        array(
                            'field' => 'nip',
                            'label' => 'NIP',
                            'rules' => "required|max_length[10]|numeric|is_unique[$this->db_tabel.nip]"
                        ),
                        array(
                            'field' => 'nama',
                            'label' => 'Nama',
                            'rules' => 'required|max_length[50]'
                        ),
        );
        return $form;
    }

    // rules form validasi, proses EDIT
    private function load_form_rules_edit()
    {
        $form = array(
            array(
                'field' => 'nip',
                'label' => 'NIP',
                'rules' => "required|max_length[10]|numeric|callback_is_nip_exist"
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ),
        );
        return $form;
    }

    // jalankan proses validasi, untuk operasi TAMBAH
    public function validasi_tambah()
    {
        $form = $this->load_form_rules_tambah();
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

    // jalankan proses validasi, untuk operasi EDIT
    public function validasi_edit()
    {
        $form = $this->load_form_rules_edit();
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

    public function cari_semua($offset)
	{
        /**
         * $offset start
         * Gunakan hanya jika class 'PAGINATION' menggunakan option
         * 'use_page_numbers' => TRUE
         * Jika tidak, beri comment
         */        
		if (is_null($offset) || empty($offset))
        {
            $this->offset = 0;
        }
        else
        {
            $this->offset = ($offset * $this->per_halaman) - $this->per_halaman;
        }		
        // $offset end
		$answer = $this->db->query("SELECT *, IF(jabatan=1, 'Administrator', 'Guru') AS jab from guru limit $this->offset, $this->per_halaman");              
		return $answer->result();
	}
    public function cari($nip)
    {
        return $this->db->where('nip', $nip)
            ->limit(1)
            ->get($this->db_tabel)
            ->row();
    }

    public function buat_tabel($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'NIS', 'Nama', 'Jabatan', 'Aksi');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->nip,
                $row->nama,
                $row->jab,
                anchor('guru/edit/'.$row->nip,'Edit',array('class' => 'btn btn-primary'))
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    public function paging($base_url)
    {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $this->hitung_semua(),
            'per_page'         => $this->per_halaman,
            'num_links'        => 4,			
			'use_page_numbers' => TRUE,
            'first_link'       => '&#124;&lt; First',
            'last_link'        => 'Last &gt;&#124;',
            'next_link'        => 'Next &gt;',
            'prev_link'        => '&lt; Prev',
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function hitung_semua()
    {
        return $this->db->count_all($this->db_tabel);
    }

    public function tambah()
    {
        $guru = array(
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
			'status' => $this->input->post('status'),
			'password' => md5($this->input->post('password'))
        );
        $this->db->insert($this->db_tabel, $guru);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($nip)
    {   $password=$this->input->post('password');
        $guru = array(
            'nip'=>$this->input->post('nip'),
            'nama'=>$this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
			'status' => $this->input->post('status'),
        );
		if($password!=""){
		$guru['password']=md5($password);
		}
        // update db
        $this->db->where('nip', $nip);
        $this->db->update($this->db_tabel, $guru);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function hapus($nip)
    {
        $this->db->where('nip', $nip)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function coba()
    {
	$form = array(
                        array(
                            'field' => 'nis',
                            'label' => 'NIS',
                            'rules' => "required|exact_length[4]|numeric|is_unique[$this->db_tabel.nis]"
                        ),
                        array(
                            'field' => 'nama',
                            'label' => 'Nama',
                            'rules' => 'required|max_length[50]'
                        ),
                        array(
                            'field' => 'id_kelas',
                            'label' => 'Kelas',
                            'rules' => 'required'
                        ),
        );
		return $form;
	}
}
/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */