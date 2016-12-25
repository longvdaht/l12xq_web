<div class="row-fluid">     
	<div class="page-header">
		<h2>
		  Chuyển cộng: <?php echo $quest[0]['forgelevel']; ?>
		</h2>
	</div>
      
	<?php
	
date_default_timezone_set('Asia/Ho_Chi_Minh');

	//form data
	$attributes = array('id' => '');
	//form validation
	echo validation_errors();

	echo form_open('member/transferlv/view/'.$this->uri->segment(4).'', $attributes);
	?>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="bs-example">
					<h3>Chuyển cộng: <?php echo $quest[0]['forgelevel']; ?></h3>
					
					<div class="quest-desc">
						<?php echo $quest[0]['desctiption']; ?>
					</div>
					<h3>Trong hòm đồ của bạn đang có:</h3>
					 <h3>You have item need:</h3>
				  <ul>
						<?php
						foreach($items_need as $key=>$value){
							echo '<li>';
							echo $value['GoodsName'].': '.$value['Num'];
							echo '</li>';
						}
						?>
				  </ul>
				  
				  
					<ul class="nav">
						Thái thêm cái này là list item trong hòm đồ của user này nhé
					</ul>
					<div class="form-actions">
						<input type="hidden" name="hide_userid" value="<?php echo $user_id?>"></input>
						<button class="btn btn-primary" type="submit">Đổi</button>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
					<h2>Thông Số Của Quest:</h2>
					<h3>Item Yêu cầu:</h3>
					<ul class="nav">
						Thái sửa cái này thành list item ul li nhé :)
					</ul>
					<h3>Phần Thưởng:</h3>
				    <ul class="nav">
						Thái sửa cái này thành list item ul li nhé :)
					</ul>
				</div>
			</div>
		</div>
      <?php echo form_close(); ?>

    </div>
     