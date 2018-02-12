<?php
    include_once('functions.php');
    if(isset($_POST['create_user'])){
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $role=$_POST['role'];
        if($role=="" || !isset($role))
            $role="subscriber"; 
        $username=$_POST['username'];
        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $password=$_POST['password'];
        $c_password=$_POST['c_password'];
        if($password===$c_password){
            move_uploaded_file($image_tmp,"images/users/$image");
            $query="INSERT into users (username,first_name,last_name,email,image,role,password) VALUES ('$username','$first_name','$last_name','$email','$image','$role','$password')";
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
        <input type="text" class="form-control" name="first_name" id="first_name">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name">
    </div>
    
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_status">Role</label>
        <select class="form-control" name="role">
            <option value="admin">Admin</option>
            <option value="subscriber" selected>Subscriber</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    
    <div class="form-group">
        <label for="c_password">Confirm Password</label>
        <input type="password" class="form-control" name="c_password" id="c_password">
    </div>
    
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
