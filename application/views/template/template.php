<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UHBK 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/font-awesome-4.5.0/css/font-awesome.css');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/AdminLTE.min.css');?>" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/skins/_all-skins.min.css');?>" />
  
<!-- jQuery 2.2.0 -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b>HBK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ADMIN</b> UHBK</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- aplicatio tittle -->
	<div id="title">APLIKASI ULANGAN HARIAN BERBASIS KOMPUTER SMP N 1 KALIWUNGU</div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>asset/dist/img/logo-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
			<p>
				<?php  echo $this->session->userdata('nama_admin') ?>
			</p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php $jabatan=$this->session->userdata('jabatan');
																      if($jabatan=='1'){
																		  echo "Administrator";
																	  } else {
																		   echo "Guru";
																	  }    ?>
																	  </a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url(); ?>ujian/beranda">
            <i class="fa fa-dashboard"></i> <span>Beranda</span> 
          </a>
        </li>
		<?php if($this->session->userdata('jabatan')=='1') { ?>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>tahun_ajar">
            <i class="fa fa-laptop"></i>
            <span>Kelola Tahun Ajaran</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>siswa">
            <i class="fa fa-graduation-cap"></i> <span>Kelola Siswa</span>   
          </a>
        </li>
		<li>
          <a href="<?php echo base_url(); ?>kelas">
            <i class="fa fa-graduation-cap"></i> <span>Kelola Kelas</span>   
          </a>
        </li>
		<li>
          <a href="<?php echo base_url(); ?>guru">
            <i class="fa fa-users"></i> <span>Kelola Guru</span>   
          </a>
        </li>
		<?php } 
			if($this->session->userdata('jabatan')=='2') { ?>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>ujian">
            <i class="fa fa-files-o"></i>
            <span>Kelola Ujian</span>
          </a>
        </li>
			<?php  } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Laporan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>laporan"><i class="fa fa-circle-o"></i> Nilai</a></li>
            <li><a href="<?php echo base_url(); ?>laporan/analisis"><i class="fa fa-circle-o"></i> Analisis Butir Soal</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="<?php echo base_url(); ?>admin/logout">
            <i class="fa fa-sign-out logout"></i>
            <span class="logout">Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
		 <h1>
        <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('ujian/beranda'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active"><?php echo isset($breadcrumb) ? $breadcrumb : ''; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
	 <?php $this->load->view($main_view); ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Untuk Demo Program Tugas Akhir <strong>Universitas Semarang </strong> 
    </div>
    <strong>Muhaimin G.231.11.0202</strong> 
  </footer>

 

</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.5 -->
<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- FastClick -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="<?php echo base_url('asset/dist/js/app.min.js'); ?>"></script>
<!-- Sparkline -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- SlimScroll 1.3.0 -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- ChartJS 1.0.1 -->
<script type="text/javascript" src="<?php echo base_url('asset/plugins/chartjs/Chart.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="<?php echo base_url('asset/dist/js/pages/dashboard2.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="<?php echo base_url('asset/dist/js/demo.js'); ?>"></script>
</body>
</html>
