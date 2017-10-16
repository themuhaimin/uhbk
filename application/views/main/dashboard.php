	<script>
$().ready(function(){
loadkelas();
loadsiswa();
loadkd();
	$('#mapel').change(function(){
	loadkelas();
	loadsiswa();
	loadkd();
	$('#kelas').val(0);
	});
	$('.isi').change(function(){
		loadsiswa();
		kd_select();
	});
	$('.txt_nilai').keyup(function(){
	alert('aaaaaaaaaaaaaaa');
	});
	
});
function loadkelas() {
var mapel = $('#mapel').val();
		//alert(mapel);
		$.post('<?php echo base_url().'index.php/dashboard/kelasnya'; ?>',{mapel:mapel},function (hasilnya) {
			$('#kelas').html(hasilnya);
		});};
function loadsiswa() {
var kelas = $('#kelas').val();
		//alert(kelas);
		$.post('<?php echo base_url().'index.php/dashboard/siswanya'; ?>',{kelas:kelas},function (hasilnya) {
			$('#hasil').html(hasilnya).fadeTo('normal',1,function() {
							$(this).fadeTo('normal',1);
		});});
		}
function loadkd() {
var mapel = $('#mapel').val();
		//alert(mapel);
		$.post('<?php echo base_url().'index.php/dashboard/kd'; ?>',{mapel:mapel},function (hasilnya) {
			$('#kd').html(hasilnya);
		});};
function kd_select() {
var mapel = $('#mapel').val();
var id_kd = $('#kd').val();
		//alert(mapel);
		$.post('<?php echo base_url().'index.php/dashboard/kd_select'; ?>',{mapel:mapel,id_kd:id_kd},function (hasilnya) {
			$('#kd_select').html(hasilnya);
		});};
</script>
<select name="mapel" id="mapel">
 <?php 
	$i=1;
	foreach($mapel as $baris){
	echo '<option value="'.$baris->id_mapel.'">'.$baris->mapel.'</option>';
	}
				?>
</select>
<select name="kelas" class="isi" id="kelas">
</select>
<select name="kd" class="isi" id="kd">
</select>
<div id="frm_kd">
	<div id="kd_select"></div>
</div>
<div id="ket"></div>
	<div id="hasil"></div>