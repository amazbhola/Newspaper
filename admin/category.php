<?php include "header.php"; 
    include_once('../config.php');
    
    if($_SESSION['role']==0){
        header("Location:{$hostname}admin/post.php");
    }

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 3;
                        
                        if (isset($_GET['page'])) {
                            $page_no = $_GET['page'];
                        }else{
                            $page_no = 1;
                        }
                        $offset = ($page_no-1)* $limit;
                        $sql1 = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset, $limit ";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Fail");
                        $rows =[];
                        $serial = $offset+1;
                        while ($row = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
                            $rows[] = $row;
                        }
                        foreach ($rows as $row) {
                            # code...
                        
                        ?>
                        <tr>
                            <td class='id'><?php echo $serial ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['post'] ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php $serial++; } ?>

                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <!-- <li class="active"><a>1</a></li> -->
                    <?php
                    if ($page_no>1) {
                        echo '<li ><a href="category.php?page='.($page_no-1).'">Prev</a></li>';
                    }
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $total_records = mysqli_num_rows($result);

                        $total_page = ceil($total_records / $limit);
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page_no) {
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            echo '<li class ='.$active.'><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                        }
                    }else{
                        $total_page =1;
                    };
                    if ($total_page>$page_no) {
                        echo '<li ><a href="category.php?page='.($page_no+1).'">Next</a></li>';
                    }
                    mysqli_close($conn);
                    ?>


                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>