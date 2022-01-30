<?php
$con = mysqli_connect("localhost","root","","data")or die(mysqli_error($con));
$username=$_POST['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$branch=$_POST['branch'];
$year=$_POST['year'];
$email=$_POST['email'];
$password =$_POST['password'];
$confirmpassword=$_POST['confirmpassword'];
$query = "select * from data where email='$email'";
$res = mysqli_query($con,$query)  or die("failed ".mysqli_error($con));
$num = mysqli_num_rows($res);
$array = mysqli_fetch_array($res);
if($num)
{
	echo "<h3>User already exists! Try another username.</h3>";
}
else
{
	$insert = "insert into data values('$username', '$firstname', '$lastname', '$branch', '$year', '$email','$password')";
	$r = mysqli_query($con,$insert)  or die("failed ".mysqli_error($con));
	header("Location:login.html"); 

}
?>
