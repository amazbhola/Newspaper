<?php 
       include '../config.php';
       if (isset($_POST['save'])) {
           // Mysql Protect Function
           $first_name = mysqli_real_escape_string($conn, $_POST['fname']);
           $last_name = mysqli_real_escape_string( $conn,$_POST['lname']);
           $username = mysqli_real_escape_string( $conn,$_POST['user']);
           $password = mysqli_real_escape_string( $conn,md5($_POST['password']));
           $role = mysqli_real_escape_string($conn, $_POST['role']);
           $sql = "SELECT * FROM user WHERE username = '$username'";
           $result = mysqli_query($conn,$sql) or die("Query Fail");
   
           if (mysqli_num_rows($result) > 0) {
               echo "User Name Already Exist";
           }else{
               $sql1 = "INSERT INTO user (first_name,last_name, username, password, role ) VALUE('$first_name','$last_name','$username','$password','$role')";
               if (mysqli_query($conn,$sql1)) {
                   header("Location: http://localhost:81/newspaper/admin/users.php");
               }
           }
   
           
       }
   
       mysqli_close($conn);
?>