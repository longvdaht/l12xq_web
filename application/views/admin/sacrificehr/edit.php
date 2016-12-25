    <div class="row-fluid">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> sacrificehr updated with success.';
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
      $attributes = array('class' => 'form-horizontal', 'id' => '');
     

      //form validation
      echo validation_errors();

      echo form_open('admin/sacrificehr/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        
	<fieldset>
		<div class="control-group">
			<label for="inputError" class="control-label">Name</label>
			<div class="controls">
				<input type="text" id="" name="name" value="<?php echo $sacrificehr[0]['name']; ?>" >
				
			</div>
		</div>
		<div class="control-group">
			<label for="inputError" class="control-label">Status</label>
			<div class="controls">
				<select name="status">
					<option value="1" <?php if($sacrificehr[0]['status'] == 1){echo 'selected';}?>>Publish</option>
					<option value="0" <?php if($sacrificehr[0]['status'] == 0){echo 'selected';}?>>Draft</option>
				</select>
				
			</div>
		</div>   
		<div class="control-group">
			<label for="inputError" class="control-label">General List</label>
			<div class="controls">
				<input type="text" name="generallist" value="<?php echo $sacrificehr[0]['generallist']; ?>">
				
			</div>
		</div>
		<div class="control-group">
			<label for="inputError" class="control-label">Reward</label>
			<div class="controls">
				<input type="text" name="reward" value="<?php echo $sacrificehr[0]['reward']; ?>">
				
			</div>
		</div>
		<div class="control-group">
			<label for="inputError" class="control-label">Desctiption</label>
			<div class="controls">
				
				<?php echo $this->ckeditor->editor("desctiption",$sacrificehr[0]['desctiption']); ?>
			</div>
		</div>
		<div class="control-group">
			<label for="inputError" class="control-label">Time Start</label>
			<div class="controls">
				<input class="form_datetime" type="text" name="timestart" value="<?php echo $sacrificehr[0]['timestart']; ?>">
				
			</div>
		</div>
		<div class="control-group">
			<label for="inputError" class="control-label">Time End</label>
			<div class="controls">
				<input class="form_datetime" type="text" name="timeend" value="<?php echo $sacrificehr[0]['timeend']; ?>">
				
			</div>
		</div>
		
		<div class="form-actions">
			<button class="btn btn-primary" type="submit">Save changes</button>
			<button class="btn" type="reset">Cancel</button>
		</div>
	</fieldset>

      <?php echo form_close(); ?>

    </div>
     