<div id="navigasi">
<?php
	$this->load->model('Soal_model', 'soal', TRUE);
	$id_ujian=$this->session->userdata('id_ujian');
	$jumlah_soal=$this->soal->jumlah_soal($id_ujian)->num_rows();;
	$limit=$this->session->userdata('limit');
	$acak= $this->session->userdata('kode_acak');
	if ($jumlah_soal>0) {
		$kode_soal=explode(".",$acak);
		for($i=0;$i<$limit;$i++) {
		$terisi= $this->soal->soal_terisi($kode_soal[$i]);
		if ($terisi>0){
		$class='btn btn-primary';
		} else {
		$class='btn btn-danger';
		}
	
     echo '<input id="nv_'.($i+1).'" id=name="page" type="button"  class="'.$class.'" value="'.($i+1).'"  onclick="lompat('.$i.')" />';
	 }
	}
//	echo '<div id="aa">'.$acak.'</div>';
?>
</div>