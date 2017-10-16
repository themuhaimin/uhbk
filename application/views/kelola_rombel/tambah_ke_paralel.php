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
    'submit'   => array(
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Simpan',
		'class'=>'btn tambah btn-success'
    )
);
?>
<!-- pesan flash message start -->
<?php $flash_pesan = $this->session->flashdata('pesan')?>
<?php if (! empty($flash_pesan)) : ?>
    <div class="pesan">
        <?php echo $flash_pesan; ?>
    </div>
<?php endif ?>
<!-- pesan flash message end -->

<!-- pesan start -->
<?php if (! empty($pesan)) : ?>
    <div class="pesan">
        <?php echo $pesan; ?>
    </div>
<?php endif ?>
<!-- pesan end -->
<?php echo form_open($form_action); ?>
<!-- pagination start -->
<?php if (! empty($pagination)) : ?>
    <div id="pagination">
        <?php echo $pagination; ?>
    </div>
<?php endif ?>
<!-- paginatin end -->

<!-- tabel data start -->
<?php if (! empty($tabel_data)) : ?>
        <?php echo $tabel_data; ?>
<?php endif ?>
<!-- tabel data end -->

<div id="bottom_link">
		<td><?php echo form_submit($form['submit']); ?>
        <?php echo anchor('kelola_rombel/index/'.$this->session->userdata('id_kelas'),'Batal', array('class' => 'btn tambah btn-success')) ?></td>
</div>
<?php echo form_close(); ?>