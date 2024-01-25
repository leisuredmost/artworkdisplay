<?php include 'db_connect.php' ?>

<?php
$rc = $conn->query("SELECT rc.*,fs.art_id,fs.price,a.artist_id,a.art_title FROM ratings_comments rc inner join arts_fs fs on fs.id = rc.art_fs_id inner join arts a on fs.art_id = a.id where rc.id = ".$_GET['id']);
foreach($fs->fetch_array() as $k => $v){
    $$k = $v;
}
$user = $conn->query("SELECT * FROM users where id IN ($artist_id,$customer_id)");
while($row = $user->fetch_assoc()){
    $urow[$row['id']] = $row;
}

?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <p>Customer Name: <b><?php echo ucwords($urow[$customer_id]['name']) ?></b></p>
                <p>Customer Rating: <b><?php echo $urow[$customer_id]['rating'] ?></b></p>
                <p>Customer Comment: <b><?php echo $urow[$customer_id]['comment'] ?></b></p>
            </div>
        </div>
        <form action="" id="manage-rating">
            <input type="hidden" name="rating_comment_id" value="<?php echo  $id ?>">
            <input type="hidden" name="fs_id" value="<?php echo  $art_fs_id ?>">
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="" class="control-label">Rating</label>
                    <select id="" name="rating" value="<?php echo isset($rating) ? $rating :'' ?>" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
            </select>
                </div>   
        </form>
    </div>
</div>
<div class="modal-footer display">
    <div class="col-lg-12">
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary float-right mr-2" id='submit' onclick="$('#uni_modal form').submit()">Update</button>
    </div>
</div>
<style>
#uni_modal .modal-footer{
    display:none;
}
.display{
    display:block !important;
}
</style>
