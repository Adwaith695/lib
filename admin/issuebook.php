<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item active">Issue Book</li>
    </ol>
    <div class="col-12 col-sm-6 mt-4">
        <form class="form-inline my-2 my-lg-0" action="" method="POST" id="issueBkID">
            <input class="form-control mr-sm-2" type="search" placeholder="Enter the Book ID " aria-label="Search" name="bookid" id="issbk">
            <input class="form-control mr-sm-2" type="search" placeholder="Student Admission No " aria-label="Search" name="stdid" id="issto">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="issue" > Search </button> 
        </form> 
    </div>
<?php
    if(isset($_POST['issue'])){
        $bookid = $_POST['bookid'];
        $stdid = $_POST['stdid'];
        if(!$bookid || !$stdid){
            echo "<div class='alert alert-danger mt-2'>please select all the options</div>";
        }else{
            $becq= "SELECT * FROM `book`WHERE `book_id`='$bookid' AND `status`= 'Good'";
            $becqc = mysqli_query($connect,$becq);
            $becount = mysqli_num_rows($becqc);
            if($becount>0){
                $bscq="SELECT * FROM `book` WHERE `book_id` = '$bookid' AND `avail`= false";
                $bscqc = mysqli_query($connect,$bscq);
                $bcount =mysqli_num_rows($bscqc);
                if($bcount > 0){
                    echo "<div class='alert alert-danger mt-2'>Please return the book</div>";
                }else{
                    $sscq="SELECT * FROM `user` WHERE `user_ad_no` = $stdid ";
                    $sscqc = mysqli_query($connect,$sscq);
                    $scount =mysqli_num_rows($sscqc);
                    if($scount == 1){
                        $ibcn = "SELECT * FROM `issued` WHERE `ad_no` =$stdid AND `return_date` IS NULL";
                        $ibcnc= mysqli_query($connect,$ibcn);
                        $icount = mysqli_num_rows($ibcnc);
                        if($icount == 2){
                            echo "<div class='alert alert-danger mt-2'>You have already taken 2 book</div>";
                        }else{
                            ?>
                            <div style="overflow-x:auto;">
                                <h4 class="page-header">
                                    Book
                                    </h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>ISBN</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Edition</th>
                                            <th>Availability</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    <?php
                                    $bsq="SELECT * FROM `book` WHERE `book_id` = '$bookid'";
                                    $bsqc = mysqli_query($connect,$bsq);
                                    $bcount =mysqli_num_rows($bsqc);
                                    while($row = mysqli_fetch_assoc($bsqc)){
                                            $book_id =$row['book_id'];
                                            $isbn =$row['isbn'];
                                            $title =$row['title'];
                                            $author =$row['author'];
                                            $edition =$row['edition'];
                                            $avail = $row['avail'];
                                            echo "<tr>";  
                                            echo "<td>{$book_id}</td>";
                                            echo "<td>{$isbn}</td>";
                                            echo "<td>{$title}</td>";
                                            echo "<td>{$author}</td>";
                                            echo "<td>{$edition}</td>";
                                            if($avail == true){
                                                echo "<td><center><i class='fa fa-check fa-lg avail'></i></center></td>";
                                            }else{
                                                echo "<td><center><i class='fa fa-times fa-lg not-avail'></i></center></td>";
                                            }
                                            echo "</tr>";
                                    }   
                                    ?>
                                    </tbody>
                                </table>
                                <h4 class="page-header">
                                    Student
                                    </h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Admission No</th>
                                            <th>Name</th>
                                            <th>Batch</th>
                                            <th>Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    while($row=mysqli_fetch_assoc($sscqc)){
                                        $user_id =$row['user_id'];
                                        $user_ad_no =$row['user_ad_no'];
                                        $user_batch =$row['user_batch'];
                                        $user_course =$row['user_course'];
                                        $user_name =$row['user_name'];

                                        echo "<tr>";  
                                        echo "<td>{$user_ad_no}</td>";
                                        echo "<td>{$user_name}</td>";
                                        echo "<td>{$user_batch}</td>";
                                        echo "<td>{$user_course}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-primary" href="issuebook.php?bkid=<?php echo $book_id; ?>&std_id=<?php echo $user_ad_no; ?>&batch=<?php echo $user_batch; ?>&dept=<?php echo $user_course; ?>">Issue Book</a>
                        <?php 
                        }
                    }else{
                        echo "<div class='alert alert-danger mt-2'>Invalid Student ID</div>";
                    }
                }
            }else{
                echo "<div class='alert alert-danger mt-2'>Invalid Book ID</div>";
            }

        }
    }
    if(isset($_GET['bkid'])){
        $bkid=$_GET['bkid'];
        $std_id=$_GET['std_id'];
        $batch=$_GET['batch'];
        $dept=$_GET['dept'];
        $isbiq= "INSERT INTO `issued`(`book_id`, `ad_no`, `issued_date`,`batch`,`dept`) VALUES ('{$bkid}',{$std_id},now(),'{$batch}','{$dept}')" ;
        $isbiqc = mysqli_query($connect,$isbiq);

        if(!$isbiqc){
            echo "<div class='alert alert-danger mt-2'>Issue failed Try again</div>";
        }else{
            $buvq="UPDATE `book` SET `avail`= false WHERE `book_id` = '$bkid'";
            $buvqc=mysqli_query($connect,$buvq);
            header('Location: issuebook.php');
        } 
    }

?>
</div>
 <?php include 'partials/footer.php'; ?>


 <!-- -->