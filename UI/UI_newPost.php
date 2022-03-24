<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/UI_Userpage.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Coummunity</title>
    <?php
    session_start(); ?>
</head>


<body>

    <div id="title">
        <h1 id="icon" align="Center"><img src="./photos/pet_logo.png" alt=""
                    height="85" width="310"></h1>

        <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px" style="Center"> Post </button>
            </div>
            <?php
                if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
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
    </div>
    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">🏠</div>
        <div>pet of the week</div>
        <div>Username</div>
        <div>Tags🚩</div>
        <div id="search">
            <form class="searchBar" action="searchResults.php" method="post">
                <input type="search" name="searchBox">
                🔍
            </form>
        </div>
    </nav>

 <!--    <input id="Mybutton" style="margin-left:570px;margin-top:65px;height:250px;width:250px" type=button value="➕" href="needsUPDATE.php">&nbsp;&nbsp;
-->

    <form action="./uploadPost.php" method="post" enctype="multipart/form-data" align="Center" style="font-size:150%;" style="font: bold;">&nbsp;&nbsp;
        <input id="imageupload" name="imageupload" type="file"><br>
        <label for="petname" align="Center" style="font-size:150%;" style="font: bold;">PET'S NAME: </label>
        <input type="text" id="petname" name="petname" size="50"><br><br>
        <label for="tags" align="Center" style="font-size:150%;" style="font: bold;">TAGS🚩:</label>
        <input type="text" id="tags" name="tags" size="50"><br><br>
        <label for="caption" align="Center" style="font-size:150%;" style="font: bold;">CAPTION: </label>
        <input type="text" id="caption" name="caption" size="50"><br><br>

        <input type="submit" name="submit" style="height:40px;width:100px" style="Center" value="Submit">

    </form>


    <div id="content">
        <section>
            <div id="sidegallery">

            </div>
        </section>

        <section>
            <div id="gallery">

            </div>
        </section>
