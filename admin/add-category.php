<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <?php 
                    if (isset($_POST['save'])) {
                        require_once('../config.php');
                        $cat = mysqli_real_escape_string($conn,$_POST['cat']);
                        $sql = "INSERT INTO category(category_name)VALUE('$cat')";
                        $result = mysqli_query($conn,$sql)or die('Query Fail'.mysqli_errno($conn));
                        if ($result) {
                            echo "Category Inserted";
                        }
                        mysqli_close($conn);
                    }
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" spellcheck="value" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
