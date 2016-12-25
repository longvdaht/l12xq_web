    <div class="row-fluid">

      <div class="page-header users-header">
		<h2>
		  Nhiệm vụ đổi đồ
		</h2>
	</div>
	<ul class="nav">
		<?php foreach($transferlvs as $row){?>
			<li><a href="<?php echo site_url("member").'/transferlv/view/'.$row['id']?>">Chuyển cộng <?php echo $row['forgelevel']?>: <?php echo $row['desctiption']?></a></li>	
		<?php }?>		
	</ul>
	<?php if(count($transferlvs)==0){?>
		<p>Hiện tại chưa có nhiệm vụ nào, vui lòng quay lại sau!</p>
	<?php }?>