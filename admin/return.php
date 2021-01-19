<?php ob_start(); 
 include 'partials/session.php';
 include 'partials/header.php';
 include 'partials/nav.php';
 include 'partials/sidenav.php'; 
include '../connection/db.php';
 ?>
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item active">Return A Book</li>
    </ol>
    <div class="col-12 col-sm-6 mt-4">
        <form class="form-inline my-2 my-lg-0" action="" method="POST" id="issueBkID">
            <input class="form-control mr-sm-2" type="search" placeholder="Enter the Book Id" aria-label="Search" name="bookid" id="issbk">
            <input class="form-control mr-sm-2" type="search" placeholder="Student Admission No " aria-label="Search" name="stdid" id="issto">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="return" > Search </button> 
        </form> 
    </div>
<?php
    if(isset($_POST['return'])){
        $bookid = $_POST['bookid'];
        $stdid = $_POST['stdid'];
        if(!$bookid || !$stdid){
            echo "<div class='alert alert-danger mt-2'>please select all the options</div>";
        }else{
            $becq= "SELECT * FROM `book`WHERE `book_id`='$bookid'";
            $becqc = mysqli_query($connect,$becq);
            $becount = mysqli_num_rows($becqc);
            if($becount > 0){
                $bscq="SELECT * FROM `book` WHERE `book_id` = '$bookid' AND `avail`= true";
                $bscqc = mysqli_query($connect,$bscq);
                $bcount =mysqli_num_rows($bscqc);
                if($bcount > 0){
                    echo "<div class='alert alert-danger mt-2'>Issue Book First</div>";
                }else{
                    $sscq="SELECT * FROM `user` WHERE `user_ad_no` = $stdid ";
                    $sscqc = mysqli_query($connect,$sscq);
                    $scount =mysqli_num_rows($sscqc);
                    if($scount == 1){
                        $ibcn = "SELECT * FROM `issued` WHERE `ad_no` =$stdid AND `book_id`= '$bookid' AND `return_date` IS NULL";
                        $ibcnc= mysqli_query($connect,$ibcn);
                        if(!$ibcnc){
                            echo "<div class='alert alert-danger mt-2'>Connection Failed</div>";
                        }else{
                            ?>
                            <div style="overflow-x:auto;">
                                <h5 class="page-header">
                                    Book
                                    </h5>
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
                                    $bsq="SELECT * FROM `book` WHERE `book_id` = $bookid";
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
                                <h5 class="page-header">
                                    Student
                                    </h5>
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
                                <h5 class="page-header">
                                    Issue Details
                                    </h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Issue Id</th>
                                            <th>Book Id</th>
                                            <th>Admission No</th>
                                            <th>Issue Date</th>
                                            <th>Batch</th>
                                            <th>Fine</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    while($row=mysqli_fetch_assoc($ibcnc)){
                                        $issued_id =$row['issued_id'];
                                        $book_id =$row['book_id'];
                                        $ad_no =$row['ad_no'];
                                        $issued_date =$row['issued_date'];
                                        $expected_date = date('Y-m-d', strtotime($issued_date. ' + 14 days'));
                                        $now =date("Y-m-d");
                                        $start = strtotime($expected_date);
                                        $end = strtotime($now);
                                        $diffInSeconds = $end - $start;
                                        $diffInDays = $diffInSeconds / 86400;
                                        if($diffInDays > 0){
                                            $fine = 5 * $diffInDays;
                                        }else{
                                            $fine =0;
                                        }
                                        $batch =$row['batch'];

                                        echo "<tr>";  
                                        echo "<td>{$issued_id}</td>";
                                        echo "<td>{$book_id}</td>";
                                        echo "<td>{$ad_no}</td>";
                                        echo "<td>{$issued_date}</td>";
                                        echo "<td>{$batch}</td>";
                                        echo "<td>{$fine}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-primary" href="return.php?bkid=<?php echo $book_id; ?>&std_id=<?php echo $user_ad_no; ?>&issid=<?php echo $issued_id; ?>">Return Book</a>
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
        $issid=$_GET['issid'];
        $irbiq= "UPDATE `issued` SET  `return_date`=now() WHERE `issued_id`=$issid" ;
        $irbiqc = mysqli_query($connect,$irbiq);

        if(!$irbiqc){
            echo "<div class='alert alert-danger mt-2'>Return failed Try again</div>";
        }else{
            $buvq="UPDATE `book` SET `avail`= true WHERE `book_id` = $bkid";
            $buvqc=mysqli_query($connect,$buvq);
            header('Location: return.php');
        } 
    }

?>
</div>
 <?php include 'partials/footer.php'; ?>


 <!-- -->