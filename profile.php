<?php 
    include 'partials/session.php';
    include 'partials/header.php';
    include 'partials/nav.php'; 
?>
<br><br>
<div class="col-6 m-auto ">
    <table class="table table-bordered">
        <thead class="thead-dark">
        <th colspan=2>Profile</th>
        </thead>
        <tbody>
        <?php 
            include 'connection/db.php';
            $user_id =$_SESSION['user_id'];
            $profile_query = "SELECT * FROM `user` WHERE `user_id` = $user_id";
            $profile_fetch= mysqli_query($connect,$profile_query);
            while($row = mysqli_fetch_assoc($profile_fetch)){
                $user_name = $row['user_name'];
                $user_ad_no=$row['user_ad_no'];
                $user_batch=$row['user_batch'];
                $user_dept = $row['user_course'];
                $user_status = $row['user_status'];
            }
            echo "<tr> <td>Name</td><td>{$user_name}</td></tr>";
            echo "<tr> <td>Admission No</td><td>{$user_ad_no}</td></tr>";
            echo "<tr> <td>Batch</td><td>{$user_batch}</td></tr>";
            echo "<tr> <td>Department</td><td>{$user_dept}</td></tr>";
            echo "<tr> <td>Status</td><td>{$user_status}</td></tr>";
        ?>
        </tbody>
    </table>

</div>
    




<?php include 'partials/footer.php'; ?>