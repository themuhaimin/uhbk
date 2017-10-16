<?php
$form = array(
    'id_kelas' => array(
                        'name'=>'id_kelas',
                        'size'=>'30',
                        'class'=>'form_field',
                        'value'=>set_value('id_kelas', isset($form_value['id_kelas']) ? $form_value['id_kelas'] : '')
                  ),
    'kelas'    => array(
                        'name'=>'kelas',
                        'size'=>'30',
                        'class'=>'form_field',
                        'value'=>set_value('kelas', isset($form_value['kelas']) ? $form_value['kelas'] : '')
                  ),
	'tingkat'    => array(
        'name'=>'tingkat',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('tingkat', isset($form_value['tingkat']) ? $form_value['tingkat'] : '')
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
<?php $flash_pesan = $this->session->flashdata('pesan')?>
<?php if (! empty($flash_pesan)) : ?>
    <div class="pesan">
        <?php echo $flash_pesan; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- form start -->
<?php echo form_open($form_action); ?>
<table>
	<tr>
        <td><?php echo form_label('Kode Kelas', 'id_kelas'); ?></td>
        <td><?php echo form_input($form['id_kelas']); ?></td>
	</tr>
	<?php echo form_error('id_kelas', '<p class="field_error">', '</p>');?>
	<tr>
        <td><?php echo form_label('Tingkat Kelas', 'tingkat'); ?></td>
		 <td><?php echo form_dropdown('tingkat', $option_tingkat, set_value('tingkat', isset($form_value['tingkat']) ? $form_value['tingkat'] : '')); ?></td>
	</tr>
	<tr>
        <td><?php echo form_label('Nama Kelas', 'kelas'); ?></td>
        <td><?php echo form_input($form['kelas']); ?></td>
	</tr>
	<?php echo form_error('kelas', '<p class="field_error">', '</p>');?>	

	<tr>
        <td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('kelas','Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- form end -->

<?php
/* End of file kelas_form.php */
/* Location: ./application/views/kelas/kelas_form.php */
?>