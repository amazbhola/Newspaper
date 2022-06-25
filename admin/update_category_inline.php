<?php 
      if (isset($_POST['sumbit'])) {
        require_once('../config.php');
        $id = mysqli_real_escape_string($conn,$_POST['cat_id']);
        $cat = mysqli_real_escape_string($conn,$_POST['cat_name']);
        $sql = "UPDATE category SET category_name = '$cat' WHERE  category_id ='$id'";
        $result = mysqli_query($conn,$sql)or die('Query Fail'.mysqli_errno($conn));
        if ($result) {
            echo "Category UPDATED";
        }
        header("Location: {$hostname}admin/category.php");
        mysqli_close($conn);
    }
?>