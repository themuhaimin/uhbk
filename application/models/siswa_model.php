<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    public $db_tabel    = 'siswa';
    public $per_halaman = 8;
    public $offset      = 0;

    // rules form validasi, proses TAMBAH
    private function load_form_rules_tambah()
    {
        $form = array(
                        array(
                            'field' => 'nis',
                            'label' => 'NIS',
                            'rules' => "required|max_length[10]|numeric|is_unique[$this->db_tabel.nis]"
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
                'field' => 'nis',
                'label' => 'NIS',
                'rules' => "required|max_length[10]|numeric|callback_is_nis_exist"
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|max_length[50]'
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

        return $this->db->select('siswa.nis, siswa.nama,siswa.status')
                        ->from($this->db_tabel)
                        ->order_by('nis', 'ASC')
						->limit($this->per_halaman,$offset)
                        ->get()
                        ->result();
	}

    public function cari($nis)
    {
        return $this->db->where('nis', $nis)
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
        $this->table->set_heading('No', 'NIS', 'Nama', 'Status', 'Aksi');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {
			if($row->status==1){$status="Aktif";} else {$status="Tidak Aktif";}
            $this->table->add_row(
                ++$no,
                $row->nis,
                $row->nama,
				$status,
                anchor('siswa/edit/'.$row->nis,'Edit',array('class' => 'btn btn-primary'))
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
        $siswa = array(
            'nis'=>$this->input->post('nis'),
            'nama'=>$this->input->post('nama'),
			'password'=>md5($this->input->post('password')),
			'status' =>$this->input->post('status')
        );
        $this->db->insert($this->db_tabel, $siswa);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($nis)
    {
		$password=$this->input->post('password');
        $siswa = array(
            'nis'=>$this->input->post('nis'),
            'nama'=>$this->input->post('nama'),
			'status' =>$this->input->post('status')
        );
		if($password!=""){
		$siswa['password']=md5($password);
		}
        // update db
        $this->db->where('nis', $nis);
        $this->db->update($this->db_tabel, $siswa);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function hapus($nis)
    {
        $this->db->where('nis', $nis)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */