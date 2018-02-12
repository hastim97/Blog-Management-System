
<!DOCTYPE html>
<html lang="en">
<?php
    $title="Individual post";
    include_once('includes/header.php');
    include_once('includes/db.php');
?>

<body>

    <!-- Navigation -->
    <?php
        include_once('includes/navigation.php');
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php
                    if(!session_start())
                        session_start();
                    $id=$_SESSION['user_id'];
                    if(isset($_GET['p_id'])){
                        $id=$_GET['p_id'];
                        $query="SELECT * FROM posts,users where posts.post_author=users.id and post_id=$id and post_status='published'";
                        $result=mysqli_query($connection,$query);
                        if($row=mysqli_fetch_assoc($result)){
                            
                            $post_title=$row['post_title'];
                            $post_author_id=$row['post_author'];
                            $post_author=$row['first_name']." ".$row['last_name'];
                            $post_date=$row['post_date'];
                            $post_image=$row['post_image'];
                            $post_content=$row['post_content'];
                        
                ?>
                <!-- Title -->
                <h1><?php echo $post_title;?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author;?></a>
                <?php  
                    if($post_author_id==$id){
                        echo "<a href='admin/posts.php?source=edit_posts&p_id=$id' class='btn btn-warning'>Edit Post</a>";
                    }
                ?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post_content;?></p>

                <hr>

                <!-- Blog Comments -->

                

                <hr>

                <?php 
                        }
                    }
                    include_once('comments.php');
                ?>
                
                <!--Comment section-->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include_once('includes/sidebar.php');
            ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php
            include_once('includes/footer.php');
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
