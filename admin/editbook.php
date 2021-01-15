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
if(!isset($_GET['p_id'])){
    header('Location: viewbook.php');
}
if(isset($_POST['update-book'])){
    $bookId = $_GET['p_id'];
    $status =$_POST['status'];
    if($status == "" ){
        echo '<div class="alert alert-danger">Please select the option</div>';
    }else{
        $query = "UPDATE `book` SET  `status`='$status' WHERE `book_id` = $bookId";
        $update = mysqli_query($connect,$query);
        if(!$update){
            echo '<div class="alert alert-danger">Failed! Please try again later </div>';
        }else{
            header('Location:viewbook.php');
        }
        
    }
     
}
?>
        <form action="" method="POST" id="add-book">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="title"> Status </label>
                        <select name="status" id="stat" class="form-control">
                            <option value="">Select</option>
                            <option value="Good">Good</option>
                            <option value="Lost">lost</option>
                            <option value="Destroyed">Destroyed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="adberror"></div>
            <div class="form-group">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="update-book"> Update Status </button>              
            </div>
        
        </form>
        
    </div>
</div>
<?php include 'partials/footer.php' ;?>
