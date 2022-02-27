<?php
    //Adapted from https://www.w3schools.com/php/php_file_upload.asp
    include "databaseFunctions.php";
    session_start();


    $target_dir = "./photos/profile_pictures/";

    $uploadOk = 0;

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        if(isset($_FILES["imageupload"])){
            $check = getimagesize($_FILES["imageupload"]["tmp_name"]);
            if ($check !== false){
                echo "File is an image" . $check["mime"] . ".";
                $uploadOk = 1;

                $imageFileType = strtolower(pathinfo($_FILES["imageupload"]["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . basename(getUserCount() + 1 . "." . $imageFileType);
            }
            else{
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        else{
            echo "Adding default pfp";
            $target_file = $target_dir . "default.png";
            $uploadOk = 1;
        }
    }


    if (!$uploadOk){
        echo "Something went wrong";
        header('Location: UI_newUser.html?upload=false');
    }
    else{
        if (!isset($_FILES['imageupload']) || move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)){
            addUser($_POST['username'], hash("sha256", $_POST['password']), $target_file);
            echo "The user has been uploaded";

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userID'] = getUserID($_POST['username']);
        }
        else{
            echo "failed to move file";
        }
        header('Location: Userpage.php');
    }



?>
