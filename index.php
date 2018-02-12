<!DOCTYPE html>
<html lang="en">

<?php
    $title="My Blog";
    include_once("includes/header.php");
    include_once("includes/db.php");
    $posts_per_page=3;
?>

<body>

    <!-- Navigation -->
    <?php
        include_once("includes/navigation.php");
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Blog Management
                    <small>A Content Management System!</small>
                </h1>

                <?php        
                    if(!session_start())
                        session_start();
                    $id=$_SESSION['user_id'];
                
                
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                    }
                    else{
                        $page=1;
                    }
                    if($page==1){
                        $limit_start=0;
                    }
                    else{
                        $limit_start=($page*$posts_per_page)-$posts_per_page;
                    }
                
                    $query="SELECT * FROM posts,users where posts.post_author=users.id and post_status='published'";
                    $post_page=mysqli_query($connection,$query);
                    $total_post_count=mysqli_num_rows($post_page);
                    $count=ceil($total_post_count/$posts_per_page);
                
                    $total_query="SELECT * FROM posts,users where posts.post_author=users.id and post_status='published' LIMIT $limit_start,$posts_per_page";
                    $result=mysqli_query($connection,$total_query);
                
                    while($row=mysqli_fetch_assoc($result)){
                        $post_id=$row['post_id'];
                        $post_title=$row['post_title'];
                        $post_author_id=$row['post_author'];
                        $post_author=$row['first_name']." ".$row['last_name'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=strip_tags($row['post_content']);
                        $post_content=substr($post_content,0,150)."...";
                              
                ?>
               
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                
                <?php  
                    if($post_author_id==$id){
                        echo "<a href='admin/posts.php?source=edit_posts&p_id=$post_id' class='btn btn-warning'>Edit Post</a>";
                    }
                ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                
                <hr>
<!--                End of blog post-->
                <?php
                    }//end of while loop
                ?>
<!--               start of blog post-->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include_once("includes/sidebar.php");
            ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
            <?php
                for($i=1;$i<=$count;$i++){
                    if($i==$page)
                        echo "<li><a class='active-page' href='index.php?page=$i'>$i</a></li>";
                    else
                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
                }
            ?>
        </ul>
        <?php 
            include_once("includes/footer.php");
        ?>
        

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
