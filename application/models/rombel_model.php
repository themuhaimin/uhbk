<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rombel_model extends CI_Model {

    public $db_tabel = 't_paralel';
    public $per_halaman = 11;
    public $offset      = 0;

	public function __construct()
	{
        parent::__construct();
	}
    public function cari_semua()
    {
        return $this->db->order_by('id_kelas', 'ASC')
                        ->get($this->db_tabel)
                        ->result();
    }

    public function cari($id_kelas,$id_ajaran=null)
    {
        return $this->db->where('t_paralel.id_kelas', $id_kelas)
						->where('t_paralel.id_ajar', $id_ajaran)
						->order_by('siswa.nama', 'ASC')
						->join('siswa', 'siswa.nis=t_paralel.nis')
                        ->get($this->db_tabel)
                        ->result();
    }

    public function buat_tabel($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        /// heading tabel
        $this->table->set_heading('No', 'NIS','Nama', 'Aksi');

        $no = 0;
        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->nis,
				$row->nama,
                anchor('kelola_rombel/hapus/'.$row->nis.'/'.$this->uri->segment(3),'Keluarkan',array('class' => 'btn btn-danger','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    public function tambah()
    {
        $kelas = array(
                      'id_kelas' => $this->input->post('id_kelas'),
                      'kelas' => $this->input->post('kelas'),
					  'tingkat' => $this->input->post('tingkat')
                      );
        $this->db->insert($this->db_tabel, $kelas);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($id_kelas)
    {
        $kelas = array(
            'id_kelas'=>$this->input->post('id_kelas'),
            'kelas'=>$this->input->post('kelas'),
			'tingkat' => $this->input->post('tingkat')
        );

        // update db
        $this->db->where('id_kelas', $id_kelas);
		$this->db->update($this->db_tabel, $kelas);

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
        $this->db->where('nis', $nis)
				 ->where('id_ajar', $this->session->userdata('id_ajaran'))
				 ->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	//untuk pengeceken siapa yang sudah masuk paralel semester ini
	public function sudah_masuk_paralel($id_ajaran=null)
	{
		$db= $this->db->where('id_ajar',$this->session->userdata('id_ajaran'))
						->select('*')
                        ->from('t_paralel')
                        ->get()
                        ->result();
		$i=0;
		foreach($db as $row){
			if($i>0){
				$opp=" AND";
			} else {
				$opp="";
			}
			$data[$i]='nis != '.$row->nis;
			$i++;		
		}
		if($i>0){
				$hasil=implode(" AND ",$data);
			} else {
				$hasil="nis !=0";
			}
	return $hasil;
	}
	public function cari_siswa($offset,$exist)
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

        return $this->db->select('siswa.nis, siswa.nama')
                        ->from('siswa')
						->where($exist)
						->limit($this->per_halaman, $this->offset)
                        ->order_by('nis', 'ASC')
                        ->get()
                        ->result();
	}
	    public function buat_tabel_siswa($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'NIS', 'Nama');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row)
        {
            $this->table->add_row(
                form_checkbox('siswa_tambah[]', $row->nis, FALSE),
                $row->nis,
                $row->nama
                
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }
	 public function simpanParalel($nis,$id_kelas)
    {
		$paralel = array(
            'nis' => $nis,
            'id_kelas' => $id_kelas,
			'id_ajar' => $this->session->userdata('id_ajaran')
        );
        $this->db->insert($this->db_tabel, $paralel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
	}
	 public function hitung_semua()
    {
        $exist=$this->sudah_masuk_paralel($this->session->userdata('id_ajaran'));
		$sql= $this->db->where($exist)
		->get('siswa');
		return $sql->num_rows();
    }
	public function paging($base_url,$exist)
    {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $this->hitung_semua($exist),
            'per_page'         => $this->per_halaman,
            'num_links'        => 2,			
			'use_page_numbers' => TRUE,
            'first_link'       => '&#124;&lt; First',
            'last_link'        => 'Last &gt;&#124;',
            'next_link'        => 'Next &gt;',
            'prev_link'        => '&lt; Prev',
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
/* End of file kelas_model.php */
/* Location: ./application/models/kelas_model.php */