<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>

<div class="container-fluid">
<ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item active">Book History</li>
    </ol>
    <div class="row ">
        <div class="col-12 col-sm-6">
            <form class="form-inline my-2 my-lg-0" action="" method="POST" id="histBkID">
                <input class="form-control mr-sm-2" type="search" placeholder="Enter the Book id " aria-label="Search" name="hisBkId" id="hisbk">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="bookhis"> Search </button> 
            </form> 
        </div>
    </div>
    <?php
    if(isset($_POST['bookhis'])){
            $hisbkid =$_POST['hisBkId'];
            $becq= "SELECT * FROM `book`WHERE `book_id`='$hisbkid'";
            $becqc = mysqli_query($connect,$becq);
            $bcount = mysqli_num_rows($becqc);
            if($bcount == 0){
                echo "<div class='alert alert-danger mt-2'>Please enter the correct book id</div>";
            }else{
        ?>
                <table class="table mt-3">
            <thead class="thead-dark">
        <tr>
            <th scope="col">Issued Id</th>
            <th scope="col">Book ID</th>
            <th scope="col">Student Name</th>
            <th scope="col">Batch</th>
            <th scope="col">Dept</th>
            <th scope="col">Issue Date</th>
            <th scope="col">Return Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $isbhq = "SELECT issued.issued_id,issued.book_id,user.user_name, issued.issued_date, issued.return_date, issued.batch,issued.dept FROM `issued` INNER JOIN `user` ON issued.ad_no=user.user_ad_no";
            $fetch_all_queries =mysqli_query($connect,$isbhq);
            
            while($row = mysqli_fetch_assoc($fetch_all_queries)){
                $issued_id =$row['issued_id'];
                $book_id =$row['book_id'];
                $user_name =$row['user_name'];
                $issued_date =$row['issued_date'];
                $return_date =$row['return_date'];
                $batch =$row['batch'];
                $dept =$row['dept'];
                echo "<tr>";  
                echo "<td>{$issued_id}</td>";
                echo "<td>{$book_id}</td>";
                echo "<td>{$user_name}</td>";
                echo "<td>{$batch}</td>";
                echo "<td>{$dept}</td>";
                echo "<td>{$issued_date}</td>";
                echo "<td>{$return_date}</td>";
                echo "</tr>";
            }
        }
        
    }
    
    ?>

</div>


 <?php include 'partials/footer.php'; ?>