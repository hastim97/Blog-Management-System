<!DOCTYPE html>
<html lang="en">
<?php
    $page='dashboard';
    include_once("includes/header.php");
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
                    </div>
                </div>
                <!-- /.row -->
    
                <?php
                    include_once("includes/dashboard.php");
                ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
