<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php

            //session_start();
            echo "1";
            if (1 != 1){
                echo "2";
                echo `<div id="login">BEFORE ` . $_SESSION['username'] . ` CHECKING STUFF</div>`;
            }
            else{
                echo "3";
                echo '<div id="login" onclick="window.location=`./UI_loginPage.html`">Login</div>';
            }
            echo "4";
        ?>

    </body>
</html>
