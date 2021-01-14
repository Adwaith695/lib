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
                <label for="Brand">Batch  </label>
                <input type="text" class="form-control" name="batch">
            </div>
            <div class="form-group">
               <button class="btn btn-primary my-2 my-sm-0" type="submit" name="addbatch"> Add Batch </button>
            </div>
        </form>
        <?php 
            if(isset($_POST['addbatch'])){
                $bat = $_POST['batch'];
                if(!$bat){
                    echo "<div class='alert alert-danger'>Please Enter the batch</div>";
                }else{
                    $cbe = "SELECT * FROM `batch` WHERE `batch` = '$bat'";
                    $cbef = mysqli_query($connect,$cbe);
                    $count = mysqli_num_rows($cbef);
                    if($count > 0){
                        echo "<div class='alert alert-danger'>Batch already exist</div>";
                    }else{
                        $ibq = "INSERT INTO `batch`(`batch`) VALUES ('{$bat}')";
                        $ibqc = mysqli_query($connect,$ibq);
                        if(!$ibqc){
                            echo "<div class='alert alert-danger'>Batch adding failed</div>";
                        }else{
                            header('Location:batch.php');
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
                <th>Batch</th>
                <th>Delete</th>
            </thead>
           <tbody>
           <?php 

                $batch_query = "SELECT * FROM `batch`WHERE 1";
                $batch_fetch = mysqli_query($connect,$batch_query);
                if($batch_fetch){
                    while($row = mysqli_fetch_assoc($batch_fetch)){
                        $batch = $row['batch'];
                        $batch_id= $row['batch_id'];
                        echo "<tr>";
                        echo  "<td>{$batch}</td>";
                        echo  "<td><a href='batch.php?del_b_id={$batch_id}'>Delete</a></td>";
                    }
                }
            ?>
                
                    
                
           </tbody>
       </table>
       
   </div>
   
</div>
<?php 
if(isset($_GET['del_b_id'])){
    $b_id = $_GET['del_b_id'];
    $q = "SELECT * FROM `batch` WHERE `batch_id`='$b_id' ";
    $sq = mysqli_query($connect,$q);
    if($sq){
        while($row = mysqli_fetch_assoc($sq)){
            $batch = $row['batch'];
        }
        $stdq = "SELECT * FROM `user` WHERE `user_batch` = '$batch'";
        $sstd = mysqli_query($connect,$stdq);
        $count = mysqli_num_rows($sstd);  
        if($count > 0){
            echo "<div class='alert alert-danger'>Please delete students first </div>";
        }else{
            $delq = "DELETE FROM `batch` WHERE `batch_id` ='$b_id'";
            $del=mysqli_query($connect,$delq);
        }
    }
}


?>
</div>


     




<?php include 'partials/footer.php' ;?>