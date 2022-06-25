<?php


    include '../config.php';
    /**
     * Images uploads function
     */
    
    if (isset($_FILES['fileToUpload'])) {
        $errors=[];
        $post_img_name = $_FILES['fileToUpload']['name'];
        $post_img_size = $_FILES['fileToUpload']['size'];
        $post_img_tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $post_img_type =  $_FILES['fileToUpload']['type'];
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
            move_uploaded_file($post_img_tmp_name,$uploadFolder.basename($post_img_name));
        }else{
            print_r($errors);
        }
        
        
    }
    /**
     * Post Data Uploads Function
     */
    session_start();
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $post_date = date("d M,Y");
    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post( title, description, category, post_date,author,post_img) VALUE('$title','$description','$category','$post_date','$author','$post_img_name');";
    $sql.="UPDATE category SET post = post+1 WHERE category_id = '$category'";
    $result = mysqli_multi_query($conn, $sql) or die("Query Fail");
    header("Location:{$hostname}admin/");
    mysqli_close($conn);
