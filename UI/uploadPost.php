<?php
    include "databaseFunctions.php";
    session_start();


    $target_dir = "./photos/posts/";

    $target_file = $target_dir . basename(getPostCount() . "." . strtolower(pathinfo($_FILES["imageupload"]["name"], PATHINFO_EXTENSION)));
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])){
        $check = getimagesize($_FILES["imageupload"]["tmp_name"]);
        if ($check !== false){
            echo "File is an image" . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else{
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


    if (!$uploadOk){
        echo "Something went wrong";
    }
    else{
        if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)) {
            echo "The file has been uploaded";
        }
    }



?>
