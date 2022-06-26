<?php


    include '../config.php';
    /**
     * Images uploads function
     */
    
    if (empty($_FILES['new_image']['name'])) {
        $post_img_name = $_POST['old_image'];
    }else{
        $errors=[];
        $post_img_name = $_FILES['new_image']['name'];
        $post_img_size = $_FILES['new_image']['size'];
        $post_img_tmp_name = $_FILES['new_image']['tmp_name'];
        $post_img_type =  $_FILES['new_image']['type'];
        $post_image_extension = strtolower(pathinfo($post_img_name, PATHINFO_EXTENSION));
        $imageExtension = array('jpg', 'jpeg', 'png');
        
        
        /**
         * Check File Extension
         */
        if ($post_img_type != in_array($post_image_extension,$imageExtension)) {
            $errors[] = "Image Extension doesn't Match Please upload jpeg, jpg, png";
        }
        /**
         * Check Exiting Folder
         */
        if (!file_exists('uploads')) {
            mkdir('uploads');
        }
        $uploadFolder = 'uploads/';
        
        
        /**
         * Check File Size
         */
        if ($post_img_size > 2097152) {
            $errors[] = "File size must be 2MB or lower";
        }
        /**
         * Check Existing File
         */
       
        if (file_exists($uploadFolder.basename($post_img_name))) {
            $errors[] = "File already Exist";
        }
        /**
         * File upload
         */
        if (empty($errors)) {
            $img_name = time()."-".basename($post_img_name);
            move_uploaded_file($post_img_tmp_name,$uploadFolder.$img_name);
        }else{
            print_r($errors);
        }
    }
    /**
     * Post Data Uploads Function
     */
    
    $post_id = mysqli_real_escape_string($conn,$_POST['post_id']);
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $sql = "UPDATE post SET title='$title', description = '$description', category=$category, post_img ='$img_name' WHERE post_id = $post_id";
    
    $result = mysqli_multi_query($conn, $sql) or die("Query Fail");
    header("Location:{$hostname}admin/");
    mysqli_close($conn);
