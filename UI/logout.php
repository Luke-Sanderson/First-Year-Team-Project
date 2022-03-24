<?php
    session_start();
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = null;
    $_SESSION['userID'] = null;
    header('Location: UI_loginPage.html');

 ?>
