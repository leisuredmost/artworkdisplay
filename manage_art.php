<?php include('admin/db_connect.php');?>

<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.vacancy-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.carousel,.carousel-inner,.carousel-item{
    max-height: 30vh !important
}
header.masthead {
        min-height: 20vh !important;
        height: 20vh !important
    }
.row-items{
    position: relative;
}
.card-left{
    left:0;
}
.card-right{
    right:0;
}
.rtl{
    direction: rtl ;
}

</style>
        <header class="masthead">
        </header>
<div class="container-fluid mt-3 pt-2">
                <h4 class="text-center">User Portfolio</h4>
				<hr class="divider">
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Arts</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=add_remove_art" id="new_art">
					<i class="fa fa-plus"></i> Add Art
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<colgroup>
								<col width="5%">
								<col width="15%">
								<col width="40%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Art Title</th>
									<th class="">Description</th>
									<th class="">Artist</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_SESSION['login2_id'])){
									$login2_id = $_SESSION['login2_id'];
								} 
								$i = 1;
								$arts = $conn->query("SELECT a.*,u.name as aname FROM arts a inner join users u on u.id = a.artist_id where u.id = $login2_id");
								while($row=$arts->fetch_assoc()):
									$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
									unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
									$desc = strtr(html_entity_decode($row['art_description']),$trans);
									$desc=str_replace(array("<li>","</li>"), array("",","), $desc);
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p> <b><?php echo ucwords($row['art_title']) ?></b></p>
									</td>
									<td class="">
										 <p class="truncate"><?php echo strip_tags($desc) ?></p>
									</td>
									<td>
										 <p> <b><?php echo ucwords($row['aname']) ?></b></p>
									</td>
									<td class="text-center">
										 <?php if($row['status'] == 1): ?>
										 	<span class="badge badge-primary">Published</span>
										 <?php else: ?>
										 	<span class="badge badge-secondary">Unpublished</span>
										 <?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_art" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_art" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_art" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Arts for Sale</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_art_fs">
					<i class="fa fa-plus"></i> Add Item</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="7%">
								<col width="10%">
								<col width="10%">
								<col width="23%">
								<col width="15%">
								<col width="15%">
								<col width="15%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Date</th>
									<th class="">Image</th>
									<th class="">Canvas Information</th>
									<th class="">Price</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_SESSION['login2_id']))
								$_SESSION['login2_id'] = $login2_id;
								$i = 1;
								$fs = $conn->query("SELECT fs.*,a.art_title,a.art_description,u.name as aname,u.id as artist_id from arts_fs fs inner join arts a on a.id = fs.art_id inner join users u on u.id = a.artist_id WHERE u.id = $login2_id order by unix_timestamp(fs.date_created) desc");
								while($row=$fs->fetch_assoc()):
									$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
									unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
									$desc = strtr(html_entity_decode($row['art_description']),$trans);
									$desc=str_replace(array("<li>","</li>"), array("",","), $desc);
									$img = '';
									$imgs = scandir('admin/assets/uploads/artist_'.$row['art_id']);
									foreach($imgs as $k=>$v){
										if(!in_array($v,array('.','..')) && empty($img)){
											$img = $v;
										}
									}
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo date("M d,Y h:i A",strtotime($row['date_created'])) ?></b></p>
									</td>
									<td class="">
										 <div class="imgs"><img src="<?php echo 'admin/assets/uploads/artist_'.$row['art_id'].'/'.$img ?>" alt=""></div>
									</td>
									
									<td class="">
										 <p>Title: <b><?php echo ucwords($row['art_title']) ?></b></p>
										 <p><small>Artist: <b><?php echo ucwords($row['aname']) ?></b></small></p>
										 <p><small>Description:</small></p>
										 <p class="truncate"><?php echo strip_tags($desc) ?></p>
									</td>
									<td class="text-right">
										 <p> <b><?php echo number_format($row['price'],2) ?></b></p>
									</td>
									<td class="text-center">
										 <?php if($row['status'] == 1): ?>
										 	<span class="badge badge-success">Sold</span>
										 <?php else: ?>
										 	<span class="badge badge-secondary">For Sale</span>
										 <?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_art_fs" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_art_fs" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Order</b>
						<span class="">

				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Canvas Information</th>
									<th class="">Customer</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(isset($_SESSION['login2_id']))
								$login2_id = $_SESSION['login2_id'];
								$i = 1;
								$users = $conn->query("SELECT * FROM users ");
								while($row = $users->fetch_assoc()){
									$uname[$row['id']] = ucwords($row['name']);
								}
								$arts = $conn->query("SELECT * FROM arts ");
								while($row = $arts->fetch_assoc()){
									$art_arr[$row['id']] = $row;
								}
								$fs = $conn->query("SELECT o.*,fs.art_id, u.id as artist_id FROM orders o inner join arts_fs fs on fs.id = o.art_fs_id inner join arts a on a.id = fs.art_id inner join users u on u.id = a.artist_id where u.id = $login2_id order by o.id desc");
								while($row=$fs->fetch_assoc()):
									
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p>Title: <b><?php echo ucwords($art_arr[$row['art_id']]['art_title']) ?></b></p>
										 <p><small>Artist: <b><?php echo ucwords($uname[$art_arr[$row['art_id']]['artist_id']]) ?></b></small></p>
										 <p><small>Description:</small></p>
									</td>
									<td class="text-right">
										 <p> <b><?php echo ucwords($uname[$row['customer_id']]) ?></b></p>
									</td>
									<td class="text-center">
										 <?php if($row['status'] == 0): ?>
										 	<span class="badge badge-secondary">For Verification</span>
										 <?php elseif($row['status'] == 1): ?>
										 	<span class="badge badge-primary">Confirmed</span>
										<?php elseif($row['status'] == 2): ?>
										 	<span class="badge badge-danger">Cancelled</span>
										<?php elseif($row['status'] == 3): ?>
										 	<span class="badge badge-success">Deliverd</span>
										 <?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_order" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<?php if(in_array($row['status'],array(0,2))): ?>
										<button class="btn btn-sm btn-outline-danger delete_order" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										 <?php endif; ?>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_art').click(function(){
		location.href ="index.php?page=view_art&id="+$(this).attr('data-id')
		
	})
	$('.edit_art').click(function(){
		location.href ="index.php?page=edit_art&id="+$(this).attr('data-id')
	})
	$('.delete_art').click(function(){
		if (confirm("Are you sure you want to delete this art?")) {
		start_load()
  		$.ajax({
    	url:'admin/ajax.php?action=delete_art',
    	method:'POST',
    	data:{id:$(this).attr('data-id')},
    	success:function(resp){
      	if(resp==1){
        alert_toast("Data successfully deleted",'success')
        setTimeout(function(){
          location.reload()
        },500)
        end_load()
	  }
	}
	})
	}
	})
	$('#new_art_fs').click(function(){
		uni_modal("New Entry","art_onsale.php")
	})
	$('.edit_art_fs').click(function(){
		uni_modal("Edit Entry","art_onsale.php?id="+$(this).attr('data-id'))	
	})
	$('.delete_art_fs').click(function(){
		if (confirm("Are you sure you want to delete this art?")) {
		start_load()
  		$.ajax({
    	url:'admin/ajax.php?action=delete_art_fs',
    	method:'POST',
    	data:{id:$(this).attr('data-id')},
    	success:function(resp){
      	if(resp==1){
        alert_toast("Data successfully deleted",'success')
        setTimeout(function(){
          location.reload()
        },500)
        end_load()
	  }
	}
	})
	}
	})
	$('.edit_order').click(function(){
		uni_modal("Order List","manage_art_onsale.php?id="+$(this).attr('data-id'), 'mid-large')
	})
	$('.delete_order').click(function(){
		if (confirm("Are you sure you want to delete this order?")) {
		start_load()
  		$.ajax({
    	url:'admin/ajax.php?action=delete_order',
    	method:'POST',
    	data:{id:$(this).attr('data-id')},
    	success:function(resp){
      	if(resp==1){
        alert_toast("Data successfully deleted",'success')
        setTimeout(function(){
          location.reload()
        },500)
        end_load()
	  }
	}
	})
	}
	})
</script>