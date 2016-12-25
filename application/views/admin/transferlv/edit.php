<div class="row-fluid">      
<div class="page-header">
	<h2>
		Sửa
	</h2>
</div>  
<?php
//form data
$attributes = array('id' => '');
//form validation
echo validation_errors();
echo form_open('admin/transferlv/update/'.$this->uri->segment(4).'', $attributes);
?>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6">
		<div class="bs-example">
			<div class="form-group">
				<label class="control-label">Cấp cộng của đồ</label>
				<div class="controls">
					<select name="forgelevel" class="form-control">
						<option value="1" <?php if($transferlv[0]['forgelevel'] == 1){echo 'selected';}?>>1</option>
						<option value="2" <?php if($transferlv[0]['forgelevel'] == 2){echo 'selected';}?>>2</option>
						<option value="3" <?php if($transferlv[0]['forgelevel'] == 3){echo 'selected';}?>>3</option>
						<option value="4" <?php if($transferlv[0]['forgelevel'] == 4){echo 'selected';}?>>4</option>
						<option value="5" <?php if($transferlv[0]['forgelevel'] == 5){echo 'selected';}?>>5</option>
						<option value="6" <?php if($transferlv[0]['forgelevel'] == 6){echo 'selected';}?>>6</option>
						<option value="7" <?php if($transferlv[0]['forgelevel'] == 7){echo 'selected';}?>>7</option>
						<option value="8" <?php if($transferlv[0]['forgelevel'] == 8){echo 'selected';}?>>8</option>
						<option value="9" <?php if($transferlv[0]['forgelevel'] == 9){echo 'selected';}?>>9</option>
						<option value="10" <?php if($transferlv[0]['forgelevel'] == 10){echo 'selected';}?>>10</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">Item cần để chuyển cộng</label>
				<div class="controls">
					<input type="text" name="goodsitemrequiment" class="form-control" value="<?php echo $transferlv[0]['goodsitemrequiment']; ?>">
				</div>
				<p class="help-block">Để Item dạng id=qty, cách nhau bằng dấu ";" Ví dụ: 4000=1;4001=2;</p>
			</div>
			<div class="form-group">
				<label class="control-label">Mô tả</label>
				<div class="controls">
					<?php echo $this->ckeditor->editor("desctiption",$transferlv[0]['desctiption']); ?>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit">Lưu</button>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<h2>Thông Số Của Quest:</h2>
		<h3>Item Yêu cầu:</h3>
		<ul>
			List item cần để đổi đồ
		</ul>
	</div>
</div>       
<?php echo form_close(); ?>
</div>
     