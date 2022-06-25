<?php include "header.php"; 
if($_SESSION['role']==0){
    header("Location:{$hostname}admin/post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                    <?php 
                        include '../config.php';
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM category WHERE category_id = $id";
                        $result = mysqli_query($conn,$sql)or die("Query Fail");
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                  <form action="update_category_inline.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
