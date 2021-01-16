<!DOCTYPE html>
<html lang="en">
<?php include 'connection/db.php';
session_start();
if(isset($_SESSION['user_id'])){
    header('Location: index.php');
}
?>
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
     
 <link href="css/register.css" rel="stylesheet">  
</head>
<body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-3">
                    <form class="form-container" method="POST" action="" >
                      <div class="form-group">
                         <h3><center>Sign Up</center></h3>
                      </div>
                      <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control"  placeholder="Enter Name" name="name" id="unam">
                        
                      </div>
                        <div class="form-group">
                          <label for="text">Admisson number</label>
                          <input type="number" class="form-control"  placeholder="Enter Admission Number" name="adm_no" id="ruem">
                        </div>
                        
                        <div class="form-group">
                        <label for="email">Choose Batch</label>
                            <select name="batch" class="form-control">
                            <option >Choose Batch</option>
                        <?php
                            $batch_query= "SELECT * FROM `batch`";
                            $batch_fetch = mysqli_query($connect,$batch_query);
                            while($row=mysqli_fetch_assoc($batch_fetch)){

                                echo "<option value='{$row['batch']}'>{$row['batch']}</option>";
                            }

                        ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="email">Choose Course</label>
                            <select name="dept" class="form-control">
                            <option >Choose Course</option>
                        <?php 
                            $batch_query= "SELECT * FROM `dept`";
                            $batch_fetch = mysqli_query($connect,$batch_query);
                            
                            while($row=mysqli_fetch_assoc($batch_fetch)){
                                $dept_fetch = $row['dept'];
                                echo "<option value='{$dept_fetch}'>{$dept_fetch}</option>";
                            }

                        ?>    
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control"   placeholder="Password" name="password" id="rups">
                        </div>
                        <div class="form-group">
                          <label for="confirmPassword">Confirm Password</label>
                          <input type="password" class="form-control"   placeholder="Confirm Password" name="confirmPassword" id="cpas">
                        </div>
                        <div class="form-group">
                            <label for="signup">Have an account</label>
                            <span><a href="Login.php"> signin </a></span>
                          </div>
                        <button type="submit" name="user_reg" class="btn btn-primary btn-block" >Submit</button>
                      </form>
 <?php 

if(isset($_POST['user_reg'])){
    $adm_no=$_POST['adm_no'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $name=$_POST['name'];
    $batch=$_POST['batch'];
    $dept=$_POST['dept'];
    if(!$adm_no || !$password || !$confirmPassword || !$name || $batch==""  || $dept ==""){
        echo '<div class="alert alert-danger">Please fill all the fields</div>';
    }else{
        if($password != $confirmPassword){
            echo '<div class="alert alert-danger">Password does not match</div>';
        }else{
            $query ="SELECT * FROM `user` WHERE `user_ad_no`='$adm_no'";
            $select_user = mysqli_query($connect,$query);
            $count = mysqli_num_rows($select_user);  
            if($count == 1){
                echo '<div class="alert alert-danger">User Already Exist</div>';
            }else{
                $reg_query ="INSERT INTO `user`(`user_ad_no`, `user_name`, `user_pass`, `user_course`, `user_batch`) VALUES ({$adm_no},'{$name}','{$password}','{$dept}','{$batch}')";
                $register = mysqli_query($connect,$reg_query);
                if(!$register){
                    die("query Failed".mysqli_error());
                    echo "<div class='alert alert-danger'>Failed to register</div>";
                }else{
                    header('Location: index.php');
                }

            }
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
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
</body>
</html>