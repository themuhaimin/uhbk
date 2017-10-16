Saat ini anda login sebagai <?php  echo ' '.$this->session->userdata('nama_admin').' '; ?>
Silakan lakukan beberapa pengelolaan dengan bijak.
<?php
$form = array(
    'id_ujian' => array(
        'name'=>'id_ujian',
        'size'=>'30',
        'value'=>set_value('id_ujian', isset($form_value['id_ujian']) ? $form_value['id_ujian'] : '')
    ),
    'submit'   => array(
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Simpan',
		'class'=>'btn tambah btn-success'
		
    )
);
?>
<!-- pesan start -->
<?php if (! empty($pesan)) : ?>
    <div class="pesan">
        <?php echo $pesan; ?>
    </div>
<?php endif ?>
<!-- pesan end -->
<table border="1">
	<thead>
	<tr><th colspan="2" >Informasi Sistem</th></tr>
	</thead><tr>
		<td>Tahun Ajaran Aktif</td><td><?php echo $t_ajaran; ?></td>
	</tr>
	<tr class="zebra">
		<td>Semester</td><td><?php echo $semester; ?></td>
	</tr>
</table>
</br>
<table border="1">
	<thead>
	<tr><th colspan="2" >Informasi Ulangan Harian yang diaktifkan</th></tr>
	</thead><tr>
		<td>Kode Ujian</td><td><?php echo $id_ujian; ?></td>
	</tr>
	<tr class="zebra">
		<td>Mata Pelajaran</td><td><?php echo $mapel_ujian_aktif; ?></td>
	</tr>
	<tr>
		<td>Kompetensi Dasar</td><td><?php echo $kd_ujian_aktif; ?></td>
	</tr>
	<tr class="zebra">
		<td>Waktu Ujian</td><td><?php echo $waktu_ujian_aktif; ?> Menit</td>
	</tr>
</table>
<?php

/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>