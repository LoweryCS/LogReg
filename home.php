<?php 
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    </head>
    <body class="bg2">
        <div class="bc">
            <div class="welcome">
                <div class="alert-suc"><p><?=$_SESSION['message'] ?></p></div></br>
                <span class="user"><img src="<?=$_SESSION['avatar'] ?>" height="400" width="400"></span><br />
                </br>Welcome <span class="users"><?=$_SESSION['username'] ?></span>

                <?php
                $mysqli = new mysqli('localhost', 'root', 'mypassword123', 'logreg');
                $sql = 'SELECT username, avatar FROM registered';
                $result = $mysqli->query($sql);    
                ?>

                <div class="regist">
                    <span class="us">All registered users:</span>
                    <div class="prof">
                    <?php 
                        while($row = $result->fetch_assoc())
                        {
                            echo "<div class='userlist'><span>$row[username]</span><br />";
                            echo "<img src='$row[avatar]'  height='100' width='100'></div>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>