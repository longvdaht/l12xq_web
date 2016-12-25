    <div class="row-fluid">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            
            //save the columns names in a array that we will use as filter         
            $options_sacrificehrs = array();    
            foreach ($sacrificehrs as $array) {
              foreach ($array as $key => $value) {
                $options_sacrificehrs[$key] = $key;
              }
              break;
            }

            echo form_open('admin/sacrificehr', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

             
              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_sacrificehrs, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="green header">Status</th>
                <th class="red header">General list</th>
                <th class="red header">Reward</th>
                <th class="red header">Time Start</th>
                <th class="red header">Time End</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($sacrificehrs as $row)
              {
					if($row['status'] == 1){
						$status = 'Publish'	;
					}else{
						$status = 'Draft';	
					}
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$status.'</td>';
                echo '<td>'.$row['generallist'].'</td>';
                echo '<td>'.$row['reward'].'</td>';
                echo '<td>'.$row['timestart'].'</td>';
                echo '<td>'.$row['timeend'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/sacrificehr/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/sacrificehr/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>