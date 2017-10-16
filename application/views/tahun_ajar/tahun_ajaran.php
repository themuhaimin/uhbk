<?php
$form = array(
    'submit'   => array(
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Aktifkan',
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
<!-- form start -->
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
	<?php echo form_submit($form['submit']); ?><?php echo anchor('tahun_ajar/tambah/','Tambah', array('class' => 'btn tambah btn-success')) ?>
</div>
<?php echo form_close(); ?>
<!-- form start -->