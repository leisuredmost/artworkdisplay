<div class="container-fluid">
	<form action="" onsubmit="return validateMalaysianPhoneNumber()" id="manage-order">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<input type="hidden" name="fs_id" value="<?php echo isset($_GET['fs_id']) ? $_GET['fs_id'] :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Street Address</label>
			<textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact" id="phone" value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
	</form>
</div>
<script>
	function validateMalaysianPhoneNumber() {
  var phoneNumber = document.getElementById("phone").value;
  var pattern = /^(\+60|0)[1-9]{1}[0-9]{7,8}$/;
  if (pattern.test(phoneNumber)) {
    // phone number is valid
    return true;
  } else {
    // phone number is invalid
    alert("Please enter a Malaysian phone number");
    return false;
  }
}
	$('#manage-order').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		var formData = new FormData($(this)[0])
		var isValid = true;
		$(".form-control").each(function(){
			if($(this).val() == ""){
				isValid = false;
			}
		})
		if(isValid && validateMalaysianPhoneNumber){
		$.ajax({
			url:'admin/ajax.php?action=save_order',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Order Request Sent.",'success')
						end_load()
						uni_modal("","order_msg.php");
				}
			}
		})
	}else{
					alert_toast("Invalid credentials.", 'danger')
					end_load()
	}
	})
</script>