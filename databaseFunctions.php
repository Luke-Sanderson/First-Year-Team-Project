<?php
    $database_host = "dbhost.cs.man.ac.uk";
    $database_user = "m78355ls";
    $database_pass = "rockwindowbarkflame";
    $database_name = "2021_comp10120_x9";

    function echoUsers(){
        try {
            global $database_user;
            global $database_pass;
            global $database_host;
            global $database_name;
            $pdo = new pdo("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
            $sql = "SELECT * FROM users";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch())
            {
                echo("<br>" . $row['id'] . " " . $row['username'] .
                    " " .$row['password'] . " " . $row['profile_picture']);
            }

        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }

    }
    function addUser($username, $password, $profile_picture){
        global $database_user;
        global $database_pass;
        global $database_host;
        global $database_name;
        try{
            $sql = "INSERT INTO users (username, password, profile_picture) VALUES (:username, :password, :profile_picture)";

            $pdo = new pdo("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                    'username' => $username,
                    'password' => $password,
                    'profile_picture' => $profile_picture
                    ]);
            echo "Added User to host successfully.";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }

?>
