<?php 
     // table serial to 0
     // ALTER TABLE yourTableName AUTO_INCREMENT=0;
     $hostname = "http://localhost:81/newspaper/";
     $conn = mysqli_connect('localhost','root','','news') or die("Connection Fail :". mysqli_connect_errno());
?>