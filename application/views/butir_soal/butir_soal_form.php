<?php
$form = array(
    'id_soal' => array(
        'name'=>'id_soal',
        'size'=>'30',
        'class'=>'form_field',
		'type'=>'hidden',
        'value'=>set_value('id_soal', isset($form_value['id_soal']) ? $form_value['id_soal'] : '')
    ),
	'soal' => array(
        'name'=>'soal',
        'size'=>'30',
        'class'=>'ckeditor',
        'value'=>set_value('soal', isset($form_value['soal']) ? $form_value['soal'] : '')
    ),
    'a'    => array(
        'name'=>'a',
		'id'=>'a',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('a', isset($form_value['a']) ? $form_value['a'] : '')
    ),
	'b'    => array(
        'name'=>'b',
		'id'=>'b',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('b', isset($form_value['b']) ? $form_value['b'] : '')
    ),    
	'c'    => array(
        'name'=>'c',
		'id'=>'c',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('c', isset($form_value['c']) ? $form_value['c'] : '')
    ),    
	'd'    => array(
        'name'=>'d',
		'id'=>'d',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('d', isset($form_value['d']) ? $form_value['d'] : '')
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
<script type="text/javascript" src="<?php echo base_url(); ?>asset/plugins/ckeditor/ckeditor.js"></script>
<?php echo form_open($form_action); ?>
<table>
	<tr>
        <td><?php echo form_input($form['id_soal']); ?></td>
	</tr>
	
	<tr>
        <td><?php echo form_label('Soal', 'soal'); ?></td>
        <td><?php echo form_textarea($form['soal']); ?></td>
	</tr>
	<?php echo form_error('soal', '<p class="field_error">', '</p>');?>
	
	<tr>
        <td><?php echo form_label('Jawab A', 'a'); ?></td>
        <td><?php echo form_input($form['a']); ?><button class="btn btn-success" id="btna">Browse</button></td>
	</tr>
	<?php echo form_error('a', '<p class="field_error">', '</p>');?>	
	<tr>
	<tr>
        <td><?php echo form_label('Jawab B', 'b'); ?></td>
        <td><?php echo form_input($form['b']); ?><button class="btn btn-success" id="btnb">Browse</button></td>
	</tr>
	<?php echo form_error('b', '<p class="field_error">', '</p>');?>	
	<tr>
	<tr>
        <td><?php echo form_label('Jawab C', 'c'); ?></td>
        <td><?php echo form_input($form['c']); ?><button class="btn btn-success" id="btnc">Browse</button></td>
	</tr>
	<?php echo form_error('c', '<p class="field_error">', '</p>');?>	
	<tr>
	<tr>
        <td><?php echo form_label('Jawab D', 'd'); ?></td>
        <td><?php echo form_input($form['d']); ?><button class="btn btn-success" id="btnd">Browse</button></td>
	</tr>
	<?php echo form_error('d', '<p class="field_error">', '</p>');?>	
		<tr>
        <td><?php echo form_label('Kunci', 'kunci'); ?></td>
        <td><?php echo form_dropdown('kunci', $kunci, set_value('kunci', isset($form_value['kunci']) ? $form_value['kunci'] : '')); ?></td>
	</tr>
	<?php echo form_error('kunci', '<p class="field_error">', '</p>');?>

	<tr>
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('butir_soal/kelola/'.$this->uri->segment(3),'Batal', array('class' => 'btn tambah btn-success')) ?></td>
	</tr>
</table>
<?php echo $this->session->userdata('kcfinder_mati'); ?>
<?php echo form_close(); ?>
<!-- form start -->
<script>
$( document ).ready(function() {
	$("#btna").click(function(){
				window.KCFinder = {
					callBack: function(url) {
						$('#a').val(url);
						window.KCFinder = null;					
					}
				};
				window.open('<?php echo base_url(); ?>asset/kcfinder/browse.php?type=images', 'kcfinder_textbox',
					'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
					'resizable=1, scrollbars=0, width=800, height=600'
				);
				return false;
			});
		$("#btnb").click(function(){
				window.KCFinder = {
					callBack: function(url) {
						$('#b').val(url);
						window.KCFinder = null;					
					}
				};
				window.open('<?php echo base_url(); ?>asset/kcfinder/browse.php?type=images', 'kcfinder_textbox',
					'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
					'resizable=1, scrollbars=0, width=800, height=600'
				);
				return false;
			});
		$("#btnc").click(function(){
				window.KCFinder = {
					callBack: function(url) {
						$('#c').val(url);
						window.KCFinder = null;					
					}
				};
				window.open('<?php echo base_url(); ?>asset/kcfinder/browse.php?type=images', 'kcfinder_textbox',
					'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
					'resizable=1, scrollbars=0, width=800, height=600'
				);
				return false;
			});
		$("#btnd").click(function(){
				window.KCFinder = {
					callBack: function(url) {
						$('#d').val(url);
						window.KCFinder = null;					
					}
				};
				window.open('<?php echo base_url(); ?>asset/kcfinder/browse.php?type=images', 'kcfinder_textbox',
					'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
					'resizable=1, scrollbars=0, width=800, height=600'
				);
				return false;
			});
	
});
    </script> 
<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>