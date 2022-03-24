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
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px" style="Center"> Post </button>
                 <!-- Change this link to POST page -->
            </div>
            <div id="login">
                <?php
                    include "databaseFunctions.php";
                    session_start();

                    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                        echo '<div id="login">
                                <button onclick="location.href=\'Userpage.php\'" type="button" style="height:25px;width:60px" style="Center"> '. $_SESSION['username'] . ' </button>
                            </div>';
                    }
                    else{
                        echo '<div id="login">
                                <button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px" style="Center"> Login </button>
                            </div>';
                    } ?>
                <!--<button onclick="location.href='./UI_loginPage.html'" type="button">Login</button> -->
                <!-- Change this link to EDIT page -->
                <!-- Wait what? It should be login page right? -->
                <!-- Added php for login but if it is EDIT page then delete php and add regular button -->
            </div>
        </div>

    </div>

    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">🏠</div>
        <div>pet of the week</div>
        <div>(Navigation Bar)</div>
        <div>Tags🚩</div>
        <div id="search">

            <div id="magnifier" onclick="window.open('https://youtu.be/o-YBDTqX_ZU')">🔍</div>

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
                        echo "<h2>Likes " . $arr['likes'] . "❤️<br>";
                        echo "Comments ". $arr['comments'] . "☁️</h2>";
                    }
                    else{
                        echo    "<h1>Guest</h1>
                                <h2>Likes 0❤️<br>
                                Comments 0☁️</h2>";
                    }
                 ?>

            </div>

            <div id="edit">
                <button onclick="location.href='https://google.com'" type="button" style="height:45px;width:80px;font-size:25px;" style="Center">Edit</button>
                <!-- Change this link to EDIT page -->
            </div>
            <div id="logout">
                <button onclick="window.location.href='logout.php'" type="button">Logout</button>
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
                   echo '<div id="imgDiv">\
                           <img src="' . $post['image'] . '" alt="">\
                           <p>' . $post['pet_name'] . '</p>\
                           <p>' . $post['caption'] . '</p>\
                        </div> ';
                }


                if (count($posts) < 9){
                    for ($i=0; $i < 10 - count($posts); $i++) {
                        echo '<div id="imgDiv">\
                            <img src="./photos/test.png" alt="">\
                            <p>Upload more posts to view them here</p>\
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
    </script>
</body>

</html>
