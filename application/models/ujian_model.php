<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_model extends CI_Model {

    public $db_tabel    = 'ujian';
    public $per_halaman = 5;
    public $offset      = 0;

    // rules form validasi, proses TAMBAH
    private function load_form_rules_tambah()
    {
        $form = array(
                        array(
                            'field' => 'id_ujian',
                            'label' => 'Kode Ujian',
                            'rules' => "required|is_unique[$this->db_tabel.id_ujian]"
                        ),
                        array(
                            'field' => 'mapel',
                            'label' => 'Mata Pelajaran',
                            'rules' => 'required|max_length[50]'
                        ),
                        array(
                            'field' => 'kd',
                            'label' => 'KD',
                            'rules' => 'required'
                        ),
						array(
                            'field' => 'waktu',
                            'label' => 'Waktu',
                            'rules' => "required|numeric|max_length[3]"
                        ),
        );
        return $form;
    }

    // rules form validasi, proses EDIT
    private function load_form_rules_edit()
    {
        $form = array(
            array(
                'field' => 'id_ujian',
                'label' => 'Kode Ujian',
                'rules' => "required|callback_is_id_ujian_exist"
			    //'rules' => "required"
				),
                array(
                'field' => 'mapel',
                'label' => 'Mata Pelajaran',
                'rules' => 'required|max_length[50]'
                ),
                array(
                'field' => 'kd',
                'label' => 'KD',
                'rules' => 'required'
                ),
				array(
                'field' => 'waktu',
                'label' => 'Waktu',
                'rules' => "required|numeric|max_length[3]"
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

        return $this->db->select('*')
                        ->from($this->db_tabel)
                        ->limit($this->per_halaman, $this->offset)
                        ->order_by('mapel', 'ASC')
                        ->get()
                        ->result();
	}

    public function cari($id_ujian)
    {
        return $this->db->where('id_ujian', $id_ujian)
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
        $this->table->set_heading('SET', 'Kode', 'Mata Pelajaran', 'Kompetensi Dasar','Jml Soal','Waktu', 'Aksi');

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
                form_radio('set_ujian', $row->id_ujian, $selected, 'id=ujian'),
                $row->id_ujian,
                $row->mapel,
                $row->kd,
				$row->jumlah_soal,
				($row->waktu/60)." Menit",
				anchor('butir_soal/kelola/'.$row->id_ujian,'Kelola Soal',array('class' => 'btn btn-primary')).' '.
                anchor('ujian/edit/'.$row->id_ujian,'Edit',array('class' => 'btn btn-warning')).' '.
                anchor('ujian/hapus/'.$row->id_ujian,'Hapus',array('class'=> 'btn btn-danger','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
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
        $ujian = array(
            'id_ujian' => $this->input->post('id_ujian'),
            'mapel' => $this->input->post('mapel'),
			'jumlah_soal' => $this->input->post('jumlah_soal'),
			'kd' => $this->input->post('kd'),
            'waktu' => ($this->input->post('waktu')*60),
			'status' => '0'
        );
        $this->db->insert($this->db_tabel, $ujian);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($id_ujian)
    {
        $ujian = array(
            'id_ujian' => $this->input->post('id_ujian'),
            'mapel' => $this->input->post('mapel'),
			'jumlah_soal' => $this->input->post('jumlah_soal'),
			'kd' => $this->input->post('kd'),
            'waktu' => ($this->input->post('waktu')*60)
        );

        // update db
        $this->db->where('id_ujian', $id_ujian);
        $this->db->update($this->db_tabel, $ujian);

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
public function ujian_aktif()
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
	    $id_ujian= $this->input->post('set_ujian');
        $ujian_aktif = array(
			'status' => '1'
        );
		$ujian_pasif = array(
			'status' => '0'
        );
        // update db
        $aktif = $this->db->query("UPDATE  `ujian` SET  `status` =1 WHERE  `id_ujian` =  '$id_ujian'");
        $pasif = $this->db->query("UPDATE  `ujian` SET  `status` =0 WHERE  `id_ujian` !=  '$id_ujian'");
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