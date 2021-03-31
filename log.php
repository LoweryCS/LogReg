<?php
session_start();
$_SESSION['message'] = '';
$mysqli = new mysqli('localhost', 'root', 'mypassword123', 'logreg');

if (isset($_POST['username']))
{
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    
    $sql = "SELECT * FROM registered WHERE username='$username' AND password='$password'";
    
    $result = $mysqli->query($sql);
    
    if (($result))
    {
        $_SESSION['message'] = "Login Successful!";
        echo "success";
        header("location:home.php");
    }
    else
    {
        $_SESSION['message'] = "Credentials do not match!";
        echo"no";
        exit();
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
                    <a href="login.php">
                        <img src="img/logo_final.png" style="width:250px;height:100px;">
                    </a>
                </div>
            </div>
            
            <form class="form" action="log.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="alert-fail"><?= $_SESSION['message'] ?></div></br>
                <div class="log-form">
                    <input type="text" placeholder="User Name" name="username" required/></br>
                    <input type="password" placeholder="Password" name="password" autocomplete="new-password" required/></br>
                    <input type="submit" class="but" value="Submit" name="submit" class="btnR" />
                </div>                
            </form>
            
            <div class="overlay"></div>
        </div>
        
    </body>
</html>