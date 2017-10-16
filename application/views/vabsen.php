<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="shortcut icon" href="<?php echo base_url('asset/images/favicon.png');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/reset.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/calendar.css');?>" />
    <script type="text/javascript" src="<?php echo base_url('asset/js/calendar.js'); ?>"></script>

    <title>cek absensi</title>
</head>

<body id="<?php echo isset($modul) ? $modul : ''; ?>">

    <div id="masthead">
        <?php $this->load->view('masthead'); ?>
    </div>


 <div id="main">
 <h2>ABSENSI</H2>
 <table>
 <?php
 foreach($nama as $biodata) {
	echo '<tr><td>Nama</td><td>: '.$biodata->nama.'</td>';
	echo '<tr><td>NIS</td><td>: '.$biodata->nis.'</td></tr></table>';
	}
	?>
<table border='1'>
<tr><td>No</td><td>Tanggal</td><td>Keterangan</td></tr>';
<?php
$i=1;
foreach($siswa as $siswa) {
	echo '<tr>';
	echo '<td>'.$i.'</td>';
	echo '<td>'.$siswa->tanggal.'</td>';
	if ($siswa->absen=='A'){
	echo '<td>Alpha</td>';
	} else if($siswa->absen=='I'){
	echo '<td>Ijin</td>';
	} else if($siswa->absen=='S'){
	echo '<td>Sakit</td>';
	}else if($siswa->absen=='T'){
	echo '<td>Terlambat</td>';
	} else {
	echo '<td>Null</td>';
	}
	echo '</tr>';
$i++;
}
?>
</table>
<a href="utama"><button type="button">Keluar</button></a>
</div>

    <div id="footer">
        <?php $this->load->view('footer'); ?>
    </div>

</body>
</html>