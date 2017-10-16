<?php
$form = array(
    'id_tahun' => array(
        'name'=>'id_tahun',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('id_tahun', isset($form_value['id_ajar']) ? $form_value['id_ajar'] : '')
    ),
    't_ajaran'    => array(
        'name'=>'t_ajaran',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('t_ajaran', isset($form_value['t_ajaran']) ? $form_value['t_ajaran'] : '')
    ), 
	'semester'    => array(
        'name'=>'semester',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('semester', isset($form_value['semester']) ? $form_value['semester'] : '')
    ),
	'submit'   => array(
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Simpan',
		'class'=>'btn tambah btn-success'
    )
	)
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
        <td><?php echo form_label('Kode', 'id_tahun'); ?></td>
        <td><?php echo form_input($form['id_tahun']); ?></td>
	</tr>
	<?php echo form_error('id_tahun', '<p class="field_error">', '</p>');?>
	
	<tr>
        <td><?php echo form_label('Tahun Ajaran', 't_ajaran'); ?></td>
        <td><?php echo form_input($form['t_ajaran']); ?></td>
	</tr>
	<?php echo form_error('t_ajaran', '<p class="field_error">', '</p>');?>	

	<tr>
	<tr>
        <td><?php echo form_label('Semester', 'semester'); ?></td>
		 <td><?php echo form_dropdown('semester', $option_semester, set_value('semester', isset($form_value['semester']) ? $form_value['semester'] : '')); ?></td>
	</tr>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('tahun_ajar','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>