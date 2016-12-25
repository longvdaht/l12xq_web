<div class="row-fluid">
	<div class="page-header users-header">
		<h2>
		  Thông Tin Tài Khoản
		  <a  href="<?php echo site_url("member"); ?>/infos/changepass" class="btn btn-success">Đổi mật khẩu</a>
		</h2>
	</div>
	<div class="well">
		<address>
			<strong>Tên Đăng Nhập: </strong> <span><?php echo $member[0]['LoginName']?></span>
		</address>	
		<address>
			<strong>Thành Chủ: </strong> <span><?php echo $city[0]['ShowName']?></span>
		</address>
		<address>	
			<strong>Xu: </strong> <span><?php echo $member[0]['Money']?></span>
		</address>	
		<address>	
			<strong>Thẻ Quà: </strong> <span><?php echo $member[0]['GiftCertificate']?></span>
		</address>	
	</div>