<?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "artwork_display_db");
    $ratingsCount = $conn->query("SELECT COUNT(*) FROM ratings_comments")->fetch_row()[0];
    $commentsCount = $conn->query("SELECT COUNT(*) FROM ratings_comments")->fetch_row()[0];
    $usersCount = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
?>

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

    <section class="page-section">
        <div class="container">
    <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>        
            
        </div>
      
        <center><table>
            <h4>Mini Dashboard</h4>
    <tr>
        <th>Metric</th>
        <th>Count</th>
    </tr>
    <tr>
        <td>Total Ratings</td>
        <td><?php echo $ratingsCount; ?></td>
    </tr>
    <tr>
        <td>Total Comments</td>
        <td><?php echo $commentsCount; ?></td>
    </tr>
    <tr>
        <td>Total Users</td>
        <td><?php echo $usersCount; ?></td>
    </tr>
</table></center>
        </section>


