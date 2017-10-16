<!-- pesan flash message start -->
<?php $flash_pesan = $this->session->flashdata('pesan')?>
<div id="bottom_link">
    <?php echo anchor('kelola_rombel/tambah/1/'.$id_kelas,'Tambah Siswa', array('class' => 'btn tambah btn-success')) ?> 
	<?php echo anchor('kelas/','Kembali', array('class' => 'btn tambah btn-success')) ?>
</div></br>
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

<!-- tabel data start -->
<?php if (! empty($tabel_data)) : ?>
    <?php echo $tabel_data; ?>
<?php endif ?>
<!-- tabel data end -->
<?php
/* End of file kelas.php */
/* Location: ./application/views/kelas/kelas.php */
?>