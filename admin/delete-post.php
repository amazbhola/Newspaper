<?php 
    if (isset($_GET['id'])) {
        include '../config.php';
        $id = $_GET['id'];
        $cat_id = $_GET['catid'];
        $sql_one = "SELECT * FROM post Where post_id= $id";
        $result_one = mysqli_query($conn, $sql_one);
        $row = mysqli_fetch_assoc($result_one);
        $image_file_name = $row['post_img'];

        $upload_folder = "uploads/";
        unlink($upload_folder.$image_file_name);

        $sql = "DELETE FROM post WHERE post_id= $id;";
        $sql.="UPDATE category SET post = post-1 WHERE category_id = $cat_id";
        if (mysqli_multi_query($conn,$sql)) {
            header("Location: {$hostname}admin/post.php");
        }else{
            echo "Delete Fail";
        }
        mysqli_close($conn);
    }
?>