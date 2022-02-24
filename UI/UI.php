<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/UI.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Coummunity</title>
</head>

<body>

    <div id="title">
        <h1 id="icon"><img src="./photos/pet_logo.png" alt=""
                    height="100" width="350"></h1>
    </div>
    <br />
    <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.html'" type="button" style="height:25px;width:60px" style="Center"> Post </button>
            </div>
            <?php

                session_start();
                if (array_key_exists("loggedin", $_SESSION)){
                    echo '<div id="login">' . $_SESSION['username'] . '</div>';
                }
                else{
                    echo '<div id="login">
                <button onclick="location.href=\'UI_loginPage.html\'" type="button" style="height:25px;width:60px" style="Center"> Login </button>
            </div>';
                } ?>


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
            var text = '<div id="imgDiv">\
                <img src="./photos/test.png" alt="">\
                <p>testing❤️lol</p>\
            </div > '
            var text2 = '<div id="imgDiv">\
                <img src="./photos/test.png" alt="">\
                <p>testing❤️lol</p>\
            </div > '
            for (var i = 0; i < 8; i++) {
                text = text + text2
            }
            console.log(text)
            var container = document.getElementById('gallery');

            container.innerHTML = text

        }
        addgallery();
        function addsidegallery() {
            var text = '<div id="imgDiv">\
                <img src="./photos/test.png" alt="">\
                <p>testing❤️lol</p>\
            </div > '
            var text2 = '<div id="imgDiv">\
                <img src="./photos/test.png" alt=""> \
                <p>testing❤️lol</p>\
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
    </script>
</body>

</html>
