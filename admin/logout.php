<?php session_start(); 
   $_SESSION['admin_name'] =null;
   $_SESSION['admin_email'] =null;
   $_SESSION['admin_id']=null;
    header("Location: ../index.php");
?>