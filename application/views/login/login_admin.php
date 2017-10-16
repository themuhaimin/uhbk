<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="<?php echo base_url('asset/images/favicon.png');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/reset.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/login-admin.css');?>" />
        <title>Aplikasi UHBK</title>
    </head>

<body>
<div id="error">
    <!-- pesan start -->
    <?php if (! empty($pesan)) : ?>
        <p id="message">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>
    <!-- pesan end -->
	<?php echo form_error('username', '<p class="field_error">', '</p>');?>
	<?php echo form_error('password', '<p class="field_error">', '</p>');?>
</div>
<div id="login_box">
	
	<h1>Selamat Datang Bapak/Ibu Guru, Silakan masuk untuk mulai</h1>
	<div id="logo">
	</div>
	<?php
		$attributes = array('name' => 'login_form', 'id' => 'login_form');
		echo form_open('admin_login', $attributes);
	?>
	
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" size="20" class="form_field text" value="<?php echo set_value('username');?>">
		</p>
		
		<p>
			<label for="password">Password:</label>
			<input type="password" name="password" size="20" class="form_field text" value="<?php echo set_value('password');?>">
		</p>
		
	<div id="tombol">
		<div id="login">
		<input type="submit" class="btn btn-success" name="submit" id="submit" value="Login"/>
		</div>
	</div>
	</form>
</div>
</body>
</html>