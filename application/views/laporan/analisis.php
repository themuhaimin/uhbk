<?php
$form = array(
    'mapel' => array(
        'name'=>'mapels',
        'size'=>'30',
        'class'=>'mapel'
    ),
    'nama'    => array(
        'name'=>'nama',
        'size'=>'30',
        'class'=>'form_field',
        'value'=>set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '')
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
<table><tr>
		<td>Mapel yang diujikan</td><td><select class="mapel">
			<?php foreach ($option as $row){
				echo '<option value="'.$row->id_ujian.'">'.$row->mapel.' KD ('.substr($row->kd,0,3).')</option>';
					}	?>
				</select></td>
		</tr>
</table>
<br>
<div id="data">
</div>
<!-- tabel data end -->
<div id="bottom_link">
	
</div>
<?php echo form_close(); ?>
<!-- form start -->
<script type="text/javascript" src="http://localhost/uhbk/asset/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//load pertama kali
		var mapel=$(".mapel").val();
		var kelas=$(".kelas").val();
		$.post('<?php echo base_url().'index.php/laporan/keluar_analisa/'; ?>'+mapel+'/'+kelas,{mapel:mapel},function(tabelnya) {
				$('#data').html(tabelnya);
			});
		//ketika user memilih mapel
		$(".mapel").change(function() {
			var mapel=$(".mapel").val();
			$.post('<?php echo base_url().'index.php/laporan/keluar_analisa/'; ?>'+mapel+'/'+kelas,{mapel:mapel},function(tabelnya) {
				$('#data').html(tabelnya);
			});
		});
	});
</script>
Tingkat Kesukaran dan Daya Pembeda dihitung dengan rumus berikut :

<img src="<?php echo base_url(); ?>upload/rumus.png"/>