    <div class="content">    
      <div class="page-header">
        <h2>
          Edit <?php echo ucfirst($this->uri->segment(2)).' '.$quest[0]['name'];?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> quest updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('id' => '');
     

      //form validation
      echo validation_errors();

      echo form_open('admin/quest/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="bs-example">
					<div class="form-group">
						<label for="inputError" class="control-label">Tên Quest</label>
						<div class="controls">
							<input type="text" class="form-control" id="" name="name" value="<?php echo $quest[0]['name']; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Trạng Thái</label>
						<div class="controls">
							<select name="status" class="form-control">
								<option value="1" <?php if($quest[0]['status'] == 1){echo 'selected';}?>>Enable</option>
								<option value="0" <?php if($quest[0]['status'] == 0){echo 'selected';}?>>Disable</option>
							</select>
						</div>
					</div>          
					<div class="form-group">
						<label for="inputError" class="control-label">Kiểu Quest</label>
						<div class="controls">
							<select name="typegoods" class="form-control">
								<option value="1" <?php if($quest[0]['typegoods'] == 1){echo 'selected';}?>>Đạo cụ</option>
								<option value="0" <?php if($quest[0]['typegoods'] == 0){echo 'selected';}?>>Đồ đạc, pháp bảo, thú cưỡi</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Item Yêu cầu</label>
						<div class="controls">
							<input type="text" class="form-control" name="goodsitemrequiment" value="<?php echo $quest[0]['goodsitemrequiment']; ?>">
						</div>
						<p class="help-block">Để Item dạng id=qty, cách nhau bằng dấu ";" Ví dụ: 4000=1;4001=2;</p>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Phần Thưởng</label>
						<div class="controls">
							<input type="text" class="form-control" name="reward" value="<?php echo $quest[0]['reward']; ?>">
						</div>
						<p class="help-block">Để Item dạng id=qty, cách nhau bằng dấu ";" Ví dụ: 4000=1;4001=2;</p>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Mô Tả</label>
						<div class="controls">
							<?php echo $this->ckeditor->editor("desctiption",$quest[0]['desctiption']); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Bắt Đầu</label>
						<div class="controls">
							<input class="form_datetime form-control" type="text" name="timestart" value="<?php echo $quest[0]['timestart']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Kết Thúc</label>
						<div class="controls">
							<input class="form_datetime form-control" type="text" name="timeend" value="<?php echo $quest[0]['timeend']; ?>">
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" type="submit">Lưu</button>
						<button class="btn" type="reset">Hủy</button>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
					<h2>Thông Số Của Quest:</h2>
					<h3>Item Yêu cầu:</h3>
					<table class="table">
						<tbody>
							<?php
							foreach($items_need as $key=>$value){
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
							foreach($items_reward as $key=>$value){
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
				</div>
			</div>
		</div>

      <?php echo form_close(); ?>

    </div>
     