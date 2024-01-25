
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i class="fa fa-list"></i></span> Orders</a>
				<a href="index.php?page=art_fs" class="nav-item nav-art_fs"><span class='icon-field'><i class="fa fa-dollar-sign"></i></span> For Sale</a>
				<a href="index.php?page=arts" class="nav-item nav-arts"><span class='icon-field'><i class="fa fa-paint-brush"></i></span> Arts</a>
				<a href="index.php?page=artist" class="nav-item nav-artist"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Artist List</a>
				<a href="index.php?page=ratings" class="nav-item nav-ratings"><span class='icon-field'><i class="fa fa-star"></i></span> Art ratings</a>
				<a href="index.php?page=events" class="nav-item nav-events"><span class='icon-field'><i class="fa fa-calendar"></i></span>   Events</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
				
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
