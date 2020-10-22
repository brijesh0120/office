<?php
session_start();
include("header.php");
include("conn.php");
$user_id = $_GET["id"];
$sql ="SELECT * FROM user WHERE id='$user_id'";
$query =  mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["update-btn"])) 
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $st = $_POST["st"];

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

         /*   if($email == $result["email"])
            {

            }

        */


            if ($count_email !=0 AND $email != $result["email"] )
  
                 {
                    $msg["email_up_error"] = "Email alreday exist";
                    
                 }

         elseif ($count_mobile !=0 AND $mobile != $result["mobile"])  
                 {
                    $msg["mobile_up_error"] = "Mobile alreday exist";
                   
                 }

         elseif ($count_uname !=0  AND $uname != $result["uname"])  
                 {
                    $msg["uname_up_error"] = "User Name alreday exist";
                   
                 }                   

               else 
               {
                     $sql = "UPDATE `user` SET `fname`='$fname',`lname`='$lname',`uname`='$uname',`email`='$email',`mobile`='$mobile',`address`='$address',`st`='$st' WHERE `id`='$user_id'";
                   $query = mysqli_query($conn,$sql);    
                    if ($query==true)

                      {
                        $msg["update"] = "Hurry Record Updated";                       
                      }   

                    else 

                      {
                        /////////////*********///////////
                      } 
 
               }  


}


?>    

    


 <form class="col-md-3 mx-auto" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend style="text-align: center;"><p style="color: red">Edit</p></legend> 
    <a href="dashboard.php"><img src="https://image.freepik.com/free-icon/arrow-back_318-10569.jpg" width="50px" height="50px" alt=""></a><br><br> 


    <div class="form-group">

          <?php if(isset($msg["update"])){ ?>
    <div class="alert-success">&nbsp;<?php echo $msg["update"]; } ?> </div>


      <span>Status : </span>
      Active : <input type="radio" <?php if($result["st"]=="1"){ echo "checked"; } ?> value="1" name="st">&nbsp;&nbsp;|
      Deactive : <input type="radio" <?php if($result["st"]=="0"){ echo "checked"; } ?> value="0" name="st">

    </div>    


    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      <input type="name" class="form-control" name="fname" id="fname" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo $result["fname"]; ?>">   
    </div>
    <p id="fname_error" class="text-danger"></p>

    <div class="form-group">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="name" class="form-control" name="lname" id="lname" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo $result["lname"]; ?>">
      
    </div>
    <p id="lname_error" class="text-danger"></p>

    <div class="form-group">
      <label for="exampleInputEmail1">User Name</label>
      <input type="name" class="form-control" name="uname" id="uname" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo $result["uname"]; ?>">     
    </div>
    <p id="uname_error" class="text-danger"></p>

  <?php if(isset($msg["uname_up_error"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["uname_up_error"]; } ?> </div>    
           

    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $result["email"]; ?>"> 
    </div>
    <p id="email_error" class="text-danger"></p>

  <?php if(isset($msg["email_up_error"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["email_up_error"]; } ?> </div>    


    <div class="form-group">
      <label for="exampleInputPassword1">Mobile</label>
      <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo $result["mobile"]; ?>">
    </div>
    <p id="mobile_error" class="text-danger"></p>

  <?php if(isset($msg["mobile_up_error"])){ ?>
  <div class="alert-danger">&nbsp;<?php echo $msg["mobile_up_error"]; } ?> </div>    

    <div class="form-group">
      <label for="exampleInputEmail1">Address</label>
      <input type="name" class="form-control" name="address" id="address" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo $result["address"]; ?>">
      
    </div>
    <p id="address_error" class="text-danger"></p>

    

    <fieldset class="form-group">
    <input type="submit" value="Update" onclick="return valid()" name="update-btn" class="btn btn-info">
  </fieldset>
</form>

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
      document.getElementById("fname_error").textContent="";
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

    if(!ck_uname.test(uname))
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
   


    var mobile = document.getElementById("mobile").value;


    if(mobile=="")
    {
        document.getElementById("mobile_error").textContent="Please Enter enter mobile";
        document.getElementById("email_error").textContent="";
        return false;
    } 

    var num = /^[0-9]*$/;

    if(mobile.length!=10)
    {
        document.getElementById("mobile_error").textContent="Enter correct mobile";
        document.getElementById("email_error").textContent="";
        return false;
    } 

    if(!num.test(mobile))
    {
        document.getElementById("mobile_error").textContent="Opps Please Enter Number Only";
        document.getElementById("email_error").textContent="";
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




 <?php include("footer.php"); ?>