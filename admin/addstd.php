<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>
<div class="container-fluid">
<table class="table mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Student Id</th>
        <th scope="col">Admission no</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Batch</th>
        <th scope="col">Status</th>
        <th scope="col">Approve</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $vstd = "SELECT * FROM `user` WHERE `user_status` = 'waiting'";
    $fetch_all_queries =mysqli_query($connect,$vstd);
    
    while($row = mysqli_fetch_assoc($fetch_all_queries)){
        $user_id =$row['user_id'];
        $user_ad_no =$row['user_ad_no'];
        $user_name =$row['user_name'];
        $user_dept =$row['user_course'];
        $user_batch =$row['user_batch'];
        $user_status =$row['user_status'];
        echo "<tr>";  
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_ad_no}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_dept}</td>";
        echo "<td>{$user_batch}</td>";
        echo "<td>{$user_status}</td>";
        echo "<td><a href='addstd.php?app={$user_ad_no}' class='btn btn-info'>Approve</a></td>";
    }
    if(isset($_GET['app'])){
        $adm_no = $_GET['app'];
        $q= "UPDATE `user` SET `user_status`='approved' WHERE `user_ad_no`= $adm_no";
        $upap = mysqli_query($connect,$q);
        if(!$upap){
            echo "<div class='alert alert-danger'>Approval failed</div>";
        }else{
            header('Location:addstd.php');
        }
    }

    ?>
    
    </tbody>
</table>
</div>




 <?php include 'partials/footer.php'; ?>