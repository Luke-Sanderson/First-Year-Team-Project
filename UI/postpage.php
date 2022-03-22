<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="postpage.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Community</title>
    <<?php
        include 'databaseFunctions.php';
        session_start();
     ?>
</head>

<body>

    <div id="title">
        <h1 id="icon"><img src="./photos/pet_logo.png" alt=""
                    height="85" width="310"></h1>
    </div>
    <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px" style="Center"> Post </button>
            </div>
            <div id="login">
                <?php
                    if (array_key_exists("loggedin", $_SESSION)){
                        echo '<div id="login">
                                <button onclick="location.href=\'Userpage.php\'" type="button" style="height:25px;width:60px" style="Center">' . $_SESSION['username'] . '</button>
                            </div>';
                    }
                    else{
                        echo '<div id="login">
                                <button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px" style="Center"> Login </button>
                            </div>';
                    } ?>
            </div>


        </div>
    <br />
    <br />
    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">🏠</div>
        <div>pet of the week</div>
        <div>(Navigation Bar)</div>
        <div>Tags</div>
        <div id="search">

            <div id="magnifier" onclick="window.open('https://youtu.be/o-YBDTqX_ZU')">🔍</div>

        </div>
    </nav>

    <div>
        <?php
            if (array_key_exists("id", $_GET)) {
                echo '<img id="imgDiv" src="./photos/posts/' . $_GET["id"] . '.jpeg" alt="">';
            }
            else{
                echo '<img src="./photos/test.png" alt="">';
            }
            ?>
        <div id="post">

                <h1>Name<br>

                    Tags<br>
                    Likes❤️
                    <button style="height:30px;width:60px" type="button">❤️</button><br>
                    <!-- Need add Likes function to show the number of likes they got-->
                Comments☁️<br>
                <textarea name="comments" style="font-family:sans-serif;font-size:20px;">Add your comments here ~</textarea>
                <button style="height:30px;width:60px" type="button">Submit</button>
                <!-- Need add comments function to show the comments under the post-->
            </h1>

            </div>
        <div id="back">
            <button style="height:30px;width:60px" onclick="window.open('./UI.php')" type="button">BACK</button>

        </div>
    </div>


</body>

</html>
