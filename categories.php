<?php
    session_start();
    include('connect.php');

    if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL){
            echo "<script>window.alert('Please Enter something.');</script>";
        }
        else{
            $que = "";
            if($_POST["nul"]==0){
                if(strpos($_POST["preby"],$_SESSION["user"]) === false)
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby=CONCAT(answeredby,', @ ".$_SESSION["user"]."') where question like '%".$_POST["question"]."%'";
                else
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            }
            else
                $que = "update quans set answer='".$_POST["answer"]."', answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            if(mysqli_query($conn,$que))
                echo "<style>#box0,.open{display: none;} #tb{display: block;}</style>";
            else
                header("Location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Connect</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="https://use.fontawesome.com/b3a33e0934.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="icon1.png" >
        <!-- Sripts -->
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <style>
            textarea{
                    display: none;
                    width: 650px;
                    height: 100px;
                    background: #333;
                    color: #ddd;
                    padding: 10px;
                    margin: 5px 0 -14px; 
                }
            @media only screen and (max-width: 578px) {
                textarea{
                    width: 300px;
                    height: 50px;
                }
            }
        </style>
    </head>
    <body class="index cat-page">
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
        <div id="content">
                <a id="title-head" href="categories.php"></a>
            <div id="box0" class="cat-desk">
                <div class="cat-align">
                    <a id="ada" href="#box1">
                        <div id="algo" class="img">
                            <div id="p" title="Open">Algorithm</div>
                        </div>
                        <p class="cat">Algorithm</p>
                    </a>
                    <a id="cso" href="#box2">
                        <div id="archi" class="img">
                            <div id="p" title="Open">Architecture</div>
                        </div>
                        <p class="cat">Architecture</p>
                    </a>
                    <a id="t" href="#box3">
                        <div id="cal" class="img">
                            <div id="p" title="Open">Calculus</div>
                        </div>
                        <p class="cat">Calculus</p>
                    </a>
                </div>
                <div class="cat-align">
                    <a id="db" href="#box4">
                        <div id="database" class="img">
                            <div id="p" title="Open">Database Management</div>
                        </div>
                        <p class="cat">Database Management</p>
                    </a>
                    <a id="pqt" href="#box5">
                        <div id="prob" class="img">
                            <div id="p" title="Open">Probability</div>
                        </div>
                        <p class="cat">Probability</p>
                    </a>
                    <a id="se" href="#box6">
                        <div id="caos" class="img">
                            <div id="p" title="Open">Operating system</div>
                        </div>
                        <p class="cat">Operating system</p>
                    </a>
                </div>
            </div>
            <div class="pop" id="tb">
                <div><p class="mob-post-ans">:)</b>Thank You For Your Answer.</p></div>
            </div>
            <div class="center">
                <?php
                    $no = 1;
                    $n = 1;
                    $nul=0; 
                    while($no < 7){
                ?>
                <div id="box<?php echo $no; ?>" class="open">
                    <a href=""><div id="close">X</div></a>
                    <div id="topic">
                        <?php 
                            echo "<h2 id='topic-head'>";
                            $q = 'select name, description from category where id='.$no;
                            $r = mysqli_query($conn,$q);
                            $d = mysqli_fetch_assoc($r);
                            echo $d['name'].'</h2><p id="topic-desc">'.$d['description']."<br>Explore our home page for more questions.</p>";
                        ?>
                    </div>
                    <div class="center">
                        <?php
                            $qu = "select q.question, q.answer, q.askedby, q.answeredby from quans as q, quacat as r, category as c where q.id=r.id and r.category=c.name and c.id='$no' Limit 8";
                            $re = mysqli_query($conn,$qu);
                            while($da = mysqli_fetch_assoc($re)){
                        ?>
                        <div id="qa-block">
                            <div class="question">
                                <div id="Q">Q.</div>
                                <?php echo $da['question']."<small id='sml'>Asked By: @".$da['askedby']."</small>"; ?>
                            </div>
                            <div class="answer">
                                <?php 
                                    if($da["answer"]){
                                        $nul=0;
                                        echo $da["answer"]."<br><small>Answered By: @".$da['answeredby']."</small>";
                                    }
                                    else{
                                        $nul=1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                ?>
                                <form id="f<?php echo $n; ?>" style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
<!--                                    <input type="button" value="Click here to answer." id="ans_b" >-->
                                    <label style="margin-bottom: -25px;"><a id="ans_b<?php echo $n; ?>" href="#area<?php echo $no; ?>"><u>Submit your answer</u></a></label>
                                    <br>
                                    <script>
                                        $(function(){
                                            $('#ans_b<?php echo $n; ?>').click(function(e){
                                                e.preventDefault();
                                                $('#area<?php echo $n; ?>').css("display","block");
                                                $('#ar<?php echo $n; ?>').css("display","block");
                                                $('#f<?php echo $n; ?>').css("margin-bottom","0px");
                                            });
                                        });
                                    </script>
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $da['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $da['answeredby'] ?>">
                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                </form>                                
                            </div>
                        </div>
                        <?php $n++; } ?>
                    </div>
                </div>
                <?php
                    $no++;
                }
                ?>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
    
</html>