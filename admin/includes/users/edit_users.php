<?php

    if(isset($_GET['e_id'])){
        $edit_post_id=$_GET['e_id'];
        $query="select * from users where id = $edit_post_id";
        $edit_post_query=mysqli_query($connection,$query);
        
        if($row = mysqli_fetch_assoc($edit_post_query)){
            $id=$row['id'];
            $username=$row['username'];
            $first_name=$row['first_name'];
            $last_name=$row['last_name'];
            $image=$row['image'];
            $email=$row['email'];           
        }
    }

    if(isset($_POST['edit_user'])){
        $id=$_GET['e_id'];
        $username=$_POST['username'];
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp,"images/users/$image");
        if($image==null){
            $query="SELECT image from users where id=$id";
            $result=mysqli_query($connection,$query);
            $row=mysqli_fetch_row($result);
            $image=$row[0];
        }
        $only_password=$_POST['only_password'];
        $new_password=$_POST['new_password'];
        $old_password=$_POST['old_password'];
        $pQuery="SELECT password from users where id=$id";
        $pResult=mysqli_query($connection,$pQuery);
        $pRow=mysqli_fetch_row($pResult);
        $old_DB_password=$pRow[0];
        if(empty($only_password) || $only_password=="")
        {            
            if((!empty($new_password) || !empty($old_password)) || ($old_password!="" ||$new_password!="")){
                 if($old_password === $old_DB_password){
                     $query="UPDATE users SET first_name='$first_name',last_name='$last_name',email='$email',username='$username',image='$image',password='$new_password' WHERE id=$id";

                     $result=mysqli_query($connection,$query);
                     header("Location: users.php");
                 }   
                 else
                     echo "Passwords do not match!";
            }
            else
                echo "Enter the password first!";
            
        }
        else if($only_password === $old_DB_password)
        {
            $query="UPDATE users SET first_name='$first_name',last_name='$last_name',email='$email',username='$username',image='$image' WHERE id=$id";

            $result=mysqli_query($connection,$query);
            confirmQuery($result);
            header("Location: users.php");
        }
        else
            echo "Passwords do not match!";
    }
?>
   
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" value="<?php echo $first_name;?>" class="form-control" name="first_name" id="first_name">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" value="<?php echo $last_name;?>" class="form-control" name="last_name" id="last_name">
    </div>
    
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" value="<?php echo $username;?>" class="form-control" name="username" id="username">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="<?php echo $email;?>" id="email" name="email" class="form-control">
    </div>
    
    <div id="only_password" class="form-group">
        <label for="only_password">Password</label>
        <input type="password" value="" class="form-control" name="only_password" id="only_password">
        <a href="javascript:changePassword()">Change Password</a>
    </div>
    
    <div id="old_password" class="form-group" style="display:none;">
        <label>Old Password</label>
        <input type="password" class="form-control" name="old_password" id="old_password">

    </div>
    <div id="new_password" class="form-group" style="display:none;">
        <label>New Password</label>
        <input type="password" class="form-control" name="new_password" id="new_password">
    </div>
    
    <div class="form-group">
        <label for="image">Image</label>
        <img class="img-responsive" src="images/users/<?php echo $image;?>" height="70px" width="120px">
        <input type="file" class="form-control" name="image" id="image">
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>
<script>
    function changePassword(){
        var div1=document.getElementById('only_password');
        var div2=document.getElementById('old_password');
        var div3=document.getElementById('new_password');
        div1.style.display='none';
        div2.style.display='block';
        div3.style.display='block';
    }
</script>