<?php 

    function checkUser(){
        if(!isset($_SESSION['user'])){
            die("<p style='color:white'>You havent logged in! Click <a href='../index.php'>here </a>to log in!</p>");
        }
        else{
            $username=$_SESSION['user'];
            return $username;
        }
    }
    function editCategory(){
        global $connection;
        if(isset($_POST['edit'])){
                                    
            $input_cat_title=$_POST['cat_title'];
            $input_cat_id=$_GET['edit'];
            if(empty($input_cat_title) || $input_cat_title==""){
                echo "Please insert Category title";
            }
            else{
                $edit_query="UPDATE categories SET cat_title='$input_cat_title' where cat_id=$input_cat_id";
                $edit_cat_query=mysqli_query($connection,$edit_query);

                if(!$edit_cat_query){
                    die("INSERTION FAILED ".mysqli_error($connection));
                } 
                header("Location: categories.php");
            }
        }
    }

    function addCategory(){
        global $connection;
        if(isset($_POST['submit'])){
                                    
            $input_cat_title=$_POST['cat_title'];

            if(empty($input_cat_title) || $input_cat_title==""){
                echo "Please insert Category title";
            }
            else{
                $hQuery="Select cat_title from categories where cat_title='$input_cat_title'";
                $hResult=mysqli_query($connection,$hQuery);
                if(mysqli_num_rows($hResult)>=1)
                    echo "Category already exists";
                else
                {
                    $add_query='INSERT INTO categories (cat_title) VALUE("'.$input_cat_title.'")';
                    $add_cat_query=mysqli_query($connection,$add_query);

                    if(!$add_cat_query){
                        die("INSERTION FAILED ".mysqli_error($connection));
                    } 
                    header("Location: categories.php");
                }
            }
        }
    }

    function fetchCategory(){
        //Used for fetching the category title
        global $connection;
        if(isset($_GET['edit'])){
            $eId=$_GET['edit'];
            $eQuery="SELECT cat_title FROM categories where cat_id=$eId";
            $eResult=mysqli_query($connection,$eQuery);
            $eRow=mysqli_fetch_row($eResult);
            $edit_title=$eRow[0];
            return $edit_title;
        }
    }

    function confirmQuery($result){
        global $connection;
        if(!$result){
            die("QUERY FAILED ".mysqli_error($connection));
        }
    }
?>