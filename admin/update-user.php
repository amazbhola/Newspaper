<?php include "header.php";
require_once('../config.php');

if($_SESSION['role']==0){
    header("Location:{$hostname}admin/post.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql) or die("Query Fail");

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                <form action="update-user-inline.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value=" <?php echo $row['user_id'] ?> " placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?> " placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?> " placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?> " placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $row['role'] ?>">
                            <?php 
                                if ($row['role']==0) {
                                    echo '<option selected value="0">Normal User</option>
                                    <option value="1">Admin</option>';
                                }else{
                                    echo '<option value="0">Normal User</option>
                                    <option selected value="1">Admin</option>';
                                }
                            ?>
                                
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php } mysqli_close($conn); ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>