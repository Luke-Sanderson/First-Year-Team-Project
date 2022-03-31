<?php
    include 'databaseFunctions.php';
    session_start();

    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin'] && is_numeric[$_GET["post_id"]]){
        removeLike($_GET["post_id"], $_SESSION["userID"]);
        header('Location: postpage.php?id=' . $_GET["post_id"]);
    }

    header('Location: UI.php');


 ?>
