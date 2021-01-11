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
      <th scope="col">Delete</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php include '../connection/db.php'; 

$books = "SELECT * FROM `book` WHERE 1";
$fetch_all_queries =mysqli_query($connect,$books);

while($row = mysqli_fetch_assoc($fetch_all_queries)){
    $book_id =$row['book_id'];
    $isbn =$row['isbn'];
    $title =$row['title'];
    $author =$row['author'];
    $edition =$row['edition'];
    echo "<tr>";  
    echo "<td>{$book_id}</td>";
    echo "<td>{$isbn}</td>";
    echo "<td>{$title}</td>";
    echo "<td>{$author}</td>";
    echo "<td>{$edition}</td>";
    echo "<td><a href='index_admin.php?menu=posts&delete_post={$book_id}'>Delete</a></td>";
    echo "<td><a href='index_admin.php?menu=posts&source=edit_post&p_id={$book_id}'>Edit</a></td>";
    echo "</tr>";
}
?>   
  </tbody>
</table>
</div>
<?php include 'partials/footer.php' ;?>