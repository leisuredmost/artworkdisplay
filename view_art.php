<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT a.*,u.name as aname FROM arts a inner join users u on u.id = a.artist_id where a.id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}

$fs = $conn->query("SELECT * FROM arts_fs where art_id = $id ");
        if($fs->num_rows > 0):
            $fs_aid = $fs->fetch_array();
        endif;
}
$result = $conn->query("SELECT u.linkedin, u.facebook, u.twitter 
FROM users u 
INNER JOIN arts a ON a.artist_id = u.id 
INNER JOIN arts_fs fs ON fs.art_id = a.id 
WHERE u.name = '$aname'");
$row = $result->fetch_assoc();
$linkedin = $row['linkedin'];
$facebook = $row['facebook'];
$twitter = $row['twitter'];
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#content{
		border-left:1px solid gray;
	}
	header.masthead {
		min-height: 20vh !important;
		height: 20vh !important
	}
	.logo-button {
  background-color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  display: inline-block;
}

.logo-button img {
  width: 30px;
  height: 30px;
  vertical-align: middle;
  margin-right: -20px;
}
</style>
</head>
<header class="masthead">
</header>

<section>
<div class="container-field">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="row">
						<?php 
					  		$images = array();
					  		if(isset($id)){
					  			$fpath = 'admin/assets/uploads/artist_'.$id;
					  			$images= scandir($fpath);
					  		}
					  		foreach($images as $k => $v):
					  			if(!in_array($v,array('.','..'))):
			  					
					  	?>
					  		<div class="imgs">
					  			<img src="<?php echo $fpath.'/'.$v ?>" alt="">
					  		</div>
					  	<?php
					  			else:
			  						unset($images[$v]);
					  			endif;
				  			endforeach;
					  	?>
					</div>
					</div>
					<div class="col-md-8" id="content">
						<h4 class="text-center"><b><?php echo ucwords($art_title) ?></b></h4>
						<hr class="divider">
						<center><small><?php echo ucwords($aname) ?></small></center>
						<center>
						<a href="https://<?php echo $linkedin;?>">
						<button class="logo-button">	
  <img src="linkedin-logo.png" alt="Logo">
</button></a>
<a href="https://<?php echo $facebook;?>">
<button class="logo-button">
  <img src="facebook-logo.png" alt="Logo">
</button></a>
<a href="https://<?php echo $twitter; ?>">
<button class="logo-button">
  <img src="twitter-logo.png" alt="Logo">
						
</button></a>
</center>
						<center>
							 <?php if(isset($fs_aid)): ?>
                                    <div>
                                        <span class="badge badge-success">For Sale</span>
										<span class="badge badge-primary"><a href="javascript:void(0)" class="review_this text-white" data-id="<?php echo $fs_aid['id'] ?>">Review</a></span>
                                        <span class="badge badge-secondary"><i class="fa fa-tag"></i> <?php echo number_format($fs_aid['price'],2) ?></span>
                                        <span  class="badge badge-primary"><a href="javascript:void(0)" class="order_this text-white" data-id="<?php echo $fs_aid['id'] ?>">Buy</a></span>
                                    </div>
                                <?php endif; ?>
						</center>
						<br>
						<?php echo html_entity_decode($art_description); ?>
						<div class="card-header">
							<b>Art Reviews</b>
							<span class="">
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Customer</th>
									<th class="">Rating</th>
									<th class="">Comment</th>
								</tr>
								<?php
								$i = 1;
								$users = $conn->query("SELECT * FROM users ");
								while($row = $users->fetch_assoc()){
									$uname[$row['id']] = ucwords($row['name']);
								}
								$fs = $conn->query("SELECT rc.*,fs.art_id FROM ratings_comments rc inner join arts_fs fs on fs.id = rc.art_fs_id WHERE fs.art_id = $id order by rc.id desc ");
								while($row=$fs->fetch_assoc()):
								?>
								<tr>
								<td class="text-center"><?php echo $i++ ?></td>
								</td>
								<td class="">
									<p><b><?php echo ucwords($uname[$row['customer_id']]) ?></b></p>
								</td>
								<td class="">
										<p><b><?php echo ($row['rating'])?></b></p>
									</td>
									<td class="">
										<p><b><?php echo ($row['comment'])?></b></p>
									</td>
									<?php endwhile;?>
								</tr>
							</thead>
							 </table>
							</span>
							 </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$('.imgs img').click(function(){
		viewer_modal($(this).attr('src'))
	})
	$('.review_this').click(function(){
		uni_modal("Review Art","manage_rating_comment.php?fs_id="+$(this).attr('data-id'))
	})
	$('.order_this').click(function(){
		uni_modal("Request Order","manage_order.php?fs_id="+$(this).attr('data-id'))
	})
</script>