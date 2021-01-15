<?php session_start(); 
   $_SESSION['user_name']= null;
   $_SESSION['user_ad_no']=null;
   $_SESSION['user_id'] =null;
   $_SESSION['user_status']=null;
   header("Location: index.php");
?>