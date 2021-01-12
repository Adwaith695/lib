<?php include 'partials/session.php'; ?>
<?php include 'partials/header.php'; ?>
    <?php include 'partials/nav.php'; ?>
        <?php include 'partials/sidenav.php'; ?>
        <br>
<div class="row m-3">
    <div class="col-lg-12">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add Book</li>
    </ol>
        <a href="viewbook.php"> <button class="btn btn-primary my-2 my-sm-0"> View All Books</button></a><br><br>
        <?php 
include '../connection/db.php';
$admin_id = $_SESSION['admin_id'];
if(isset($_POST['addbook'])){
    $bookId = $_POST['bookId'];
    $isbn = $_POST['isbn'];
    $title =$_POST['title'];
    $author= $_POST['author'];
    $edition = $_POST['edition'];
    $status =$_POST['status'];
    if(!$bookId || !$isbn || !$title || !$author || !$status ){
        echo '<div class="alert alert-danger">Please fill all the fields</div>';
    }else{
        $book_search = "SELECT * FROM `book` WHERE `book_id` = '$bookId'";
        $search_query = mysqli_query($connect,$book_search);
        $count = mysqli_num_rows($search_query);
        if($count == 1){
            echo '<div class="alert alert-danger">Book Id already</div>';
        }else{
            $query = "INSERT INTO `book`(`admin_id`,`book_id`, `isbn`, `title`, `author`, `edition`, `status`) VALUES ('$admin_id','$bookId','$isbn','$title','$author','$edition','$status')";
            $insert = mysqli_query($connect,$query);
            if(!$insert){
                echo '<div class="alert alert-danger">Failed! Please try again later </div>';
            }else{
                header('Location:viewbook.php');
            }
        }
        
    }
     
}
?>
        <form action="" method="POST" id="add-book">
            <div class="form-group">
                <label for="title"> Book ID</label>
                <input type="text" class="form-control" name="bookId" id="bId">                      
            </div>
            <div class="form-group">
                <label for="title"> ISBN </label>
                <input type="text" class="form-control" name="isbn" id="isb">                      
            </div>
            <div class="form-group">
                <label for="title"> Title </label>
                <input type="text" class="form-control" name="title" id="tit">                      
            </div>
 
            <div class="form-group">
                <label for="title"> Author </label>
                <input type="text" class="form-control" name="author" id="aut">                      
            </div>
            <div class="form-group">
                <label for="title"> Edition </label>
                <input type="text" class="form-control" name="edition" id="edi">                      
            </div> 
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="title"> Status </label>
                        <select name="status" id="stat" class="form-control">
                            <option value="">Select</option>
                            <option value="good">Good</option>
                            <option value="lost">lost</option>
                            <option value="destroyed">Destroyed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="adberror"></div>
            <div class="form-group">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="addbook"> Add Book </button>              
            </div>
        
        </form>
        
    </div>
</div>
<?php include 'partials/footer.php' ;?>
