<?php
session_start();
$_SESSION['message'] = '';
$msg = $mysqli->real_escape_string($_SESSION['message']);
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
                        die();
                    }
                    else
                    {
                        $_SESSION['message'] = "user could not be added to the database!";
                        echo  $_SESSION['message'];
                    }

                }
                else
                {
                    $_SESSION['message'] = "File upload fail!";
                    echo  $_SESSION['message'];
                }
            }
            else
            {
                $_SESSION['message'] = "Please only upload GIF, JPG, or PNG images!";
                echo  $_SESSION['message'];
            }
    }
    else
    {
        $_SESSION['message'] = "The passwords entered do not match!";
        echo  $_SESSION['message'];
        header("Location: ../login.php");
        die();
        
    }
}

?>