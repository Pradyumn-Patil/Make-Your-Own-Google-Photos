<?php
session_start();
$user=$_SESSION['user'];
 	// Connection Config 
	$conn= mysqli_connect("localhost","root","","forum");
	
	if(!$conn){
		header("location: https://httpstat.us/404");
	}
	
	if(isset($_POST['insert'])){
		if($_FILES['image']['tmp_name']!=null){
			$file=addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$sql= "INSERT INTO profile_image values (null,'$user','$file')";
			if(mysqli_query($conn,$sql)){
				echo '<script>alert("File Inserted successfully")</script>';
			}else{
				echo '<script>alert("Error in insertion")</script>';
			}	
		}else{
			echo '<script>alert("Please Select Image");</script>';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>


<div class="container" style="width: 500px">
	<form method="POST" class="justify-content-center " enctype="multipart/form-data">
		<h3 class="mt-4"> Insert Image</h3><br><br>
		<input type="file" name="image" accept="image/*" required id="image">
		<br><br>
		<input type="submit" name="insert" id="insert" class="btn btn-primary" value="insert" onclick="selected_image();">
	</form>

	<br><br>

	<table class="table table-bordered" width="60px">
		<tr>
			<th>Images from Database</th>
		</tr>
		<?php
			$sql="SELECT * FROM `profile_image` where user='$user'";
			$result=mysqli_query($conn,$sql);
			if($row=mysqli_fetch_assoc($result)) {
				echo '<tr>
				<td>
				<img src="data:image/jpeg;base64,'.base64_encode($row['Data']).'" style="width: 200px;">
				</td>
					</tr>';		
			}
			else{
				echo '<tr>
				<td>
				<img src="blank3.png" style="width: 200px;">
				</td>
					</tr>';	
				
			}
		?>
	</table>

</div>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
	function selected_image(){
		var image_name = $('#image').val();
		if(image_name == ''){
			alert("please select Image");
			return false;
		}else{
			var extension = $('#image').val();
			var p = extension.lastIndexOf(".");
			extension = extension.slice(p+1,extension.length).toLowerCase();
			var ext = ["gif","png","jpeg","jpg"];
			if(!ext.includes(extension)){
				alert('unapropriate file selection Please select image file.');
				$('#image').val('');
				return false;
			}
		}
	}
</script>
</body>
</html>