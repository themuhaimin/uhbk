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

<!-- form start -->
<?php echo form_open($form_action); ?>
<table>	
	<tr>
        <td><?php echo form_label('Ujian yang akan diaktifkan', 'id_ujian'); ?></td>
        <td><?php echo form_dropdown('id_ujian', $option_ujian, set_value('id_ujian', $id_ujian)); ?></td>
	</tr>
	<?php echo form_error('id_kelas', '<p class="field_error">', '</p>');?>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('ujian','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form start -->
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