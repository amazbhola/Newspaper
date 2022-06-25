<?php 

if (isset($_POST['submit'])) {
    require_once('../config.php');
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $last_name = mysqli_real_escape_string( $conn,$_POST['l_name']);
    $username = mysqli_real_escape_string( $conn,$_POST['username']);
    // $password = mysqli_real_escape_string( $conn,md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', username ='$username', role = '$role' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn,$sql) or die("Query Fail".mysqli_errno($conn));

    header("Location: {$hostname}admin/users.php");

    mysqli_close($conn);
}

?>