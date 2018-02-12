<!--View all posts-->

<div class="col-xs-12">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
            
        </tr>
        <tbody>
        <?php    
            if($role=='admin'){
                $query="SELECT * FROM comments";
            }
            else{
                $id=$_SESSION['user_id'];
                $query="SELECT * from comments,posts where comments.comment_post_id=posts.post_id and posts.post_author=$id";
            }
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $comment_id=$row['comment_id'];
                $comment_post_id=$row['comment_post_id'];
                $comment_author=$row['comment_author'];
                $comment_email=$row['comment_email'];
                $comment_content=$row['comment_content'];
                $comment_status=$row['comment_status'];
                $comment_date=$row['comment_date'];
                
                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_status</td>";
                
                $pQuery="SELECT * from posts where post_id=$comment_post_id";
                $pResult=mysqli_query($connection,$pQuery);
                if($pRow=mysqli_fetch_assoc($pResult)){
                    $comment_title=$pRow['post_title'];
                    echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_title</a></td>";
                }
                echo "<td>$comment_date</td>";
                
                echo "<td><a class='btn btn-success' href='comments.php?approve=$comment_id'><span class='fa fa-check'></a></td>";
                echo "<td><a class='btn btn-warning' href='comments.php?unapprove=$comment_id'><span class='fa fa-remove'></a></td>";
                echo "<td><a class='btn btn-danger' data-toggle='modal' data-target='#myModal$comment_id' ><span class='fa fa-trash'></a></td>";
                
                echo "</tr>";
            ?>
               
                <div id="myModal<?php echo $comment_id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Are you sure you want to delete this data?</h4>
                            </div>
                           <div class="modal-footer">
                              <a href="comments.php?delete=<?php echo $comment_id;?>" type="button" class="btn btn-success">Yes</a>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>                   
                          </div>
                       </div>
                   </div>
                </div>
            <?php
            }
        ?>
        </tbody>
    </table>
    <?php
        
        if(isset($_GET['approve'])){
            $approve_comment_id=$_GET['approve'];
            $query = "UPDATE comments SET comment_status='approved' where comment_id=$approve_comment_id";
            $result=mysqli_query($connection,$query);
            
            header("Location: comments.php");
        }
        
        if(isset($_GET['unapprove'])){
            $unapprove_comment_id=$_GET['unapprove'];
            $query = "UPDATE comments SET comment_status='unapproved' where comment_id=$unapprove_comment_id";
            $result=mysqli_query($connection,$query);
            header("Location: comments.php");
        }
    
    
        if(isset($_GET['delete'])){
            $delete_comment_id=$_GET['delete'];
            $query="UPDATE posts SET post_comment_count=post_comment_count-1 WHERE post_id=(SELECT comment_post_id from comments WHERE comment_id=$delete_comment_id)";
            $result=mysqli_query($connection,$query);
            
            $query = "delete from comments where comment_id=$delete_comment_id";
            $delete_query=mysqli_query($connection,$query);
            header("Location: comments.php");
        }
    ?>
</div>
<!--End view all posts-->