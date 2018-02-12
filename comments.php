<!-- Posted Comments -->
<?php
    ob_start();
    if(isset($_POST['create_comment'])){
        $comment_post_id=$_GET['p_id'];
        $comment_author=$_POST['comment_author'];
        $comment_email=$_POST['comment_email'];
        $comment_content=$_POST['comment_content'];
        $query="INSERT INTO comments (comment_post_id,comment_email,comment_author,comment_content,comment_status,comment_date) VALUES ($comment_post_id,'$comment_email','$comment_author','$comment_content','unapproved',now())";
        $result=mysqli_query($connection,$query);
        if(!$result){
            die(mysqli_error($connection));
        }
        
        $query="UPDATE posts SET post_comment_count=post_comment_count+1 where post_id=$comment_post_id";
        $result=mysqli_query($connection,$query);
        header("Location: post.php?p_id=".$comment_post_id);
    }
    
?>

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="" method="post">
       <div class="form-group">
           <label for="author">Author</label>
           <input type="text" name="comment_author" class="form-control" id="author">
       </div>
       
       <div class="form-group">
           <label for="comment_email">Email</label>
           <input type="text" name="comment_email" class="form-control" id="email">
       </div>
       
        <div class="form-group">
            <label for="comment_content">Your Comment</label>
            <textarea id="comment" class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>
</div>
<hr>
<!--End of comments form-->
<?php
    $comment_post_id=$_GET['p_id'];
    $query="SELECT * from comments where comment_post_id=$comment_post_id and comment_status='approved'";
    $result=mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($result)){
        $comment_author=$row['comment_author'];
        $comment_date=$row['comment_date'];
        $comment_content=$row['comment_content'];
    
?>
    <!-- Comment-->
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author; ?>
                <small><?php echo $comment_date;?></small>
            </h4>
            <?php echo $comment_content;?>
        </div>
    </div>

<?php
    }
?>
<!--End of comment-->