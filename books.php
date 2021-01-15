<?php 
    include 'partials/session.php';
    include 'partials/header.php';
    include 'partials/nav.php'; 
    include 'connection/db.php';
?>

<div class="container-fluid ">
<ol class="breadcrumb mb-4 mt-2 justify-content-center">
        <li class="breadcrumb-item active">Book History</li>
</ol>
    <table class="table mt-3 table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Book </th>
                <th scope="col">Book ID</th>
                <th scope="col">Issue Date</th>
                <th scope="col">Return Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $ad_no = $_SESSION['user_ad_no'];
            $isbhq = "SELECT issued.book_id ,book.title, issued.issued_date, issued.return_date FROM `issued` INNER JOIN `book` ON issued.book_id=book.book_id WHERE issued.ad_no = $ad_no AND issued.return_date IS NULL";
            $fetch_all_queries =mysqli_query($connect,$isbhq);
            while($row = mysqli_fetch_assoc($fetch_all_queries)){
                $title =$row['title'];
                $book_id =$row['book_id'];
                $issued_date =$row['issued_date'];
                $return_date =$row['return_date'];
                echo "<tr>";  
                echo "<td>{$title}</td>";
                echo "<td>{$book_id}</td>";
                echo "<td>{$issued_date}</td>";
                echo "<td>{$return_date}</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>




<?php include 'partials/footer.php'; ?>
    



