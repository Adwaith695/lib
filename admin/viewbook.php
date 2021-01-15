<?php include 'partials/session.php'; ?>
<?php include 'partials/header.php';
    include 'partials/nav.php'; 
    include 'partials/sidenav.php'; 
?>
<!-- write your code hear -->
<div class="container-fluid">
     <ol class="breadcrumb mb-4 mt-2">
         <li class="breadcrumb-item active">View Books</li>
     </ol>
     <a href="addbook.php"> <button class="btn btn-primary my-2 my-sm-0"> Add Book</button></a><br><br>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Book ID</th>
      <th scope="col">ISBN</th>
      <th scope="col">TITLE</th>
      <th scope="col">Author</th>
      <th scope="col">Edition</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
      <th scope="col">Available</th>
    </tr>
  </thead>
  <tbody>
  <?php include '../connection/db.php'; 
$admin_id = $_SESSION['admin_id'];
$books = "SELECT * FROM `book` WHERE `admin_id`='$admin_id'";
$fetch_all_queries =mysqli_query($connect,$books);

while($row = mysqli_fetch_assoc($fetch_all_queries)){
    $book_id =$row['book_id'];
    $isbn =$row['isbn'];
    $title =$row['title'];
    $author =$row['author'];
    $edition =$row['edition'];
    $status =$row['status'];
    $avail = $row['avail'];
    echo "<tr>";  
    echo "<td>{$book_id}</td>";
    echo "<td>{$isbn}</td>";
    echo "<td>{$title}</td>";
    echo "<td>{$author}</td>";
    echo "<td>{$edition}</td>";
    echo "<td>{$status}</td>";
    echo "<td><a href='editbook.php?p_id={$book_id}'>Edit</a></td>";
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
</div>
<?php include 'partials/footer.php' ;?>
