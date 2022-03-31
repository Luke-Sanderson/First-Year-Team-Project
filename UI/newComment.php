<?php
    include 'databaseFunctions.php';
    session_start();

    if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin'] && is_numeric($_GET["post_id"])) {
        addComment($_GET["post_id"], $_SESSION["userID"], $_POST["text"]);
        $postInfo = getPostInfo($_GET["post_id"]);
        incrementCommentTotal($postInfo["author_id"]);
        header('Location: postpage.php?id=' . $_GET["post_id"]);
    }
    else{
        header('Location: UI_loginPage.html');
    }

 ?>
