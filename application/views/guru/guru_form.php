<?php
$form = array(
    'nip' => array(
        'name'=>'nip',
        'size'=>'70',
        'class'=>'form_field',
        'value'=>set_value('nip', isset($form_value['nip']) ? $form_value['nip'] : '')
    ),
    'nama'    => array(
        'name'=>'nama',
        'size'=>'70',
        'class'=>'form_field',
        'value'=>set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '')
    ),    
	'jabatan'    => array(
        'name'=>'jabatan',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('jabatan', isset($form_value['jabatan']) ? $form_value['jabatan'] : '')
    ), 
	'password'    => array(
        'name'=>'password',
		'type'=>'password',
        'size'=>'70',
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
        <td><?php echo form_label('NIP', 'nip'); ?></td>
        <td><?php echo form_input($form['nip']); ?></td>
	</tr>
	<?php echo form_error('nip', '<p class="field_error">', '</p>');?>
	
	<tr>
        <td><?php echo form_label('Nama', 'nama'); ?></td>
        <td><?php echo form_input($form['nama']); ?></td>
	</tr>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>	
	<tr>
        <td><?php echo form_label('Jabatan', 'jabatan'); ?></td>
		 <td><?php echo form_dropdown('jabatan', $option_jabatan, set_value('jabatan', isset($form_value['jabatan']) ? $form_value['jabatan'] : '')); ?></td>
	</tr>

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

	<?php echo form_error('jabatan', '<p class="field_error">', '</p>');?>	
	<tr>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('guru','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>