<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    $page='comments';
    include_once("includes/header.php");
    include_once('functions.php');
?>
<body>

    <div id="wrapper">
            
    <?php
        include_once("includes/navigation.php");
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to CPanel
                            <small><?php echo $username;?></small>
                        </h1>
                        
                        <?php
                            $source="";
                            if(isset($_GET['source'])){
                                $source=$_GET['source'];
                            }
                            switch($source){
                                    
                                case 'edit_posts':
                                    include_once('includes/posts/edit_posts.php');
                                    break;
                                case 'add_posts':
                                    include_once('includes/posts/add_posts.php'); 
                                    break;
                                default: 
                                    include_once('includes/comments/view_all_comments.php');
                            }
                        
                        ?>
                        
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
