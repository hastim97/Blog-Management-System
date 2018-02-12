<?php
    session_start();
    include_once("../includes/db.php");
    include_once("functions.php");
?>
    

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="js/plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
    <link href="js/plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
        $role=$_SESSION['role'];
        $id=$_SESSION['user_id'];
        $username=checkUser();
        if($page=='dashboard'){
            
            $id=$_SESSION['user_id'];

            if($role=='admin'){
                $post_query="SELECT * from posts";
                $publish_query="SELECT * from posts where post_status='published'";
                $draft_query="SELECT * from posts where post_status='draft'";
                $approved_query="SELECT * from comments where comment_status='approved'";
                $unapproved_query="SELECT * from comments where comment_status='unapproved'";    
            }
            else{
                $post_query="SELECT * from posts where post_author=$id";
                $publish_query="SELECT * from posts where post_author=$id and post_status='published'";
                $draft_query="SELECT * from posts where post_author=$id and post_status='draft'";
                $approved_query="SELECT * from comments where comment_post_id in (SELECT post_id from posts where post_author=$id) and comment_status='approved'" ;
                $unapproved_query="SELECT * from comments where comment_post_id in (SELECT post_id from posts where post_author=$id) and comment_status='unapproved'";
            }
            
            $result=mysqli_query($connection,$post_query);
            $post_count=mysqli_num_rows($result);

            $result=mysqli_query($connection,$approved_query);
            $approved_count=mysqli_num_rows($result);

            $result=mysqli_query($connection,$unapproved_query);
            $unapproved_count=mysqli_num_rows($result);
            
            
            $result=mysqli_query($connection,$publish_query);
            $active_post=mysqli_num_rows($result);
            
            $result=mysqli_query($connection,$draft_query);
            $pending_post=mysqli_num_rows($result);

            $query="SELECT * from users";
            $result=mysqli_query($connection,$query);
            $user_count=mysqli_num_rows($result);

            $category_query="SELECT * from categories";
            $result=mysqli_query($connection,$category_query);
            $category_count=mysqli_num_rows($result);
            
            $element_text=['Active Posts','Posts','Categories', 'Users', 'Comments','Pending'];
            $element_count=[$active_post,$pending_post,$category_count,$user_count,$approved_count,$unapproved_count];

       ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data','Count'],
                
            <?php
                for($i=0;$i<6;$i++)
                    echo "['$element_text[$i]',$element_count[$i]],";
            ?>
            ]);

            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>
        <!--End of column chart-->
        <!--Start of pie chart-->
        <?php
            
        ?>
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Categories', 'No. Of Posts'],
                <?php
                    $query="SELECT count(*) as count_cat,categories.cat_title from posts,categories where posts.post_category_id=categories.cat_id and posts.post_status='published' GROUP BY categories.cat_id";
                    $cResult=mysqli_query($connection,$query);

                    while($row =mysqli_fetch_assoc($cResult)){
                        $cat_title=$row['cat_title'];
                        $count_cat=$row['count_cat'];
                        echo "['$cat_title',$count_cat],";}?>]);

            var options = {
              title: 'My Daily Activities',
              is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
          }
        </script>
        
    <?php
       }
        else if($page=='posts'){
    ?>
            <script src="js/jquery.js"></script>
            <script src="js/plugins/froala/js/froala_editor.pkgd.min.js"></script>
            <script>
                $(function(){
                   $('textarea').froalaEditor() 
                });
            </script>
    <?php
        }
    ?>

</head>