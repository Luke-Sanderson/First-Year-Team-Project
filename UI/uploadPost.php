<?php
    //Adapted from https://www.w3schools.com/php/php_file_upload.asp
    include "databaseFunctions.php";
    session_start();


    $target_dir = "./photos/posts/";

    $imageFileType = strtolower(pathinfo($_FILES["imageupload"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . basename(getPostCount() + 1 . "." . $imageFileType);
    $uploadOk = 0;

    if(!isset($_FILES["imageupload"])){
        echo "Imageupload not set. ";
        header('Location: UI_newPost.php?image=false');
        $uploadOk = 0;
    }
    else if(isset($_POST["submit"])){
        echo "Submit set. ";
        $check = getimagesize($_FILES["imageupload"]["tmp_name"]);
        if ($check){
            echo "File is an image" . $check["mime"] . ". ";
            $uploadOk = 1;
        }
        else{
            echo "File is not an image. ";
            $uploadOk = 0;
        }
    }


    if (!$uploadOk){
        echo "Something went wrong. ";
        header('Location: UI_newPost.php?upload=false');
    }
    else{
        if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)) {
            addPost($_SESSION['userID'], $target_file, $_POST['petname'],  $_POST['caption'], explode(" ", strtolower($_POST['tags'])));
            echo "The file has been uploaded. ";
            header('Location: Userpage.php');
        }


    }



?>
