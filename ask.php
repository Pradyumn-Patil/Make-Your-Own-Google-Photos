<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['user']))
        header("location: login.php");
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
    <body id="ask">
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
        
        <div id="content">
            <div id="sf">
                <div>
                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" class="ask-form">
                        <a class="ask-category">Select the category for Question: </a>
                        <select name="category" id='form-control'>
                            <option valus="Category">Category</option>
                            <option value="Algorithms">Algorithms</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Calculus">Calculus</option>
                            <option value="Database Management">DBMS</option>
                            <option value="Probability">Probability</option>
                            <option value="os">Operating system</option>
                            <option value="Other">Other</option>
                        </select>
                        <br><br><br>
                        <textarea name="question" class='form-control ask-que' type="text" title="Your Question..."id="question" placeholder="Enter your question...."></textarea>
                        <br><br>
                        <input name="submit" type="submit" class="up-in" id="ask_submit">
                    </form>
                </div>
            </div>
        </div>
        <div id="ask-ta">
            <h1>Thank You.<br>We hope you will get the answer soon :)</h1>
        </div>
        
        <?php
        
            if( isset( $_POST["submit"] ) )
            {
                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }
                $question = valid( $_POST["question"] );
                $cat =valid($_POST['category'] );
                $question = addslashes($question);
                $q = "SELECT * FROM quans WHERE question = '$question'";
                $result = mysqli_query($conn,$q);
                if(mysqli_error($conn))
                    echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                else if( $cat == "Category"){
                    echo "<script>window.alert('Choose a Category.');</script>";
                }
                else if( mysqli_num_rows($result) == 0 ){
                    $query = "INSERT INTO quans VALUES(NULL, '$question', NULL,'".$_SESSION['user']."',NULL,'$cat')";
                    $query1 = "INSERT INTO quacat SELECT q.id, c.name FROM quans as q, category as c WHERE q.question = '".$question."' AND c.name = '".$cat."'";
                    /*$query2="UPDATE `quacat` SET `id` = '43', `category` = 'Calculus' WHERE `quacat`.`id` = 1 AND `quacat`.`category` = 'Algorithms'";*/
                    mysqli_query( $conn, $query);
                    if(mysqli_query( $conn, $query1)){
                        echo "<style>#sf{display: none;} #ask-ta{display:block;}</style>";
                    }
                    else{
                        echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                    }
                }
                else{
                    echo "<script>window.alert('Question was already Asked. Search it on Home Page.');</script>";
                }
                mysqli_close($conn);
            }
        ?>
        <!-- Sripts -->
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-3.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>