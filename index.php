<?php include("header.php");

include("conn.php");
session_start();
if (isset($_SESSION["user"])) 
{
    header("location:dashboard.php");
}

if (isset($_POST["login-btn"])) 
{
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $sql = "SELECT * FROM `user` WHERE pass='$pass' AND (email = '$email' OR mobile = '$email')";
    $query= mysqli_query($conn,$sql);
    $row = mysqli_num_rows($query);
    $fetch = mysqli_fetch_array($query,MYSQLI_ASSOC);

    $st = $fetch["st"];

    if ($row==0) 
    {
      $msg["login_error"]="Invalid Details";
    }

    else if($st=="0")
    {
      $msg["login_error"] = "OOPs Your Account is Deactived";
    }
    else
    {
       $_SESSION["user"] = $fetch["email"];
       header("location:dashboard.php");
    }
   

}
  ?>
<form class="col-md-3 mx-auto" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend style="text-align: center;">Login</legend>

    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="name" class="form-control" name="email" id="email"aria-describedby="emailHelp" placeholder="Enter email">
      <small id="email_error" class="text-danger"></small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
      <small id="pass_error" class="text-danger"></small>
    </div>
    <?php if(isset($msg["login_error"])){ ?>
    <div class="alert-danger">&nbsp;<?php echo $msg["login_error"]; } ?> </div>

    <fieldset class="form-group">
    <input type="submit" value="Login"  name="login-btn" class="btn btn-primary mt-2">
  </fieldset>
</form>



<?php
include("footer.php");
 ?>

