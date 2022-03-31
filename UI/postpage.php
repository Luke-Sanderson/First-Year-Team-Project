<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/postpage.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Community</title>
    <?php
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
                if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                        echo '<button onclick="location.href=\'Userpage.php\'" type="button" style="height:25px;width:60px" style="Center">' . $_SESSION['username'] . '</button>';
                    }
                    else{
                        echo '<button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px" style="Center"> Login </button>';
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
        <div id="post">
            <br>
            <?php
                if (array_key_exists("id", $_GET) && is_numeric($_GET["id"]) && $_GET["id"] <= getPostCount()){
                    $postInfo = getPostInfo($_GET["id"]);

                    echo '<img style="height: 200px; justify: center;" src="' . $postInfo['image'] . '" alt="">';
                    echo '<h1>Name: ' . $postInfo['pet_name'] . '<br>';
                    echo 'Caption: ' . $postInfo['caption'] . '<br>';
                    $str = 'Tags:';
                    $stmt = getTags($postInfo["id"]);
                    while ($tag = $stmt->fetch()){
                        $str = $str . " " . $tag["tag_name"];
                    }
                    echo $str . '<br>';

                    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                        if(!isLiked($_GET["id"], $_SESSION["userID"])){
                            echo '<button style="height:50px;width:100px" type="button" onclick="location.href=\'like.php?post_id=' . $_GET["id"] . '\'">Like: ' . $postInfo['votes'] . ' ❤️</button><br>';
                        }
                        else{
                            echo '<button style="height:50px;width:100px;background-color:#808080" type="button" onclick="location.href=\'unlike.php?post_id=' . $_GET["id"] . '\'">Liked: ' . $postInfo['votes'] . ' ❤️</button><br>';
                        }
                    }
                    else {
                        echo '<button style="height:50px;width:100px" type="button" onclick="location.href=\'UI_loginPage.html\'">Likes: ' . $postInfo['votes'] . ' ❤️</button><br>';
                    }
                    echo '
                        Comments☁️<br>
                        <form method="post" action="./newComment.php?post_id='.$_GET["id"].'">
                            <input type="text" name="text" style="font-family:sans-serif;font-size:20px;" value="Add your comments here ~">
                            <input type="submit" style="height:30px;width:80px" value="Comment">
                        </form>';

                    $str = '';
                    echo '</h1>';
                    $stmt = getComments($postInfo["id"]);
                    while ($comment = $stmt->fetch()){
                        $str = $str . getUserName($comment["author_id"]) . ": \"" . $comment["text"] . "\"<br>";
                    }
                    echo $str . '<br>';

                }
                else{
                    echo '<img src="./photos/test.png" alt="">';
                    echo '<h1>No post associated with this ID</h1>';
                }
                ?>


            </div>
        <div id="back">
            <button style="height:30px;width:60px" onclick="location.href='./UI.php'" type="button">BACK</button>

        </div>
    </div>


</body>

</html>
