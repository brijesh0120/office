<?php include("header.php"); 

session_start();
if (isset($_SESSION["user"])) 
{
    header("location:dashboard.php");
}

include("conn.php");
if (isset($_POST["register-btn"])) {
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $pass = $_POST["pass"];
    $address = $_POST["address"];
    $status = "1";
/*-------------------------------------------Count Email--------------------- */
    $query_email = "SELECT email FROM user WHERE email='$email'";
    $match_email = mysqli_query($conn,$query_email);
    $count_email = mysqli_num_rows($match_email);

    $query_uname = "SELECT uname FROM user WHERE uname='$uname'";
    $match_uname = mysqli_query($conn,$query_uname);
    $count_uname = mysqli_num_rows($match_uname);    

    $query_mobile = "SELECT mobile FROM user WHERE mobile='$mobile'";
    $match_mobile = mysqli_query($conn,$query_mobile);
    $count_mobile = mysqli_num_rows($match_mobile);

        
          if ($count_uname !=0)  
                 {
                   $msg["error_uname"] = "Username alreday exist";      
                 }  

          else if ($count_email !=0)
  
                 {
                    $msg["error_email"] = "Email alreday exist";     
                 }
 
          else if ($count_mobile !=0)  
                 {
                    $msg["error_mobile"] = "Mobile alreday exist";     
                 }

          else 
                {
                  $sql =  "INSERT INTO `user` (fname,lname,uname,email,mobile,pass,address,st) 
                           VALUES('$fname','$lname','$uname','$email','$mobile','$pass','$address','$status')";
                   $query = mysqli_query($conn,$sql);    
                    if ($query==true)

                      {
                        
                        header("location:index.php");
                      }
 
               }  


}


?>
<form class="col-md-3 mx-auto" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend style="text-align: center;">Register</legend>

  <!-----------login success msg-------------->
    <div class="alert-success h5">
      <?php if(isset($_GET["success"])){
       echo $_GET["success"];
       } ?>
 <!-----------login button-------------->
   
       <?php if(isset($_GET["success"])){

        echo "";
       
       } ?>
</div>


    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      <input type="name" class="form-control" name="fname" id="fname" aria-describedby="emailHelp" placeholder="Enter First Name" value="<?php if(isset($_POST["fname"])){ echo $_POST["fname"]; } ?>">
      <p id="fname_error" class="text-danger"></p>
     
    </div>

  <div class="form-group">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="name" class="form-control" name="lname"  id="lname" aria-describedby="emailHelp" placeholder="Enter Last Name"  value="<?php if(isset($_POST["lname"])){ echo $_POST["lname"]; } ?>">
      <p id="lname_error" class="text-danger"></p>
    
  </div>

 <div class="form-group">
      <label for="exampleInputEmail1">User Name</label>
      <input type="name" class="form-control" name="uname"  id="uname" aria-describedby="emailHelp" placeholder="Enter user Name"  value="<?php if(isset($_POST["uname"])){ echo $_POST["uname"]; } ?>">
      <p id="uname_error" class="text-danger"></p>
      <?php if(isset($msg["error_uname"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["error_uname"]; } ?> </div>   
      
 </div>   
    

    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email"  value="<?php if(isset($_POST["email"])){ echo $_POST["email"]; } ?>">
      <p id="email_error" class="text-danger"></p>
   <?php if(isset($msg["error_email"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["error_email"]; } ?> </div>

    

    

    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
      <p id="pass_error" class="text-danger"></p>
      
    </div>
    
    <div class="form-group">
      <label for="exampleInputPassword1">Mobile</label>
      <input type="text" class="form-control" name="mobile" id="mob" placeholder="Mobile" value="<?php if(isset($_POST["mobile"])){ echo $_POST["mobile"]; } ?>">
      <p id="mobile_error" class="text-danger"></p>
         <?php if(isset($msg["error_mobile"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["error_mobile"]; } ?> </div>
      
    </div>

   <div class="form-group">
      <label for="exampleInputPassword1">Address</label>
      <textarea name="address" id="address" class="form-control"  value="<?php if(isset($_POST["address"])){ echo $_POST["address"]; } ?>"></textarea>
      <p id="address_error" class="text-danger"></p>
      
    </div>  

    <fieldset class="form-group">
    <input type="submit" value="Register" onclick="return valid()" name="register-btn" class="btn btn-info">
  </fieldset>
</form>
<a href="index.php">I have an account</a>


<script>
  function valid()
  {
    var fname = document.getElementById("fname").value;
    var ck_fname = /^[A-Za-z]+$/;

    if(fname==""||fname=="undefined")
    {
      document.getElementById("fname_error").textContent="Please Enter First Name";
      return false;
    }

    if(!ck_fname.test(fname))
    {
      document.getElementById("fname_error").textContent="Please Enter Valid First Name";
      return false;
    }    

    var lname = document.getElementById("lname").value;
    

    if(lname==""||lname=="undefined")
    {
      document.getElementById("lname_error").textContent="Please Enter Last Name";
      document.getElementById("fname_error").textContent="";
      return false;
    } 

    if(!ck_fname.test(lname))
    {
      document.getElementById("lname_error").textContent="Please Enter Valid Last Name";
      return false;
    }      

    var uname = document.getElementById("uname").value;
    var ck_uname = /^[A-Za-z0-9 ]{3,20}$/;

    if(uname==""||uname=="undefined")
    {
      document.getElementById("uname_error").textContent="Please Enter User Name";
      document.getElementById("lname_error").textContent="";
      return false;
    }  

    if(!ck_fname.test(uname))
    {
      document.getElementById("uname_error").textContent="Please Enter Valid User Name";
      document.getElementById("lname_error").textContent="";
      return false;
    } 

  


   var email = document.getElementById("email").value;

    if(email==""||email=="undefined")
    {
      document.getElementById("email_error").textContent="Please Enter Email ID";
      document.getElementById("uname_error").textContent="";
      return false;
    }

    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)==false)
    {
      document.getElementById("email_error").textContent="Please Enter Valid Email ID";
      document.getElementById("lname_error").textContent="";
      return false;
    } 
   

    var pass = document.getElementById("pass").value;
    
    if(pass==""|| pass=="undefined")
    {
        document.getElementById("pass_error").textContent="Please Enter Password";
        document.getElementById("email_error").textContent="";
        return false;
    }

    if(pass.length<5 || pass.length>10)
    {
        document.getElementById("pass_error").textContent="Enter Password between 5 to 10 ";
        document.getElementById("email_error").textContent="";
        return false;
    }

    var mobile = document.getElementById("mob").value;


    if(mobile=="")
    {
        document.getElementById("mobile_error").textContent="Please Enter enter mobile";
        document.getElementById("pass_error").textContent="";
        return false;
    } 

    if(mobile.length!=10)
    {
        document.getElementById("mobile_error").textContent="Enter correct mobile";
        document.getElementById("pass_error").textContent="";
        return false;
    } 

    var address = document.getElementById("address").value;        
    if(address=="")
    {
        document.getElementById("address_error").textContent=" Please Enter Address";
        document.getElementById("mobile_error").textContent="";
        return false;
    }   
  
   
  }


</script>



<?php
include("footer.php");
 ?>
