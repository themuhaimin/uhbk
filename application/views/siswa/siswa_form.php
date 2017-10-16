<?php
$form = array(
    'nis' => array(
        'name'=>'nis',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('nis', isset($form_value['nis']) ? $form_value['nis'] : '')
    ),
    'nama'    => array(
        'name'=>'nama',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '')
    ),    
	'password'    => array(
        'name'=>'password',
		'type'=>'password',
        'size'=>'30',
        'class'=>'form_field'
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
        <td><?php echo form_label('NIS', 'nis'); ?></td>
        <td><?php echo form_input($form['nis']); ?></td>
	</tr>
	<?php echo form_error('nis', '<p class="field_error">', '</p>');?>
	
	<tr>
        <td><?php echo form_label('Nama', 'nama'); ?></td>
        <td><?php echo form_input($form['nama']); ?></td>
	</tr>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>	

		<tr>
        <td><?php echo form_label('Password', 'password'); ?></td>
        <td><?php echo form_input($form['password']); ?></td>
	</tr>
	<?php echo form_error('password', '<p class="field_error">', '</p>');?>	

	<tr>
        <td><?php echo form_label('Status', 'status'); ?></td>
        <td><?php echo form_dropdown('status', $option_status,set_value('status', isset($form_value['status']) ? $form_value['status'] : '')); ?></td>
	</tr>
	<?php echo form_error('status', '<p class="field_error">', '</p>');?>

	<tr>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('siswa','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>