<?php
    include 'databaseFunctions.php';
    session_start();
    if(validateUserCredentials($_POST['fname'], $_POST['password'])){
        echo "LOGGED IN SUCCESSFULLY";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_POST['fname'];
    }
    else{
        header('Location: UI_loginPage.html?loggin=false');
    }

 ?>
