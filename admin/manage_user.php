<?php include('db_connect.php') ?>
<?php 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM users where id =".$_GET['id']);
	foreach($qry->fetch_array() as $k =>$val){
		$k=$val;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($name) ? $name: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($username) ? $username: '' ?>" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="text" name="password" id="password" class="form-control" value="<?php echo isset($password) ? $password: '' ?>" autocomplete="on">
		</div>
		<div class="form-group">
			<label for="user_type">User Type</label>
			<select name="user_type" id="user_type" class="custom-select">
				<option value="2" <?php echo isset($user_type) && $user_type == 2 ? 'selected': '' ?>>Artist</option>
				<option value="1" <?php echo isset($user_type) && $user_type == 1 ? 'selected': '' ?>>Admin</option>
			</select>
		</div>
	</form>
</div>
<script>
		$('#manage-user').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else{
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
</script>
