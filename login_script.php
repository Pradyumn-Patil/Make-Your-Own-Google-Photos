<?php
$con = mysqli_connect("localhost","root","","data")or die(mysqli_error($con));
$username=$_POST['username'];
$password= ($_POST['password']);
$query = "select * from data where username='$username' and password='$password'";
$result = mysqli_query($con,$query) or die("failed ".mysqli_error($con));
$number_of_users = mysqli_num_rows($result);
session_start();
$_SESSION["username"]=$username; 
if($number_of_users == 1)
{
	header("Location:student.php"); 
}
else
{
	echo "Failure";
}
?>
