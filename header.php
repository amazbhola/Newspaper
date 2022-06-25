<?php 
    include 'config.php';
    $page = basename($_SERVER['PHP_SELF']);
    switch ($page) {
        case 'category.php':
            if (isset($_GET['cat_id'])) {
                $title_sql = "SELECT * FROM category WHERE category_id = {$_GET['cat_id']}";
                $title_result = mysqli_query($conn,$title_sql);
                $row_title = mysqli_fetch_assoc($title_result);
                $page_title = $row_title['category_name']." News";
            }
            break;
        case 'author.php':
            if (isset($_GET['author'])) {
                $title_sql = "SELECT * FROM user WHERE user_id = {$_GET['author']}";
                $title_result = mysqli_query($conn,$title_sql);
                $row_title = mysqli_fetch_assoc($title_result);
                $page_title = "News By : ".$row_title['username'];
            }
            break;
        case 'single.php':
            if (isset($_GET['id'])) {
                $title_sql = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
                $title_result = mysqli_query($conn,$title_sql);
                $row_title = mysqli_fetch_assoc($title_result);
                $page_title = $row_title['title']." News";
            }
            break;
        
        default:
            $page_title = "News Site";
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'config.php'; ?>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href='<?php echo $hostname ?>'>Home</a></li>
                    <?php 
                        $sql = "SELECT * FROM category WHERE post > 0";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (isset($_GET['cat_id'])&& $_GET['cat_id']==$row['category_id']) {
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            ?>
                        <li><a class="<?php echo $active ?>" href='category.php?cat_id=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a></li>
                    
                    <?php } mysqli_close($conn); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
