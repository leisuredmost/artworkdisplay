<?php include('db_connect.php');?>

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
						<b>List of Ratings</b>
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
									<th class="">Rating</th>
									<th class="">Comment</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$users = $conn->query("SELECT * FROM users ");
								while($row = $users->fetch_assoc()){
									$uname[$row['id']] = ucwords($row['name']);
								}
								$arts = $conn->query("SELECT * FROM arts ");
								while($row = $arts->fetch_assoc()){
									$art_arr[$row['id']] = $row;
								}
								$fs = $conn->query("SELECT rc.*,fs.art_id FROM ratings_comments rc inner join arts_fs fs on fs.id = rc.art_fs_id order by rc.id desc ");
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
										 <p><b><?php echo ucwords($uname[$row['customer_id']]) ?></b></p>
									</td>
									<td class="">
										<p><b><?php echo ($row['rating'])?></b></p>
									</td>
									<td class="">
										<p><b><?php echo ($row['comment'])?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-danger delete_rating" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
</script>