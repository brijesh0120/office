
<html>
  <head>
    <title>Welcome</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  </head>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Test Project</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
  
        <li class="nav-item">
          <?php 
          if (!isset($_SESSION["user"])) 
            { ?>
              <a style="color: white;" href="register.php">Register &nbsp;</a>
           <?php } ?>
        </li>

         <li class="nav-item">
          <?php 
          if (!isset($_SESSION["user"])) 
            { ?>
              <a style="color: white;" href="index.php">Login</a>
           <?php } ?>
         </li>

         <li class="nav-item">
          <?php 
          if (isset($_SESSION["user"])) 
            { ?>
              <a  style="color: white;" href="logout.php">Logout</a>
           <?php } ?>
         </li>

        
        </div>
 
    </ul>
  </div>
</nav>

</html>