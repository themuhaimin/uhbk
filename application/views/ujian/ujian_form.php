<?php
$form = array(
    'id_ujian' => array(
        'name'=>'id_ujian',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('id_ujian', isset($form_value['id_ujian']) ? $form_value['id_ujian'] : '')
    ),
    'mapel'    => array(
        'name'=>'mapel',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('mapel', isset($form_value['mapel']) ? $form_value['mapel'] : '')
    ), 
	'jumlah_soal'    => array(
        'name'=>'jumlah_soal',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('jumlah_soal', isset($form_value['jumlah_soal']) ? $form_value['jumlah_soal'] : '')
    ),
	'kd'    => array(
        'name'=>'kd',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('kd', isset($form_value['kd']) ? $form_value['kd'] : '')
    ), 	
	'waktu'    => array(
        'name'=>'waktu',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('waktu', isset($form_value['waktu']) ? $form_value['waktu']/60 : '')
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
        <td><?php echo form_label('Kode', 'id_ujian'); ?></td>
        <td><?php echo form_input($form['id_ujian']); ?></td>
	</tr>
	<?php echo form_error('id_ujian', '<p class="field_error">', '</p>');?>
	
	<tr>
        <td><?php echo form_label('Mata Pelajaran', 'mapel'); ?></td>
        <td><?php echo form_input($form['mapel']); ?></td>
	</tr>
	<?php echo form_error('mapel', '<p class="field_error">', '</p>');?>	

	<tr>
	<tr>
        <td><?php echo form_label('Jumlah Soal', 'kd'); ?></td>
        <td><?php echo form_input($form['jumlah_soal']); ?></td>
	</tr>
	<?php echo form_error('kd', '<p class="field_error">', '</p>');?>	
	<tr>
	<tr>
        <td><?php echo form_label('Kompetensi Dasar', 'kd'); ?></td>
        <td><?php echo form_input($form['kd']); ?></td>
	</tr>
	<?php echo form_error('kd', '<p class="field_error">', '</p>');?>	

	<tr>
        <td><?php echo form_label('Waktu  (Menit)', 'waktu'); ?></td>
        <td><?php echo form_input($form['waktu']); ?></td>
	</tr>
	<?php echo form_error('waktu', '<p class="field_error">', '</p>');?>	

	<tr>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('ujian','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>