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
	<link href="<?php echo base_url(); ?>assets/css/admin/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/assets/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/assets/ckfinder/ckfinder.js"></script>
</head>
<body>	
	<div class="web-container">
		<div class="container-fluid main-c">
		  <div class="row row-c">
			  <div class="col-xs-12 col-sm-12 col-md-2 menu-col-left">
					<div class="logo">
						<a href="javascript:void(0)"><img src="<?php echo base_url() ?>images/logo.png"></a>
					</div>
					<div class="info-mem">
						<center>Xin Chào <?php echo $this->session->userdata('user_name');?>, <a href="<?php echo base_url(); ?>admin/logout">Đăng xuất</a></center>
					</div>
					<ul class="nav">
					<?php if($this->session->userdata('user_info') == '2212'){ ?>
						<li <?php if($this->uri->segment(2) == 'quest' && $this->uri->segment(1) == 'admin'){echo 'class="active"';}?>>
							<a href="<?php echo base_url(); ?>admin/quest">Quản lý nhiệm vụ đổi đồ</a>
						</li>
						<li <?php if($this->uri->segment(2) == 'transferlv' && $this->uri->segment(1) == 'admin'){echo 'class="active"';}?>>
							<a href="<?php echo base_url(); ?>admin/transferlv">Quản lý chuyển cộng</a>
						</li>
					<?php  
					}?>
					
					<li <?php if($this->uri->segment(1) == 'member'){echo 'class="active"';}?>>
						<a href="<?php echo base_url(); ?>member">Thông tin tài khoản</a>
					</li>
					<li <?php if($this->uri->segment(1) == 'member' && $this->uri->segment(2) == 'quest'){echo 'class="active"';}?>>
						<a href="<?php echo base_url(); ?>member/quest/list">Nhiệm vụ đổi đồ</a>
						<?php if(isset($quests_lists)){?>
						<ul>
							<?php foreach($quests_lists as $row){?>
								<li><a href="<?php echo site_url("member").'/quest/view/'.$row['id']?>"><?php echo $row['name']?></a></li>
							<?php }?>		
						</ul>
						<?php }?>
					</li>
					
					<li>
						<a href="<?php echo base_url(); ?>member/quest/list">Chuyển cộng</a>
						  
					</li>
				  </ul>
			  </div>
			  <footer>
					<center>Đắc kỷ online Loạn 12 sứ quân © 2016.</center>
				</footer>
			  <div class="col-xs-12 col-sm-12 col-md-10 col-contain">
