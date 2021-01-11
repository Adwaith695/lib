<?php session_start();?>
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
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <!-- Custom CSS -->
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
                          <label for="email">Email address</label>
                          <input type="email" class="form-control"   placeholder="Enter email" name="email" id="uem">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control"  placeholder="Password" name="password" id="ups">
                        </div>
                        <div class="form-group">
                            <label for="signup">Don't have an account</label>
                            <span><a href="/Register"> signup </a></span>
                          </div>                            
                          <!-- Div removed -->
                        <button type="submit"  class="btn btn-primary btn-block" name="login" >Login</button>
                      </form>
                      
                </div>
            </div>
        </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php 
include '../connection/db.php';
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $email =mysqli_real_escape_string($connect,$email);
    $password =mysqli_real_escape_string($connect,$password);

    $query ="SELECT * FROM `admin` WHERE `admin_email`='$email' AND `admin_password` = '$password'";

    $select_user = mysqli_query($connect,$query);
    $count = mysqli_num_rows($select_user);  
    while($row = mysqli_fetch_assoc($select_user)){
        
        $admin_name=$row['admin_name'];
        $admin_email =$row['admin_email'];
        $admin_pass = $row['admin_password'];
        $admin_id=$row['id'];

    }
    
    if($count == 1){
        if($email === $admin_email && $password === $admin_pass){
            $_SESSION['admin_name'] =$admin_name;
            $_SESSION['admin_email'] =$admin_email;
            $_SESSION['admin_id']=$admin_id;
            header("Location: index.php");
        }
    }else{
        echo 'Wrong Username or Password';
    }
}

?>