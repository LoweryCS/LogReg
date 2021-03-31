<?php
session_start();
$_SESSION['message'] = '';
$mysqli = new mysqli('localhost', 'root', 'mypassword123', 'logreg');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
        //are paswords equal?
        if($_POST['password'] == $_POST['cpassword'])
        {
            $username = $mysqli->real_escape_string($_POST['username']);
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = md5($_POST['password']);
            $avatar_f = $mysqli->real_escape_string('img/'.$_FILES['avatar']['name']);

            //is file image type?
            if (preg_match("!image!", $_FILES['avatar']['type']))
            {
                //copy img to file location
                if (copy($_FILES['avatar']['tmp_name'], $avatar_f))
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['avatar'] = $avatar_f;

                    $sql = "INSERT INTO registered (username, email, password, avatar)" . "VALUES ('$username', '$email', '$password', '$avatar_f')";

                    //if query is successful, you're done
                    if ($mysqli->query($sql) === true)
                    {
                        $_SESSION['message'] = "Registration successful! Added $username to the database!";
                        header("location:home.php");                        
                    }
                    else
                    {
                        $_SESSION['message'] = "User could not be added to the database!";                        
                    }
                }
                else
                {
                    $_SESSION['message'] = "File upload fail!";                    
                }
            }
            else
            {
                $_SESSION['message'] = "Please only upload GIF, JPG, or PNG images!";               
            }
    }
    else
    {
        $_SESSION['message'] = "The passwords entered do not match!";        
    }
}
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Login | Registration</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    </head>    
    <body> 
        <div class="bg bg2">
            <div class="nav">
                <div id="logo">
                    <a href="login.html">
                        <img src="img/logo_final.png" style="width:250px;height:100px;">
                    </a>
                </div>
                <a href="log.php" id="right">Login | </a>
                <div id="pic">
                    <a id="pro" href="https://www.google.com/search?biw=1536&bih=762&tbm=isch&sa=1&ei=iWg1XILJFMvWkwXz37GgDA&q=mesomorph&oq=meso&gs_l=img.1.0.0i67j0j0i67j0j0i67j0l2j0i67j0l2.2791.3120..5044...0.0..0.213.703.0j3j1......0....1..gws-wiz-img.i1ulcv9usyQ">
                        <img src="img/propic2.png" style="width:50px;height:50px;" >
                    </a>
                </div>
            </div>
            <div class="log-form">
                <h1 class="lab">Create an Account</h1>
                <form class="form" action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="alert-fail"><?= $_SESSION['message'] ?></div></br>
                    <div class="log">
                        <input type="text" placeholder="User Name" name="username" required/></br>
                        <input type="email" placeholder="Email" name="email" required/></br>
                        <input type="password" placeholder="Password" name="password" autocomplete="new-password" required/></br>
                        <input type="password" placeholder="Confirm Password" name="cpassword" autocomplete="new-password" required/></br>            
                        <div class="avatar"><label id="ava">Select Your Avatar </label><input id="file" type="file" name="avatar" accept="image/*" required></div>
                        <input type="submit" class="but" value="Register" name="register" class="btnR" />
                    </div>
                </form>
            </div>
            <a id="am" href="https://www.youtube.com/" >Already a Member?</a>
            <div class="bot">
                <p>© OUTPUT : X. All rights reserved. | <a href="https://www.twitch.tv/timthetatman" id="terms"> Terms of Use | </a><a href="http://www.worldstarhiphop.com/videos/" id="priv"> Privacy Policy</a></p>
            </div>
            <div class="overlay"></div>
        </div>
    </body>
</html>