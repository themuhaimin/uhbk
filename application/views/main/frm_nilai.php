<script>
function simpan() {
		var total_bar=$('#tbl_sis').html();
		var itung=1;
		//alert(total_bar);
		while ( itung <= total_bar) {
			var nisnya = "#nis" + itung;
			var nis = $(nisnya).html();
			var nilainya = "#nilai" + itung;
			var nilai = $(nilainya).val();
			var ketnya = "#ket" + itung;
			var keterangan = $(ketnya).html();
			if (nilai != '') {
				alert(nis);			
			}
			itung++;
		}
}
$("tr:odd").css("background-color","#B3ED87"); //ngasih belang
$('.txt_nilai').blur(function(){
	if($('#kd').val()==0){
		alert("Pastikan mengisi Kompetensi Dasar(KD) dengan benar");
		} else if (($(this).val()!='') && ($(this).val()<=100) ) {
	if(Number($(this).val())<75) {
				var keterangan='Remedial';
				$(this).parents('tr').attr('style','background-color:#F277A3')
			} else {
				var keterangan='Tuntas';
			}
			$(this).parents('td').siblings('td:last').html(keterangan);
		} else {
			$(this).val('');
			$(this).parents('td').siblings('td:last').html("nilai harus 0-100");
		}
});
function masuknilai() {
		//alert('mbuh');
		var mapel = $('#mapel').val();
		var	mytext = $("#kelas").val();
		var pelajaran=$('#matpel').val();
		var jentag = $('#jentag').val();
		var aspek = $('#aspek').val();
		var kkm=$('#skbm').val();
		var nis=nisnya;
		var nilai=nilainya;
		var nilaike=$('#nilaike').val();
		alert("aaaaaaaa");
	};
</script>
<table id="tabelnya" class="show">
<tr class="head">
<td>No</td>
<td>NIS</td>
<td>Nama</td>
<td>Nilai</td>
<td>Keterangan</td>
</tr>
<?php
$i=1;
 echo form_open("aaa");
foreach($nama as $siswa) {
	echo '<tr class="zebra">';
	echo '<td>'.$i.'</td>';
	echo '<td id="nis'.$i.'">'.$siswa->nis.'</td>';
	echo '<td width="600">'.$siswa->nama.'</td>';
	echo '<td><input type="text" id="nilai'.$i.'" class="txt_nilai" /></td>';
	echo '<td id="ket'.$i.'" width="400"></td>';
	echo '</tr>';
$i++;
}
$i=$i-1;
echo  'Jumlah Siswa : '.$i;
?>
<div id="tbl_sis" style="display:none"><?php echo $i; ?></div>
</table>
<input  type="button" value="simpan">
<?php echo form_close(); ?>




