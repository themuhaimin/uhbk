<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Butir_soal_model extends CI_Model {
        public $db_tabel    = 'soal';
    // keluarkan soal
	
    public function cari_soal($id_ujian)
	{
              return $this->db->select('*')
						->where('id_ujian',$id_ujian)
                        ->get('soal')
                        ->result();
	}
	public function cari_mapel($id_ujian)
	{
              return $this->db->select('*')
						->where('id_ujian',$id_ujian)
                        ->get('ujian')
                        ->result();
	}
	    public function cari($id_soal)
	{
		return $this->db->where('id_soal', $id_soal)
            ->limit(1)
            ->get('soal')
            ->row();
	}
	    public function buat_tabel($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'Soal','A', 'B', 'C', 'D','Kunci','Edit');

        // no urut data
        $no = 0 ;

        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->soal,
				$row->a,
				$row->b,
				$row->c,
				$row->d,
				$row->kunci,
				anchor('butir_soal/edit/'.$row->id_ujian.'/'.$row->id_soal,'Edit',array('class' => 'btn btn-primary')).' '.
                anchor('butir_soal/hapus/'.$row->id_ujian.'/'.$row->id_soal,'Hapus',array('class'=> 'btn btn-danger','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }
	public function tambah($id_ujian)
    {
        $soal = array(
            'id_ujian' => $id_ujian,
            'soal' => $this->input->post('soal'),
			'a' => $this->input->post('a'),
			'b' => $this->input->post('b'),
			'c' => $this->input->post('c'),
			'd' => $this->input->post('d'),
			'kunci' => $this->input->post('kunci')
        );
        $this->db->insert('soal', $soal);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function edit($id_soal)
    {
            $soal = array(    
            'soal' => $this->input->post('soal'),
			'a' => $this->input->post('a'),
			'b' => $this->input->post('b'),
			'c' => $this->input->post('c'),
			'd' => $this->input->post('d'),
			'kunci' => $this->input->post('kunci')
        );

        // update db
        $this->db->where('id_soal', $id_soal);
        $this->db->update($this->db_tabel, $soal);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	    public function hapus($id_soal)
    {
        $this->db->where('id_soal', $id_soal)->delete($this->db_tabel);

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