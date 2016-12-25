    <div class="row-fluid">

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Tạo Mới</a>
        </h2>
      </div>
      
      <div class="content">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">Id</th>
                <th class="yellow header headerSortDown">Tên Quest</th>
                <th class="green header">Kiểu Quest</th>
                <th class="green header">Trạng Thái</th>
                <th class="red header">Đồ Nhiệm Vụ</th>
                <th class="red header">Phần Thưởng</th>
                <!--<th class="red header">Bắt đầu</th>
                <th class="red header">Kết thúc</th> -->
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($quests as $row)
              {
					$data_item_need = '<ul>';
					foreach($row['items_need'] as $value){
						$data_item_need_name = $value['GoodsName'];
						$data_item_need_qty = $row['data_item_need'][$value['GoodsID']];
						$data_item_need .= '<li>'.$data_item_need_name.': '.$data_item_need_qty.'</li>';
					}
					$data_item_need .= '</ul>';
					
					$data_item_rew = '<ul>';
					foreach($row['items_reward'] as $value){
						$data_item_rew_name = $value['GoodsName'];
						$data_item_rew_qty = $row['data_item_reward'][$value['GoodsID']];
						$data_item_rew .= '<li>'.$data_item_rew_name.': '.$data_item_rew_qty.'</li>';
					}
					$data_item_rew .= '</ul>';
					if($row['status'] == 1){
						$status = 'Enable'	;
					}else{
						$status = 'Disable';	
					}
					if($row['typegoods'] == 1){
						$type = 'Đạo cụ'	;
					}else{
						$type = 'Đồ đạc, pháp bảo, thú cưỡi';	
					}
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$type.'</td>';
                echo '<td>'.$status.'</td>';
                echo '<td>'.$data_item_need.'</td>';
                echo '<td>'.$data_item_rew.'</td>';
                // echo '<td>'.$row['timestart'].'</td>';
                // echo '<td>'.$row['timeend'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/quest/update/'.$row['id'].'" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>  
                  <a href="'.site_url("admin").'/quest/delete/'.$row['id'].'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
    </div>