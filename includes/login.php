<?php
    session_start();
    include_once("db.php");
    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $username=mysqli_real_escape_string($connection,$username);
        $password=mysqli_real_escape_string($connection,$password);
        $db_username="";
        $db_password="";
        $query="SELECT * from users where username='$username'";
        $result=mysqli_query($connection,$query);
        if($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $db_username=$row['username'];
            $db_password=$row['password'];
            $db_role=$row['role'];
        }
        if($username===$db_username && $password===$db_password){
            $_SESSION['user']=$db_username;
            $_SESSION['role']=$db_role;
            $_SESSION['user_id']=$id;
            header("Location: ../admin/");
        }
        else
            header("Location: ../");
    }
?>