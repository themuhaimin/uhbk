
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UHBK 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/soal.css');?>" />
  <script type="text/javascript" src="<?php echo base_url('asset/js/jquery-2.1.3.min.js'); ?>"></script>
</head>
<body onload="test()">

<nav class="navbar navbar-custom">
	 <?php
//timer
	$init=$sisa_waktu;
	$jam=floor(($init/60/60)%60);
	$minute=floor(($init/60)%60);
	$sec=$init%60;
?>
 <div id="top"><img src="<?php echo base_url('asset/img/tutwuri.png'); ?>"/>
	<div id="title">ULANGAN HARIAN BERBASIS KOMPUTER</div>
	
	<div class="clock">
				<!--<span class="countdown">0</span>minutes-->
    			<span align="center"><span class="jam"><?php echo $jam; ?></span><span > : </span> <span class="min"><?php echo $minute; ?></span><span> <span> : </span></span><span class="sec"><?php echo $sec; ?></span></span>              	        
	</div>
</div>

</nav>
<div id="wrapper">
	<div id="main">
	<div id="no" class="nav_soal">SOAL NO </div> <div class="nav_soal" id="soal_no"></div>
		<div id="soal">
		<?php $this->load->view($main_view); ?>
		</div>
	</div>
	<div id="sidebar">
	</div>
</div>
<!-- jQuery 2.2.0 -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
</body>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Untuk Demo Program Tugas Akhir <strong>Universitas Semarang </strong> 
    </div>
    <strong>Muhaimin G.231.11.0202</strong> 
  </footer>
</html>
