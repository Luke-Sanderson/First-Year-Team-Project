<?php
    include 'databaseFunctions.php';
    session_start();
    if(validateUserCredentials($_POST['fname'], hash("sha256", $_POST['password']))){
        echo "LOGGED IN SUCCESSFULLY";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_POST['fname'];
        $_SESSION['userID'] = getUserID($_POST['fname']);
        header('Location: UI.php');
    }
    else{
        header('Location: UI_loginPage.html?loggin=false');
    }

 ?>
