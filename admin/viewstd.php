<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>

<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
         <li class="breadcrumb-item active">View Books</li>
     </ol>
    <div class="row">
        <div class="col-12 col-sm-6"> 
            <form class="form-inline my-2 my-lg-0 ml-2" action="" method="POST" id='batch-view'>
                <select name="batch" id="viewSel" class="form-control">
                    <option value="">Choose Batch</option>
                    <?php 
                    $batch_query= "SELECT * FROM `batch`";
                    $batch_fetch = mysqli_query($connect,$batch_query);
                    while($row=mysqli_fetch_assoc($batch_fetch)){
                       ?> <option value="<?php echo $row['batch'];?>"><?php echo $row['batch'];?></option><?php 
                    }
                    
                    ?>
                </select>
                <select name="dept" id="viewSel" class="form-control">
                    <option value="">Choose Department</option>
                    <?php 
                    $dept_query= "SELECT * FROM `dept`";
                    $dept_fetch = mysqli_query($connect,$dept_query);
                    while($row=mysqli_fetch_assoc($dept_fetch)){
                       ?> <option value="<?php echo $row['dept'];?>"><?php echo $row['dept'];?></option><?php 
                    }
                    
                    ?>
                </select>
               <button class="btn btn-primary ml-2 my-2 my-sm-0" type="submit" name="viewbatch" >Show</button> 
             </form>
             
        </div>
    </div>
<?php 
if(isset($_POST['viewbatch'])){
  $batch = $_POST['batch'];
  $dept =$_POST['dept'];
  if($batch =="" || $dept == ""){
    echo "<div class='alert alert-danger mt-2'>please select all the options</div>";
  }else{
      ?>
    <table class="table mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Student Id</th>
        <th scope="col">Admission no</th>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $vstd = "SELECT * FROM `user` WHERE `user_batch`='$batch' AND `user_course`='$dept'";
    $fetch_all_queries =mysqli_query($connect,$vstd);
    
    while($row = mysqli_fetch_assoc($fetch_all_queries)){
        $user_id =$row['user_id'];
        $user_ad_no =$row['user_ad_no'];
        $user_name =$row['user_name'];
        $user_status =$row['user_status'];
        echo "<tr>";  
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_ad_no}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_status}</td>";
        echo "<td><a href='viewstd.php?del_std_id={$user_ad_no}'>Delete</a></td>";
        echo "<td><a href='editstd.php?ed_std_id={$user_id}'>Edit</a></td>";//pending
    }
  }
  
  
}

if(isset($_GET['del_std_id'])){
    $adm_no=$_GET['del_std_id'];
    $issue_query_check = "SELECT * FROM `issued` WHERE `ad_no`= '$adm_no' AND `return_date` = NULL";
    $select_issue_check_query = mysqli_query($connect,$issue_query_check);
    $count = mysqli_num_rows($select_issue_check_query);
    if($count > 0){
        echo "<div class='alert alert-danger'>Book not returned</div>";
    }else{
        $del_std = "DELETE FROM `user` WHERE `user_ad_no`= '$adm_no'";
        $del_q = mysqli_query($connect,$del_std);
        if(!$del_q){
            echo "<div class='alert alert-danger mt-3'>Failed to detete</div>";
        }else{
            header('Location: viewstd.php');
        }
    }
}
?>  
  </tbody>
</table>
        

</div>



<?php include 'partials/footer.php' ;?>