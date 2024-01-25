<div class="container-fluid">
	<form action="" id="manage-rating">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<input type="hidden" name="fs_id" value="<?php echo isset($_GET['fs_id']) ? $_GET['fs_id'] :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<div class="form-group">
		<label for="" class="control-label">Rating</label>
			<select id="" name="rating" value="<?php echo isset($rating) ? $rating :'' ?>" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Comment</label>
			<input type="text" class="form-control" name="comment"  value="<?php echo isset($comment) ? $comment :'' ?>" required>
		</div>
	</form>
</div>
<script>
	$('#manage-rating').submit(function(e){
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
		if(isValid){
		$.ajax({
			url:'admin/ajax.php?action=save_rating_comment',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data saved.",'success')
						setTimeout(function(){
							location.reload()
						},1500)		
				}
			}
		})
	}else{
					alert_toast("Please fill out all fields.", 'danger')
					end_load()
	}
	})
</script>