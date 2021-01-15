<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand ml-5" href="student.php">LIB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item mx-3">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php 
      if(isset($_SESSION['user_id'])){
        ?>
        <li class="nav-item mx-3">
        <a class="nav-link" href="books.php">Books</a>
        </li>
        <li class="nav-item mx-3">
        <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </li>
        <?php 
      }else{
        ?>
      <li class="nav-item mx-3">
        <a class="nav-link" href="admin/login.php">Admin</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="login.php">User Login </a>
      </li>
      <?php
      }
      
      ?>     
    </ul>
  </div>
</nav>