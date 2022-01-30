<?php
    session_start();
    $user=$_SESSION['user'];
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
    if(! isset($_SESSION['user']))
        header("Location: login.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Connect</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="https://use.fontawesome.com/b3a33e0934.js"></script>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="icon1.png" >
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    </head>
    <body id="pro">
        <body class="index">
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top nav-diff">
            <a class="navbar-brand" href="/"><img src="logo 3.png"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav nav-text">
                    <a class="nav-item nav-link" href="index.php"><li>Home</li></a>
                    <a class="nav-item nav-link" href="categories.php"><li>Categories</li></a>
                    <a class="nav-item nav-link" href="contacts.php"><li>Contact</li></a>
                </div>
                <div class="navbar-nav ml-auto nav-text">
                    <?php 
                        if(! isset($_SESSION['user'])){
                    ?>
                    <a class="nav-item nav-link" href="signup.php"><li>Sign Up</li></a>
                    <a class="nav-item nav-link" href="login.php"><li>Login</li></a>
                    <?php
                        }
                        else{
                    ?>          
                    <a class="nav-item nav-link" href="profile.php"><li>Profile</li></a>
                    <a class="nav-item nav-link" href="logout.php"><li>Logout</li></a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
        <!-- content -->
        <div id="content" class="profile-card">
            <div>
                <h1 id="hea"><?php echo "Welcome ".$_SESSION["user"]; ?></h1>
                <div class="clearfix">
                    <div id="pic">
                        <?php
                            $sql="SELECT * FROM `profile_image` where user='$user'";
                            $result=mysqli_query($conn,$sql);
                            if($row=mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                <td>
                                <img src="data:image/jpeg;base64,'.base64_encode($row['Data']).'" style="width:320px;">
                                </td>
                                    </tr>';     
                            }
                            else{
                            echo '<tr>
                            <td>
                            <img src="blank3.png" style="width: 320px;">
                            </td>
                                </tr>'; 
                            }
                        ?>
                    </div>
                    <div id="hea-det">
                        <p id="first">Name: </p>
                        <p class="det"><?php echo $_SESSION["name"]; ?></p><br>
                        <p id="first">Email: </p>
                        <p class="det"><?php echo $_SESSION["email"]; ?></p><br>
                        <p id="first">Join Date: </p>
                        <p class="det"><?php echo $_SESSION["date"]; ?></p>
                        <form method="POST" enctype="multipart/form-data">
                            <h5 class="mt-4"> Profile image</h5>
                            <input type="file" name="image" accept="image/*" required id="image">
                            <br><br>
                            <input type="submit" name="insert" id="insert" class="btn btn-dark" value="insert" onclick="selected_image();">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
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
</html>