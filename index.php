<!DOCTYPE html>
<html lang="en">

    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
         }
    ob_end_flush();
    include('./header.php');
    ?>

    <style>
    	header.masthead {
		  background: url(admin/assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
		}
    ul.navbar-nav {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.nav-button {
    margin: 0 10px;
}
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    right: -4.5em;
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }
/* Target the notification badge element */
.notification-badge {
  /* Position and size */
  position: absolute;
  top: -10px;
  right: -10px;
  width: 20px;
  height: 20px;
  
  /* Background color */
  background-color: red;
  
  /* Rounded corners */
  border-radius: 50%;
  
  /* Text styling */
  color: white;
  font-weight: bold;
  text-align: center;
  line-height: 20px;
}
.notification-badge.seen-notification {
    display:none;
}
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <a><?php if(isset($_SESSION['login2_id'])) echo "Welcome back ".$_SESSION['login2_name']."!"?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=explore">Explore</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <?php if(isset($_SESSION['login2_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=profile">Edit Profile</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=manage_art">Manage Artworks</a></li>
                        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications
            <span class="notification-badge <?php 
            // get the count of unseen notifications
            $query = "SELECT COUNT(*) as count,seen FROM notifications WHERE seen = 0";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $unseen_notifications_count = $row['count'];
                if($unseen_notifications_count > 0){
                    echo " ";
                }
                else{
                  echo " seen-notification";
                }
            }
        ?>">
            <?php 
                if($unseen_notifications_count > 0){
                    echo $unseen_notifications_count;
                }
                else{
                  echo "";
                }
        ?>
         
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
            <h6 class="dropdown-header">Orders</h6>
            <?php if (isset($_SESSION['login2_id'])){
									$login2_id = $_SESSION['login2_id'];
								} 
        // get all unseen notifications
        $query = "SELECT * FROM notifications WHERE seen = 0 AND orders_id IS NOT NULL AND ratings_comments_id = 0";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $class = "new-notification";
                echo "<a class='dropdown-item $class' href='#' data-notification-id='{$row['id']}' onclick='update_notification_seen({$row['id']})'>{$row['message']}</a>";
            }
          }
          else{
            echo "<a class='dropdown-item'>No new notifications</a>";
          }
          ?>
          <div class="dropdown-divider"></div>
  <h6 class="dropdown-header">Ratings and Comments</h6>
  <?php
          $query = "SELECT * FROM notifications WHERE seen = 0 AND ratings_comments_id IS NOT NULL AND orders_id = 0";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $class = "new-notification";
                echo "<a class='dropdown-item $class' href='#' data-notification-id='{$row['id']}' onclick='update_notification_seen({$row['id']})'>{$row['message']}</a>";
            }
        }
            else{
              echo "<a class='dropdown-item'>No new notifications</a>";
          }
    ?>
    </span>
              </div>
                        <?php endif;?>
                    
	                          <li class="nav-button">
                              <?php if(!isset($_SESSION['login2_id'])):?>
                              <button class="btn btn-primary float-right btn-sm" id="old_user">Log In</button>
                              </li>
                            <?php endif;?>
                              <li class="nav-button">
                              <button class="btn btn-primary float-right btn-sm" id="new_user">Sign up</button>
                              </li>
                            <?php if(isset($_SESSION['login2_id'])): ?>
                              <li class="nav-button"></li>
                            <button class="btn btn-primary float-right btn-sm" id="logout2">Log Out</button>
                              </li>
                            <?php endif;?>
                           </li> 
                  
                    </ul>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <?php while(isset($_POST['submit'])){
          if ($_POST['name' == ''] || $_POST['username'] == '' || $_POST['password'] == ''){
            echo "Please enter all fields.";
          }
        }?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class="bg-light py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                </div>
            </div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>

<script>
  function update_notification_seen(id) {
    var notification = document.querySelector("a[data-notification-id='" + id + "']");
    notification.classList.toggle("seen");
}
$('#old_user').click(function(){
	location.href = 'login2.php';
})
$('#logout2').click(function(){
		location.href = 'logout2.php';
	})
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('#navbarDropdown').click(function(){
  update_notification_seen();
})
function update_notification_seen(notification_id){
  $.ajax({
    type: "POST",
            url: "update_notification.php",
            data: {notification_id: notification_id}, 
            success:function(resp){
              $('.notification-badge').addClass('seen-notification');
            }        
  })
}
</script>


