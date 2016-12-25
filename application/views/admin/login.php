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
    <div class="container login">
      <div class="logo">
		<a href="javascript:void(0)"><img src="<?php echo base_url() ?>images/logo.png"></a>
	  </div>
	  <?php 
      $attributes = array('class' => 'form-signin');
      echo form_open('admin/login/validate_credentials', $attributes);
      echo '<h2 class="form-signin-heading">Đăng Nhập</h2>';
      echo form_input('user_name', '', 'placeholder="Tài Khoản"');
      echo form_password('password', '', 'placeholder="Mật Khẩu"');
      if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
          echo '</div>';             
      }
      echo "<br />";
      //echo anchor('admin/signup', 'Đăng Ký');
      echo "<br />";
      echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
      echo form_close();
      ?>      
    </div><!--container-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    