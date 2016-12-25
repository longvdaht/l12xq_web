<div class="row-fluid">     
	<div class="page-header">
		<h2>
		  <?php echo $quest[0]['name']; ?>
		</h2>
	</div>
    <?php
		//flash messages
		if($this->session->flashdata('submit_quest_message')){
			if($this->session->flashdata('submit_quest_message') == 'updated')
			{
				echo '<div class="alert alert-success">';
				echo 'Thành công, bạn hãy vào game và kiểm tra hòm đồ.';
				echo '</div>';       
			}elseif($this->session->flashdata('submit_quest_message') == 'not_logout')
			{
				echo '<div class="alert alert-warning">';
				echo 'Thoát game trước khi thực hiện';
				echo '</div>'; 
			}else
			{
				echo '<div class="alert alert-danger">';
				echo 'Trong hòm đồ của bạn không tồn tại đủ vật phẩm yêu cầu';
				echo '</div>';          
			}
		}
      ?>  
	<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	//form data
	$attributes = array('id' => '');
	//form validation
	echo validation_errors();

	echo form_open('member/quest/view/'.$this->uri->segment(4).'', $attributes);
	?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="bs-example">
					<p>Thời gian diễn ra sự kiện:  <?php echo date('d/m/Y',strtotime($quest[0]['timestart'])) ; ?> - <?php echo date('d/m/Y',strtotime($quest[0]['timeend'])); ?></p>
					<div class="quest-desc">
						<?php echo $quest[0]['desctiption']; ?>
					</div>
					<h3 class="text-danger">Lưu Ý: Thoát game trước khi thực hiện nhiệm vụ!</h3>
					<h2>Thông Số Của Quest:</h2>
					<h3>Item Yêu cầu:</h3>
					<table class="table">
						<tbody>
							<?php
							foreach($inquest_items_need as $key=>$value){
								if (file_exists(getcwd().'/images/item/n_item_'.$value['GoodsID'].'.jpg')) {
									$img = base_url().'images/item/n_item_'.$value['GoodsID'].'.jpg';
								}
								else{
									$img = base_url().'images/item/no-image.png';
								}	
								echo '<tr>';
								echo '<td><img src="'.$img.'" alt="" /></td>';
								echo '<td>'.$value['GoodsName'].'</td>';
								echo '<td>'.$qty_data_item_need[$value['GoodsID']].'</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
					<h3>Phần Thưởng:</h3>
					<table class="table">
						<tbody>
							<?php
							foreach($inquest_items_reward as $key=>$value){
								if (file_exists(getcwd().'/images/item/n_item_'.$value['GoodsID'].'.jpg')) {
									$img = base_url().'images/item/n_item_'.$value['GoodsID'].'.jpg';
								}
								else{
									$img = base_url().'images/item/no-image.png';
								}	
								echo '<tr>';
								echo '<td><img src="'.$img.'" alt="" /></td>';
								echo '<td>'.$value['GoodsName'].'</td>';
								echo '<td>'.$qty_data_item_reward[$value['GoodsID']].'</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
					<!--<h3>Trong hòm đồ của bạn đang có:</h3>
					<pre><?php //var_dump($items_need);?></pre>-->
					<!--<table class="table">
						<tbody>
							<?php
							/* foreach($items_need as $key=>$value){
								if (file_exists(getcwd().'/images/item/n_item_'.$value['GoodsID'].'.jpg')) {
									$img = base_url().'images/item/n_item_'.$value['GoodsID'].'.jpg';
								}
								else{
									$img = base_url().'images/item/no-image.png';
								}	
								echo '<tr>';
								//echo $value['GoodsID'];
								echo '<td><img src="'.$img.'" alt="" /></td>';
								echo '<td>'.$value['GoodsName'].'</td>';
								echo '<td>'.$value['Num'].'</td>';
								echo '</tr>'; 
							}*/
							?>
						</tbody>
					</table>-->
					<?php 
					$check_online_game = $this->session->userdata('check_online_game');
					
					?>
					<div class="form-actions">
						<?php if($check_online_game == 1){ 
							echo '<p class="text-danger">Bạn chưa thoát khỏi game, vui lòng thoát game và tải lại trang</p>';
						}else{ ?>
						<input type="hidden" name="hide_userinfo" value="<?php echo md5($user_id);?>"></input>
						<button class="btn btn-primary" type="submit">Đổi</button>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
      <?php echo form_close(); ?>

    </div>
     