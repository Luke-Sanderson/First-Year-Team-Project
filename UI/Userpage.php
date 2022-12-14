<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/UI_Userpage.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Pet Community</title>
</head>

<body>

    <div id="title">
        <h1 id="icon" align="Center"><img src="./photos/pet_logo.png" alt=""
                    height="85" width="310"></h1>

        <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px; font-weight: bold;"> Post </button>
            </div>
            <div id="login">
                <?php
                    include "databaseFunctions.php";
                    session_start();

                    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                        echo '<div id="login">
                                <button onclick="location.href=\'Userpage.php\'" type="button" style="height:25px;width:60px; font-weight: bold;"> '. $_SESSION['username'] . ' </button>
                            </div>';
                    }
                    else{
                        echo '<div id="login">
                                <button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px; font-weight: bold;"> Login </button>
                            </div>';
                    } ?>
            </div>
        </div>

    </div>

    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">π </div>
        <div onclick="location.href='./WeeklyPet.php'">Pet of the week π</div>
        <div>(Navigation Bar)</div>
        <div>Tagsπ©</div>
        <div id="search">
            <form class="searchBar" action="searchResults.php" method="post">
                <input type="search" name="searchBox">
                π
                </form>
        </div>
    </nav>
    <div id="content">
        <section>
            <div id="sidegallery">

            </div>
            <div id="userinfor">
                <?php
                    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                        echo "<h1>" . $_SESSION['username'] . "</h1>";

                        $arr = getUserTotals($_SESSION['username']);
                        echo "<h2>Likes " . $arr['likes'] . "β€οΈ<br>";
                        echo "Comments ". $arr['comments'] . "βοΈ</h2>";
                    }
                    else{
                        echo    "<h1>Guest</h1>
                                <h2>Likes 0β€οΈ<br>
                                Comments 0βοΈ</h2>";
                    }
                 ?>

            </div>

            <div id="edit">
                <button onclick="location.href='https://google.com'" type="button" style="height:45px;width:80px;font-size:25px; font-weight: bold;">Edit</button>
                <!-- Change this link to EDIT page -->
            </div>
            <br>
            <div id="logout">
                <button onclick="window.location.href='logout.php'" type="button" style="height:45px; width:100px;font-size:25px; font-weight: bold;">Logout</button>
            </div>
            <div id="line">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>


        </section>

        <section>
            <div id="userpage">
                <h1>MY POSTS</h1>

            </div>

            <div id="gallery">


            </div>

            <div id="footer">
                <h3 id="icon" align="Center"><img src="./photos/pet_logo.png" alt=""
                    height="40" width="150"></h3>
            </div>
        </section>


    </div>
    <script>
        function addgallery() {

            var text = '<?php
                $posts = getPostsFromUser($_SESSION['userID']);
                foreach ($posts as $post) {
                   echo '<div id="imgDiv" onclick="openPost(\\\'' . $post['id'] . '\\\')">\
                           <img src="' . $post['image'] . '" alt="">\
                           <p style="font-family: Arial; font-weight: bold;" >' . $post['pet_name'] . '</p>\
                           <p style="margin:-10px; font-family: Arial;">' . $post['caption'] . '</p>\
                        </div> ';
                }


                if (count($posts) < 9){
                    for ($i=0; $i < 9 - count($posts); $i++) {
                        echo '<div id="imgDiv">\
                            <img src="./photos/test.png" alt="">\
                            <p style="font-family: Arial;">Upload more posts to view them here</p>\
                        </div > ';
                    }
                }
             ?>'
            console.log(text)
            var container = document.getElementById('gallery');

            container.innerHTML = text

        }
        addgallery();

        function addsidegallery() {
            var text = '<div id="imgDiv">\
                <img src="<?php
                if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                    echo getProfilePicture($_SESSION['username']);
                }else{
                    echo "./photos/profile_pictures/default.png";
                } ?>" alt="">\
            </div > '
            console.log(text)
            var container = document.getElementById('sidegallery');
            container.innerHTML = text

            console.log(container);

        }
        addsidegallery();

        function openPost(id) {
            window.location.href = "postpage.php?id=" + id;
        }
    </script>
</body>

</html>
