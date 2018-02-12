<?php
    include_once('functions.php');
    if(isset($_POST['create_post'])){
        $post_title=$_POST['title'];
        
        $post_status=$_POST['status'];
        $post_category_id=$_POST['category'];
        
        $post_image=$_FILES['image']['name'];
        $post_image_tmp=$_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_tmp,"../images/$post_image");
        
        $post_tags=$_POST['tags'];
        $post_content=$_POST['content'];
        //$post_content=strip_tags($post_content);
        $post_comment_count=0;
        
        $post_author=$_SESSION['user_id'];
        $query="INSERT into posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) VALUES($post_category_id,'$post_title','$post_author',now(),'$post_image','$post_content','$post_tags',$post_comment_count,'$post_status')";
        
        $result=mysqli_query($connection,$query);
        confirmQuery($result);      
    }
?>
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" id="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-control" name="category">
            <?php
                $cQuery="SELECT * from categories";
                $cResult=mysqli_query($connection,$cQuery);
                while($cRow=mysqli_fetch_assoc($cResult)){
                    $id=$cRow['cat_id'];
                    $title=$cRow['cat_title'];
                    echo "<option value=$id>$title</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="status">
            <option value="draft" selected>Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image" id="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" id="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="content" id="post_content" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
