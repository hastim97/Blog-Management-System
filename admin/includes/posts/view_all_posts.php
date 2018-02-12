<?php
    if(isset($_POST['checkBoxArray'])){
        $bulk_options=$_POST['bulk_options'];
        foreach($_POST['checkBoxArray'] as $i){
            switch($bulk_options){
                case 'published':
                case 'draft';
                    $query="UPDATE posts SET post_status='$bulk_options' where post_id=$i";
                    $result=mysqli_query($connection,$query);
                    header("Location: posts.php");
                    break;
                case 'delete':
                    $query="DELETE FROM posts where post_id=$i";
                    $result=mysqli_query($connection,$query);
                    header("Location: posts.php");
                    break;
            }
        }
    }
?>
<!--View all posts-->

<div class="col-xs-12">
   <form action="" method="post">
    <table class="table table-bordered">
       <div class="col-xs-4" id="bulk_options_container">
           <select class="form-control" name="bulk_options">
               <option value="">Select Option</option>
               <option value="published">Publish</option>
               <option value="draft">Draft</option>
               <option value="delete">Delete</option>
           </select>
       </div>
       <div class="col-xs-4">
           <input type="submit" name="submit_bulk_options" class="btn btn-primary" value="Apply">
           <a href="posts.php?source=add_posts" class="btn btn-success">Add New Post</a>
       </div>
        <tr>
            <th><input type="checkbox" id="select_all_boxes" class="form-control"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th></th>
            <th></th>
            
        </tr>
        <tbody>
        <?php   
            $role=$_SESSION['role'];
            if($role=='admin'){
                $query="SELECT * FROM posts,users where posts.post_author=users.id ORDER BY posts.post_id DESC";
            }
            else{
                $id=$_SESSION['user_id'];
                $query="SELECT * FROM posts,users where posts.post_author=users.id and posts.post_author=$id ORDER BY posts.post_id DESC";
            }
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                $post_author=$row['first_name'];
                $post_category_id=$row['post_category_id'];
                $post_date=$row['post_date'];
                $post_image=$row['post_image'];
                $post_tags=$row['post_tags'];
                
                $post_comment_count=$row['post_comment_count'];
                $post_status=$row['post_status'];
                echo "<tr>";
                echo "<td><input class='checkBoxes' name='checkBoxArray[]' type='checkbox' value='$post_id'></td>";
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";
                
                $cQuery="SELECT cat_title from categories where cat_id=$post_category_id";
                $cResult=mysqli_query($connection,$cQuery);
                $cRow=mysqli_fetch_row($cResult);
                $post_category_title=$cRow[0];
                echo "<td>$post_category_title</td>";
                
                
                echo "<td>$post_status</td>";
                echo "<td><img src='../images/$post_image' height='70px' width='120px'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a class='btn btn-danger' data-toggle='modal' data-target='#myModal$post_id'>&times; Delete</a></td>";
                echo "<td><a class='btn btn-primary' href='posts.php?source=edit_posts&p_id=$post_id'><span class='fa fa-pencil'</span> Edit</a></td>";
                
                echo "</tr>";
            ?>
                <div id="myModal<?php echo $post_id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Are you sure you want to delete this data?</h4>
                            </div>
                           <div class="modal-footer">
                              <a href="posts.php?delete=<?php echo $post_id;?>" type="button" class="btn btn-success">Yes</a>
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
   </form>
    <?php
    if(isset($_GET['delete'])){
        $delete_post_id=$_GET['delete'];
        $query = "delete from posts where post_id=$delete_post_id";
        $delete_query=mysqli_query($connection,$query);
        header("Location: posts.php");
    }
    ?>
</div>
<!--End view all posts-->