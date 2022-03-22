<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/UI.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Coummunity</title>
</head>

<body>
    <h1 align="Center" style="font-size: 400%; margin-bottom: -1%;">Pet of The Week 👑</h1>
    <div id="group">
            <div id="post">
                <button onclick="location.href='./UI_newPost.php'" type="button" style="height:25px;width:60px" style="Center"> Post </button>
            </div>
            <?php
                include 'databaseFunctions.php';
                session_start();
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
    <br />
    <br />
    <nav id="nav">
        <div onclick="window.open('./UI.php', '_self')">🏠</div>
        <div onclick="location.href='./WeeklyPet.php'">pet of the week</div>
        <div>(Navigation Bar)</div>
        <div>Tags</div>
        <div id="search">

            <div id="magnifier" onclick="window.open('https://youtu.be/o-YBDTqX_ZU')">🔍</div>

        </div>
    </nav>
    <div id="content">
        <section>
            <div id="latesttime">

            </div>
            <div id="slatesttime">

            </div>
            <div id="furthesttime">
                
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
             text2 = '<div id="imgDiv">\
                <img src="./photos/test.png" alt="">\
                <p>testing❤️lol</p>\
            </div > '
            for (var i = 0; i < 8; i++) {
                text = text + text2
            }
            
            // var text = '<?php
            //     $postCount = getPostCount();
            //     for ($i = $postCount; $i >= 1 ; $i--) {
            //         $postInfo = getPostInfo($i);
            //         echo '<div id="imgDiv">\
            //                 <img src="' . $postInfo['image'] . '" alt="">\
            //                 <p>' . $postInfo['pet_name'] . '</p>\
            //                 <p>' . $postInfo['caption'] . '</p>\
            //              </div> ';
            //     }
            //     if ($postCount < 10){
            //         for ($i=0; $i < 10 - $postCount; $i++) {
            //             echo '<div id="imgDiv">\
            //                 <img src="./photos/test.png" alt="">\
            //                 <p>Sorry no more posts available</p>\
            //             </div > ';
            //         }
            //     }
            //  ?>'
            console.log(text)
            var container = document.getElementById('gallery');

            container.innerHTML = text

        }
        addgallery();
        
        function GetDate(LastDate){
            var dt = new Date();
            dt.setDate(dt.getDate()-LastDate);
            var year = dt.getFullYear();
            var month = dt.getMonth() + 1;
            var day = dt.getDate();
            fullTime = day+"/"+month+"/"+year
            return fullTime;
        }
        GetDate();

        function AddDate(){
            var d = new Date();
            var fullTime1 = GetDate(d.getDay());
            var fullTime2 = GetDate(d.getDay()+7);
            var fullTime3 = GetDate(d.getDay()+14);
            var timer1 = document.getElementById('latesttime');
            timer1.innerHTML = fullTime1
            var timer2 = document.getElementById('slatesttime');
            timer2.innerHTML = fullTime2
            var timer3 = document.getElementById('furthesttime');
            timer3.innerHTML = fullTime3
        }
        AddDate();

    </script>
</body>

</html>
