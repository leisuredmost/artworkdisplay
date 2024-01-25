<div class="container-fluid">
	<form action="" onsubmit="return validateMalaysianPhoneNumber() && validateURL()" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Artist Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Username</label>
			<input type="text" class="form-control" name="username"  value="<?php echo isset($username) ? $username :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" class="form-control" name="password"  value="<?php echo isset($password) ? $password :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact" id="phone" value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">LinkedIn (Optional)</label>
			<input type="text" class="form-control" data-optional="optional" name="linkedin" id="input" value="<?php echo isset($linkedin) ? $linkedin :'' ?>">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Facebook (Optional)</label>
			<input type="text" class="form-control" data-optional="optional" name="facebook" id="input" value="<?php echo isset($facebook) ? $facebook :'' ?>">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Twitter (Optional)</label>
			<input type="text" class="form-control" data-optional="optional" name="twitter" id="input" value="<?php echo isset($twitter) ? $twitter :'' ?>">
		</div>
	</form>
</div>


<script>
	function validateURL() {
  var urlInput = document.getElementById("input");
  if (urlInput.value.trim() === "") {
    return true;
  } else {
    var pattern = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,}))\.?)(?::\d{2,5})?(?:[/?#]\S*)?$/i;
    if (!pattern.test(urlInput.value)) {
      alert("The URL is not valid.");
      return false;
    } else {
      return true;
    }
  }
}
function validateMalaysianPhoneNumber() {
  var phoneNumber = document.getElementById("phone").value;
  var pattern = /^(\+60|0)[1-9]{1}[0-9]{7,8}$/;
  if (pattern.test(phoneNumber)) {
    return true;
  } else {
    alert("Please enter a Malaysian phone number");
    return false;
  }
}

$('#manage-user').submit(function(e){
  e.preventDefault();
  start_load();
  $('#msg').html('');
  var formData = new FormData($(this)[0]);
  var isValid = true;
  $(".form-control").each(function(){
    if($(this).val() == "" && !$(this).data("optional")){
      isValid = false;
    }
  });
  if(isValid && validateMalaysianPhoneNumber() && (!$("#input").val().trim() || validateURL())) {
    $.ajax({
      url: 'admin/ajax.php?action=save_artist',
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
			}
		})
		}else{
					alert_toast("Invalid credentials.", 'danger')
					end_load()
		}
	})
</script>
