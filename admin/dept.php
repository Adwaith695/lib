<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>
<br>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Batch</li>
        </ol>
    </div>
    <div class="col-md-6">        
        <form action="" method="POST">
            <div class="form-group">
                <label for="Brand">Department  </label>
                <input type="text" class="form-control" name="dept">
            </div>
            <div class="form-group">
               <button class="btn btn-primary my-2 my-sm-0" type="submit" name="adddept"> Add Dept </button>
            </div>
        </form>
        <?php 
            if(isset($_POST['adddept'])){
                $deptlower =$_POST['dept'];
                $dep = strtoupper($deptlower);
                if(!$dep){
                    echo "<div class='alert alert-danger'>Please Enter the dept</div>";
                }else{
                    $cde = "SELECT * FROM `dept` WHERE `dept` = '$dep'";
                    $cdef = mysqli_query($connect,$cde);
                    $count = mysqli_num_rows($cdef);
                    if($count > 0){
                        echo "<div class='alert alert-danger'>Department already exist</div>";
                    }else{
                        $idq = "INSERT INTO `batch`(`batch`) VALUES ('{$dep}')";
                        $idqc = mysqli_query($connect,$ibq);
                        if(!$idqc){
                            echo "<div class='alert alert-danger'>Department adding failed</div>";
                        }else{
                            header('Location:dept.php');
                        }
                    }
                }
            }
        ?>
   </div>
   <div class="col-md-6">        
       <h4>Batchs</h4>
       <hr>
       <table class="table table-bordered table-hover">
            <thead>
                <th>Department</th>
                <th>Delete</th>
            </thead>
           <tbody>
           <?php 

                $dept_query = "SELECT * FROM `dept` WHERE 1";
                $dept_fetch = mysqli_query($connect,$dept_query);
                if($dept_fetch){
                    while($row = mysqli_fetch_assoc($dept_fetch)){
                        $dept = $row['dept'];
                        $dept_id= $row['dept_id'];
                        echo "<tr>";
                        echo  "<td>{$dept}</td>";
                        echo  "<td><a href='dept.php?del_d_id={$dept_id}'>Delete</a></td>";
                    }
                }
            ?>
                
                    
                
           </tbody>
       </table>
       
   </div>
   
</div>
<?php 
if(isset($_GET['del_d_id'])){
    $d_id = $_GET['del_d_id'];
    $q = "SELECT * FROM `dept` WHERE `dept_id`='$d_id' ";
    $sq = mysqli_query($connect,$q);
    if($sq){
        while($row = mysqli_fetch_assoc($sq)){
            $dept = $row['dept'];
        }
        $stdq = "SELECT * FROM `user` WHERE `user_course` = '$dept'";
        $sstd = mysqli_query($connect,$stdq);
        $count = mysqli_num_rows($sstd);  
        if($count > 0){
            echo "<div class='alert alert-danger'>Please delete students first </div>";
        }else{
            $delq = "DELETE FROM `dept` WHERE `dept_id` ='$d_id'";
            $del=mysqli_query($connect,$delq);
            if(!$del){
                echo "<div class='alert alert-danger'>Deletion Failed Please try again </div>";
            }else{
                header('Location: dept.php');
            }
        }
    }
}


?>
</div>


     




<?php include 'partials/footer.php' ;?>