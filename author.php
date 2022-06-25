<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php include 'config.php';
                    $author = $_GET['author'];
                    $sql_user_name = "SELECT * FROM user WHERE user_id = $author";
                    $username_result = mysqli_query($conn, $sql_user_name);
                    if ($username = mysqli_fetch_assoc($username_result)) {
                        $username = $username['username'];
                        echo "<h2 class='page-heading'>".ucfirst($username)."</h2>";
                    }
                    ?>
                    <?php
                    
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 4;
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT post.post_id,  post.title, post.description, post.category, post.post_date, post.author, category.category_name, user.username, post.post_img FROM post 
                        LEFT JOIN category ON post.category = category_id 
                        LEFT JOIN user ON post.author = user_id 
                        WHERE author = $author
                        ORDER BY post_id DESC LIMIT $offset,$limit";
                    $result = mysqli_query($conn, $sql) or die("Query Fail join other table");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {


                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/uploads/<?php echo $row['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cat_id=<?php echo $row['category'] ?>'><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?author=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 150) . " ..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php  }
                    } ?>
                    <ul class='pagination'>
                        <?php
                        if ($page > 1) {
                            echo '<li><a href="author.php?page=' . ($page - 1) . '&author='.$author.'">Prev</a></li>';
                        }
                        $sql1 = "SELECT * FROM post WHERE author = $author";
                        $result1 = mysqli_query($conn, $sql1) or die("Pagi Query Fail");
                        if (mysqli_num_rows($result1) > 0) {
                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class="' . $active . '"><a href="author.php?page=' . $i . '&author='.$author.'">' . $i . '</a></li>';
                            }
                        } else {
                            $total_page = 0;
                        }
                        if ($total_page > $page) {
                            echo '<li ><a href="author.php?page=' . ($page + 1) . '&author='.$author.'">Next</a></li>';
                        }
                        mysqli_close($conn);
                        ?>

                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>