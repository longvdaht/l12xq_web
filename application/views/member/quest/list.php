    <div class="row-fluid">

      <div class="page-header users-header">
		<h2>
		  Nhiệm vụ đổi đồ
		</h2>
	</div>
	<ul class="nav">
		<?php foreach($quests_lists as $row){?>
			<li><a href="<?php echo site_url("member").'/quest/view/'.$row['id']?>"><?php echo $row['name']?></a></li>
		<?php }?>		
	</ul>
	<?php if(count($quests_lists)==0){?>
		<p>Hiện tại chưa có nhiệm vụ nào, vui lòng quay lại sau!</p>
	<?php }?>