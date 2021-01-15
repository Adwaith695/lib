<?php ob_start(); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MLIB</title>
    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link href="css/search.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/nav.php'; ?>
    <div class="container-fluid mt-5">
        <h1 class="display-4 qt">"TODAY A READER, TOMORROW A LEADER"</h1>
    </div>
    <div class="container-fluid in">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 ">
                <form action="" method="POST" class="form-container">
                    <div class="input-group">
                        <input type="text" name="book" placeholder="What you are looking for ?" class="form-control">
                        <button type="submit" class="btn btn-primary" name="search"> Search </button>
                    </div>
                </form>
        </div>
    </div><br><br>
    <?php 
    if(isset($_POST['search'])){
      $letter =$_POST['book'];
      if($letter){
        ?>
        <table class="table table-bordered table-light">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Book ID</th>
            <th scope="col">ISBN</th>
            <th scope="col">TITLE</th>
            <th scope="col">Author</th>
            <th scope="col">Edition</th>
            <th scope="col">Available</th>
          </tr>
        </thead>
        <tbody>
        <?php include 'connection/db.php'; 
        
        $books = "SELECT * FROM `book` WHERE `title` LIKE '%$letter%'";
        $fetch_all_queries =mysqli_query($connect,$books);
        
        while($row = mysqli_fetch_assoc($fetch_all_queries)){
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
      <?php
      }
      
    }
    
    ?>
         
         

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
</body>
</html>