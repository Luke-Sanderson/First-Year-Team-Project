<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/UI.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Community</title>
</head>

<body>

    <div id="title">
        <h1 id="icon"><img src="./photos/pet_logo.png" alt=""
                    height="85" width="310"></h1>
    </div>
    <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px; font-weight: bold;"> Post </button>
            </div>
            <?php
                include 'databaseFunctions.php';
                session_start();
                if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin']){
                    echo '<div id="login">
                            <button onclick="location.href=\'Userpage.php\'" type="button" style="height:25px;width:60px; font-weight: bold;">' . $_SESSION['username'] . '</button>
                        </div>';
                }
                else{
                    echo '<div id="login">
                            <button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px; font-weight: bold;"> Login </button>
                        </div>';
                } ?>


        </div>
    <br />
    <br />
    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">🏠</div>
        <div>Pet of the week 👑</div>
        <div>(Navigation Bar)</div>
        <div>Tags</div>
        <div id="search">
            <form class="searchBar" action="searchResults.php" method="post">
                <input type="search" name="searchBox">
                🔍
            </form>
<!--            <div id="magnifier" onclick="window.open('https://youtu.be/o-YBDTqX_ZU')">🔍</div>
-->
        </div>
    </nav>
    <div id="content">
        <section>
            <div id="sidegallery">

            </div>
        </section>

        <section>
            <div id="gallery">

            </div>
            <div id="footer">

                <h3><img src="./photos/pet_logo.png" alt=""
                    height="25" width="73"></h3>
            </div>
        </section>


    </div>
    <script>
        function addgallery() {
            var text = '<?php
                $postIDs = getPostIDFromTag($_POST['searchBox']);
                foreach ($postIDs as $id) {
                    $post = getPostInfo($id['post_id']);
                    echo '<div id="imgDiv" onclick="openPost(\\\'' . $post['id'] . '\\\')">\
                           <img src="' . $post['image'] . '" alt="">\
                           <p style="font-family: Arial; font-weight: bold;">' . $post['pet_name'] . '</p>\
                           <p style="margin:-10px; font-family: Arial;">' . $post['caption'] . '</p>\
                        </div> ';
                }


                if (count($postIDs) < 9){
                    for ($i=0; $i < 9 - count($postIDs); $i++) {
                        echo '<div id="imgDiv">\
                            <img src="./photos/test.png" alt="">\
                            <p style="font-family: Arial;">No more posts fit the tag '. $_POST['searchBox'] . '</p>\
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
                <img src="./photos/test.png" alt="">\
                <p style="font-family: Arial;">testing❤️lol</p>\
            </div > '
            var text2 = '<div id="imgDiv">\
                <img src="./photos/test.png" alt=""> \
                <p style="font-family: Arial;">testing❤️lol</p>\
            </div>'
            for (var i = 0; i < 2; i++) {
                text = text + text2
            }
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
