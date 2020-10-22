<?php
include("conn.php");
session_start();
include("header.php");
$user_id = "";
if (!isset($_SESSION["user"])) 
{
	header("location:index.php");

}   

echo "<br><center><h3 class='text-info'>Current User Email &nbsp;".$_SESSION["user"]."</h3></center>";
?>

<div class="col-md-3 mx-auto">


	<?php if(isset($_GET["success"])){ ?>
	<div class="alert-success">&nbsp;<?php echo $_GET["success"]; } ?></div>


	
</div>


<center>
<div style="width: 50%;">
<table class="table" border="1">
	<tr>
		<th>ID</th>
		<th>First Name</th>
		<th>Last Name</th>
    <th>User Name</th>
		<th>Email</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>Edit</th>
	</tr>
	<?php 

			$fetch  = "SELECT * FROM user ORDER BY id DESC";
			$run_record  = mysqli_query($conn,$fetch);


			

	while ($row = mysqli_fetch_array($run_record,MYSQLI_ASSOC)){ ?>
	<tr>
		<td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["fname"]; ?></td>
		<td><?php echo $row["lname"]; ?></td>
		<td><?php echo $row["uname"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["mobile"]; ?></td>
    <td><?php echo $row["address"]; ?></td>
    <td><a href="edit.php?id=<?php echo $row["id"]; ?>"><img src="https://thumbs.dreamstime.com/t/edit-icon-glyph-line-102291435.jpg" height="20px" width="20px" alt=""></a></td>
	</tr>
    <?php } ?>

</table>


</div>
</center>

<?php
include("footer.php");
?>