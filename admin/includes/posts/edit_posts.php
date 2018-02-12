<?php


    if(isset($_GET['p_id'])){
        $edit_post_id=$_GET['p_id'];
        
        $query="select * from posts where post_id = $edit_post_id";
        $edit_post_query=mysqli_query($connection,$query);
        
        if($row = mysqli_fetch_assoc($edit_post_query)){
            $post_title=$row['post_title'];
            $post_category_id=$row['post_category_id'];
            $post_author=$row['post_author'];
            $post_status=$row['post_status'];
            $post_image=$row['post_image'];
            $post_tags=$row['post_tags'];
            $post_content=$row['post_content'];            
        }
    }

    if(isset($_POST['edit_post'])){
        $id=$_GET['p_id'];
        $user_id=$_SESSION['user_id'];
        $post_title=$_POST['title'];
        $post_status=$_POST['status'];
        $post_category_id=$_POST['category'];
        
        $post_image=$_FILES['image']['name'];
        $post_image_tmp=$_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_tmp,"../images/$post_image");
        if($post_image==null){
            $query="SELECT post_image from posts where post_id=$id";
            $result=mysqli_query($connection,$query);
            $row=mysqli_fetch_row($result);
            $post_image=$row[0];
        }
        
        $post_author=$user_id;
        $post_tags=$_POST['tags'];
        $post_content=$_POST['content'];        
        
        $query="UPDATE posts SET post_category_id=$post_category_id, post_title='$post_title', post_author=$post_author, post_image='$post_image', post_content='$post_content', post_tags='$post_tags', post_status='$post_status' WHERE post_id=$id";
        
        $result=mysqli_query($connection,$query);
        confirmQuery($result);
        header("Location: posts.php");
    }
?>
   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" id="post_title" value="<?php echo $post_title;?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-control" name="category" id="post_category">
        <?php
            $query="SELECT * FROM categories";
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $cat_id=$row['cat_id'];
                $cat_title=$row['cat_title'];
                if($post_category_id==$cat_id)
                    echo "<option value='$cat_id' selected>$cat_title</option>";
                else
                    echo "<option value='$cat_id'>$cat_title</option>";
            }
        ?>    
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="status" id="post_status">
            <option value="draft" <?php if($post_status=="draft") echo "selected"?>>Draft</option>
            <option value="published" <?php if($post_status=="published") echo "selected"?>>Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <?php echo "<img src='../images/$post_image' id='old_photo' height='150px' width='250px' class='img-responsive' value='$post_image'>";?><br>
        <input type="file" class="form-control" name="image" id="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" id="posts_tags" value="<?php echo $post_tags;?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="content" id="post_content" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>
    <div class="form-group">
        <input type='button' data-toggle='modal' data-target="#myPreviewModal<?php echo $id;?>" class="btn btn-success" name="preview" id="preview" value="Preview Post">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>
    
    <div id="myPreviewModal<?php echo $id;?>" class="modal fade" role="dialog">
       <div class="modal-dialog">
            <div class="modal-content" style="padding:20px;">
                <h1 id="title"></h1>
                <p class="lead">by <a href='#' id="author">
                   <?php
                        $user_id=$_SESSION['user_id'];
                        $mQuery="SELECT * from users where id=$user_id";
                        $mResult=mysqli_query($connection,$mQuery);
                        $mRow=mysqli_fetch_assoc($mResult);
                        echo $mRow['first_name']." ".$mRow['last_name'];
                   ?>
                </a></p>
                <hr>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <span id="date"></span></p><hr>
                <img class="img-responsive" src="" id="image" width="250px" height="100px">
                <hr>
                <p id="content"></p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Okay</button> 
                </div>
           </div>
        </div>
    </div>
</form>
<script>
    $('#preview').click(function() {
         /* when the button in the form, display the entered values in the modal */
        $('#title').text($('#post_title').val());
        var modalContent=$('#post_content').val();
        $('#content').text($(modalContent).text());
        
        var value=$('#post_image').val();
        if(value=='')
            var fileName=$('#old_photo').attr('src');
        else
            var fileName=$('#post_image')[0].files[0].name;
            
        $('#image').attr("src","../images/"+fileName);
        var date=new Date();
        var valDate=date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        $('#date').text(valDate);
    });
</script>



