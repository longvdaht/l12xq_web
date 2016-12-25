<!DOCTYPE html> 
<html lang="en-US">
<head>
	<title>Đắc kỷ online Loạn 12 sứ quân 2016</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="INDEX,FOLLOW" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="icon" href="<?php echo base_url() ?>images/logo.png" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo base_url() ?>images/logo.png" type="image/x-icon" />
	<meta charset="utf-8">
	<link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<div class="logo">
	<a href="javascript:void(0)"><img src="<?php echo base_url() ?>images/logo.png"></a>
</div>
<?php
$attributes = array('class' => 'form-signin');   
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Tạo tài khoản</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="Họ"');
echo form_input('last_name', set_value('last_name'), 'placeholder="Tên"');
echo form_input('email_address', set_value('email_address'), 'placeholder="Địa Chỉ E-mail"');

echo form_input('username', set_value('username'), 'placeholder="Tên đăng nhập"');
echo form_password('password', '', 'placeholder="Mật khẩu"');
echo form_password('password2', '', 'placeholder="Nhập lại mật khẩu"');

echo form_submit('submit', 'Save', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    