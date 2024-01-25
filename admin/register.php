<header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">New User registration</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

<div class="container-fluid">
	<form action="" id="signup">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
        <div class="form-group">
        <label for="" class="control-label">Contact</label>
			<input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
        </div>
        <div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class= "control-label">Password</label>
        	<input type="password" class="form-control" name="password"  value="<?php echo isset($password) ? $password :'' ?>" required>
		</div>
		<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Signup</button></center>
        <input type="hidden" name="user_type" value="<?php echo isset($id) ? $id :'2' ?>">
	</form>
</div>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<script>
	$('#register').submit(function(e){
		e.preventDefault()
		$('#register button[type="button"]').attr('disabled',true).html('Signing up');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
			$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#register button[type="button"]').removeAttr('disabled').html('Register');

			},
			success:function(resp){
				if(resp == 1){
					alert_toast("User added","success")
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#register button[type="button"]').removeAttr('disabled').html('Register');
				}
			}
		})
	})
</script>

