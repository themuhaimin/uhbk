<table border="0">
	<thead>
	<tr><th colspan="2" >ANDA SUDAH MENYELESAIKAN UJIAN DENGAN HASIL SEBAGAI BERIKUT</th></tr>
	</thead>
	<tr>
		<td width="200">Nama Siswa</td><td><?php echo $nama; ?></td>
	</tr>
	<tr>
		<td width="200">Mata Pelajaran</td><td><?php echo $mapel; ?></td>
	</tr>
	<tr class="zebra">
		<td>Perolehan Nilai </td><td><?php echo $nilai; ?></td>
	</tr>
	<tr>
	</tr>
	<tr>
	<td></br><?php echo anchor('logout','Keluar',array('class'=> 'btn btn-danger','onclick'=>"return confirm('Anda yakin akan keluar sistem?')")) ?></td>
	</tr>
</table>
</table>