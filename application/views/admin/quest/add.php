
    <div class="row-fluid">
		<div class="page-header">
			<h2>
				Tạo <?php echo ucfirst($this->uri->segment(2));?> Mới
			</h2>
		</div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new quest created with success.';
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
      $attributes = array( 'id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/quest/add', $attributes);
      ?>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="bs-example">
					<div class="form-group">
						<label for="inputError" class="control-label">Tên Quest</label>
						<div class="controls">
							<input type="text" class="form-control" id="" name="name" value="<?php echo set_value('name'); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Trạng Thái</label>
						<div class="controls">
							<select name="status" class="form-control">
								<option value="1" <?php if(set_value('status') == 1){echo 'selected';}?>>Enable</option>
								<option value="0" <?php if(set_value('status') == 0){echo 'selected';}?>>Disable</option>
							</select>
						</div>
					</div>          
					<div class="form-group">
						<label for="inputError" class="control-label">Kiểu Quest</label>
						<div class="controls">
							<select name="typegoods" class="form-control">
								<option value="1" <?php if(set_value('typegoods') == 1){echo 'selected';}?>>Đạo cụ</option>
								<option value="0" <?php if(set_value('typegoods') == 0){echo 'selected';}?>>Đồ đạc, pháp bảo, thú cưỡi</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Item Yêu cầu</label>
						<div class="controls">
							<input type="text" class="form-control" name="goodsitemrequiment" value="<?php echo set_value('goodsitemrequiment'); ?>">
						</div>
						<p class="help-block">Để Item dạng id=qty, cách nhau bằng dấu ";" Ví dụ: 4000=1;4001=2;</p>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Phần Thưởng</label>
						<div class="controls">
							<input type="text" class="form-control" name="reward" value="<?php echo set_value('reward'); ?>">
						</div>
						<p class="help-block">Để Item dạng id=qty, cách nhau bằng dấu ";" Ví dụ: 4000=1;4001=2;</p>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Mô Tả</label>
						<div class="controls">
							<?php echo $this->ckeditor->editor("desctiption",set_value('desctiption')); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Bắt Đầu</label>
						<div class="controls">
							<input class="form_datetime form-control" type="text" name="timestart" value="<?php echo set_value('timestart'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputError" class="control-label">Kết Thúc</label>
						<div class="controls">
							<input class="form_datetime form-control" type="text" name="timeend" value="<?php echo set_value('timeend'); ?>">
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn btn-primary" type="submit">Lưu</button>
						<button class="btn" type="reset">Hủy</button>
					</div>
				</div>
			</div>
		</div>
      <?php echo form_close(); ?>

    </div>
     