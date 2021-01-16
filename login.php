<?php session_start();
if(isset($_SESSION['user_id'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MLIB</title>
    <!-- Custom Fonts -->
    <!-- <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <
 <link href="css/login.css" rel="stylesheet">  
</head>
<body>
    
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-3">
                    <form class="form-container" method="POST" action="" id="login-user"> 
                      <div class="form-group">
                         <h3><center> Login </center></h3>
                      </div>
                        <div class="form-group">
                          <label for="text">Admission Number</label>
                          <input type="text" class="form-control"   placeholder="Enter Number" name="adm_no" id="uem">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control"  placeholder="Password" name="password" id="ups">
                        </div>
                        <div class="form-group">
                            <label for="signup">Don't have an account</label>
                            <span><a href="register.php"> signup </a></span>
                        </div>                            
                        <div class="form-group">
                            <span><a href="index.php" class="btn btn-info"> HOME </a></span>
                        </div>                            
                          <!-- Div removed -->
                        <button type="submit"  class="btn btn-primary btn-block" name="login" >Login</button>
                      </form>
                      <?php 
include 'connection/db.php';
if(isset($_POST['login'])){
    $adm_no=$_POST['adm_no'];
    $password=$_POST['password'];
    if(!$adm_no || !$password){
        echo '<div class="alert alert-danger">Please fill all the fields</div>';
    }else{
        $query ="SELECT * FROM `user` WHERE `user_ad_no`='$adm_no' AND `user_pass` = '$password'";

        $select_user = mysqli_query($connect,$query);
        $count = mysqli_num_rows($select_user);  
        
        if($count == 1){
            while($row = mysqli_fetch_assoc($select_user)){
                $user_name = $row['user_name'];
                $user_ad_no=$row['user_ad_no'];
                $user_pass =$row['user_pass'];
                $user_id=$row['user_id'];
                $user_batch=$row['user_batch'];
                $user_dept = $row['user_course'];
                $user_status = $row['user_status'];
            }
            if($adm_no === $user_ad_no && $password === $user_pass){
                if($user_status == 'approved'){
                    $_SESSION['user_name']= $user_name;
                    $_SESSION['user_ad_no']= $user_ad_no;
                    $_SESSION['user_id'] =$user_id;
                    $_SESSION['user_status']=$user_status;
                    header("Location: index.php");
                }else{
                    echo '<div class="alert alert-info mt-3">Please wait for the approval</div>';
                }
            }else{
                echo '<div class="alert alert-danger">Wrong Username or Password ---</div>';
            }
        }else{
            echo '<div class="alert alert-danger">Wrong Username or Password</div>';
        }
    }
}

?>
                </div>
            </div>
        </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="/js/bootstrap.min.js"></script> -->
    <script src="js/scripts.js"></script>
</body>
</html>
