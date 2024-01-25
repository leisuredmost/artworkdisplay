<?php include('admin/db_connect.php')?>

 <!-- Masthead-->
 <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">About Us</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

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
						<b>Edit profile</b>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">Username</th>
									<th class="">Password</th>
									<th class="">Address</th>
									<th class="">Contact #</th>
									<th clas="">LinkedIn(Optional)</th>
									<th clas="">Facebook(Optional)</th>
									<th clas="">Twitter(Optional)</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                if(isset($_SESSION['login2_id'])){
                                    $login2_id = $_SESSION['login2_id'];
                                } 
								$i = 1;
								$types = $conn->query("SELECT * FROM users where id = $login2_id");
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										<p> <b><?php echo $row['username'] ?></b></p>
									</td>
									<td class="">
										<p> <b><?php echo $row['password'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['address'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['contact'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['linkedin'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['facebook'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['twitter'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_artist" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
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

<div>

<script>
	$('.edit_artist').click(function(){
		uni_modal("Edit artist","edit_user.php?id="+$(this).attr('data-id'))
	})
</script>