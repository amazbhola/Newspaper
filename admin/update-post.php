<?php include "header.php"; 
    if ($_SESSION['role']==0) {
        include '../config.php';
                $id = $_GET['id'];
                $sql2 = "SELECT author FROM post where post_id = $id";
                $result2 = mysqli_query($conn, $sql2) or die("User role Query Fail");
                $row2 = mysqli_fetch_assoc($result2);
                if ($row2['author']!= $_SESSION['user_id']) {
                   header("Location:{$hostname}admin/post.php");
                }
    }
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                include '../config.php';
                $id = $_GET['id'];
                $sql = "SELECT post.post_id, post.title, post.category,  category.category_name, post.post_date,user.username,post.post_img, post.description FROM post 
                        LEFT JOIN category ON post.category = category_id 
                        LEFT JOIN user ON post.author = user_id where post_id = $id ";

                $result = mysqli_query($conn, $sql) or die("Edit Page Pickup Query Fail");
                    while ($data = mysqli_fetch_assoc($result)) { ?>
                        <form action="update_post_inline.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $data['post_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $data['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                                    <?php echo $data['description'] ?>
                                </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <?php 
                                        $sql_two = "SELECT * FROM category";
                                        $result_two = mysqli_query($conn, $sql_two) or die('select option query not work');
                                        while ($row = mysqli_fetch_assoc($result_two)) {
                                        if ($data['category']==$row['category_id']) {
                                            $selected = "selected";
                                            
                                        }else{
                                            $selected = "";
                                            
                                        }
                                   
                                    ?>
                                        <option <?php echo $selected ?> value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new_image">
                                <img src="uploads/<?php echo $data['post_img'] ?>" height="150px">
                                <input type="hidden" name="old_image" value="<?php echo $data['post_img'] ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                <?php } mysqli_close($conn); ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>