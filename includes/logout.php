<?php
    session_start();

    $_SESSION['user']=null;
    $_SESSION['role']=null;
    $_SESSION['user_id']=null;
    header("Location: ../index.php");
?>