<div class="row-fluid">
	<div class="page-header users-header">
		<h2>
		  Quản lý nhiệm vụ chuyển cộng
		  <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Tạo mới</a>
		</h2>
	</div>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th class="header">Id</th>
				<th class="yellow header headerSortDown">Cấp chuyển</th>
				<th class="green header">Yêu cầu đồ kèm theo</th>
				<th class="red header">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($transferlvs as $row)
			{

				echo '<tr>';
				echo '<td>'.$row['id'].'</td>';
				echo '<td>'.$row['forgelevel'].'</td>';
				echo '<td>List item cần để đổi đồ</td>';
				echo '<td class="crud-actions">
				<a href="'.site_url("admin").'/transferlv/update/'.$row['id'].'" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>  
				<a href="'.site_url("admin").'/transferlv/delete/'.$row['id'].'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
				</td>';
				echo '</tr>';
			}
			?>      
		</tbody>
	</table>
	<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>