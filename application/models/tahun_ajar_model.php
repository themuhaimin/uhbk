<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tahun_ajar_model extends CI_Model {

    public $db_tabel    = 't_ajaran';
    public $per_halaman = 5;
    public $offset      = 0;

    // rules form validasi, proses TAMBAH
    private function load_form_rules_tambah()
    {
        $form = array(
                        array(
                            'field' => 'id_tahun',
                            'label' => 'Kode Ujian',
                            'rules' => "required|is_unique[$this->db_tabel.id_ajar]"
                        ),
                        array(
                            'field' => 't_ajaran',
                            'label' => 'Tahun Ajaran',
                            'rules' => 'required|max_length[50]'
                        )
        );
        return $form;
    }

    // rules form validasi, proses EDIT
    private function load_form_rules_edit()
    {
        $form = array(
                        array(
                            'field' => 'id_tahun',
                            'label' => 'Kode Ujian',
                            'rules' => "required|max_length[2]"
                        ),
                        array(
                            'field' => 't_ajaran',
                            'label' => 'Tahun Ajaran',
                            'rules' => 'required|max_length[50]'
                        )
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

        return $this->db->select('*')
                        ->from($this->db_tabel)
                        ->limit($this->per_halaman, $this->offset)
                        ->order_by('id_ajar', 'ASC')
                        ->get()
                        ->result();
	}

    public function cari($id_ajar)
    {
        return $this->db->where('id_ajar', $id_ajar)
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
        $this->table->set_heading('SET', 'KODE TAHUN AJARAN', 'Tahun Ajaran','Semester','Aksi');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {
			if($row->status==1){
				$selected="selected";
			} else {
				$selected=null;
			}
            $this->table->add_row(
                form_radio('set_tahun', $row->id_ajar, $selected, 'id=tahun'),
                $row->id_ajar,
                $row->t_ajaran,
				$row->semester,
                anchor('tahun_ajar/edit/'.$row->id_ajar,'Edit',array('class' => 'btn btn-warning'))
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
        $tahun = array(
            'id_ajar' => $this->input->post('id_tahun'),
            't_ajaran' => $this->input->post('t_ajaran'),
			'semester' => $this->input->post('semester'),
			'status' => '0'
        );
        $this->db->insert($this->db_tabel, $tahun);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($id_ajar)
    {
        $tahun = array(
            'id_ajar' => $this->input->post('id_tahun'),
            't_ajaran' => $this->input->post('t_ajaran'),
			'semester' => $this->input->post('semester'),
        );

        // update db
        $this->db->where('id_ajar', $id_ajar);
        $this->db->update($this->db_tabel, $tahun);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function hapus($id_ujian)
    {
        $this->db->where('id_ujian', $id_ujian)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
public function t_ajaran_aktif()
	{
        return $this->db->select('*')
                        ->from($this->db_tabel)
                        ->where('status',1)
                        ->get()
                        ->result();
	}
	public function option_ujian()
	{
        return $this->db->select('*')
                        ->from($this->db_tabel)
                        ->order_by('mapel', 'ASC')
                        ->get()
                        ->result();
	}
    public function insert_aktif()
    {
	    $id_ajar= $this->input->post('set_tahun');
        // update db
        $aktif = $this->db->query("UPDATE  `t_ajaran` SET  `status` =1 WHERE  `id_ajar` =  '$id_ajar'");
        $pasif = $this->db->query("UPDATE  `t_ajaran` SET  `status` =0 WHERE  `id_ajar` !=  '$id_ajar'");
        if($aktif)
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