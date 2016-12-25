<div class="row-fluid">

<div class="page-header users-header">
	<h2>
	  Thông Tin Tài Khoản
	  <a  href="<?php echo site_url("member"); ?>" class="btn btn-success">Tài Khoản</a>
	</h2>
</div>
<?php
  //form validation
  echo validation_errors();
?>  	
<div class="container login">
	Thái lọ sửa cái này đi, phải bắt nhập mật khẩu cũ chứ, vl :)) Với cả phải có validate js, sửa xong xóa text này đi nhé :))
  <?php
	  $attributes = array('class' => 'form-signin');   
	  echo form_open('member/infos/changepass', $attributes);
	  echo '<h2 class="form-signin-heading">Đổi mật khẩu</h2>';
	  
	  echo form_password('password', '', 'placeholder="Mật khẩu"');
	  echo form_password('password2', '', 'placeholder="Xác nhận mật khẩu"');
	  echo '<br/>';
	  echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
	  echo form_close();
  ?>
</div>