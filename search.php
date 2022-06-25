<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php include 'config.php';
                    $search = $_GET['search'];
                
                    ?>
                    <h2 class='page-heading'>Search :<?php echo $search ?></h2>
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
                        WHERE post.title LIKE '%$search%'
                        OR post.description LIKE '%$search%'
                        OR category.category_name LIKE '%$search%'
                        OR user.username LIKE '%$search%'
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
                            echo '<li><a href="index.php?page=' . ($page - 1) . '&search='.$search.'">Prev</a></li>';
                        }
                        $sql1 = "SELECT * FROM post 
                        LEFT JOIN category ON post.category = category_id 
                        LEFT JOIN user ON post.author = user_id 
                        WHERE post.title LIKE '%$search%'
                        OR post.description LIKE '%$search%'
                        OR category.category_name LIKE '%$search%'
                        OR user.username LIKE '%$search%'
                        ";
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
                                echo '<li class="' . $active . '"><a href="index.php?page=' . $i . '&search='.$search.'">' . $i . '</a></li>';
                            }
                        } else {
                            $total_page = 0;
                        }
                        if ($total_page > $page) {
                            echo '<li ><a href="index.php?page=' . ($page + 1) . '&search='.$search.'">Next</a></li>';
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