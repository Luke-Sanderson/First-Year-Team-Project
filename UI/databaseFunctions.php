<?php
    $database_host = "dbhost.cs.man.ac.uk";
    $database_user = "m78355ls";
    $database_pass = "rockwindowbarkflame";
    $database_name = "2021_comp10120_x9";

    function makeConnection(){
        global $database_user;
        global $database_pass;
        global $database_host;
        global $database_name;

        return new pdo("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
    }
    function selectRequest($sql, $varArray){
        $pdo = makeConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($varArray);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }
    function insertRequest($sql, $varArray){
        $pdo = makeConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($varArray);
    }
    function echoUsers(){
        try {
            $sql = "SELECT * FROM users";
            $stmt = selectRequest($sql, []);
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
        try{
            $sql = "INSERT INTO users (username, password, profile_picture) VALUES (:username, :password, :profile_picture)";
            insertRequest($sql, [
                    'username' => $username,
                    'password' => $password,
                    'profile_picture' => $profile_picture]);

            echo "Added User to host successfully.";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function addPost($author_id, $image, $caption){
        try{
            $sql = "INSERT INTO posts (author_id, image, caption, votes) VALUES (:author_id, :image, :caption, 0)";
            insertRequest($sql, [
                    'author_id' => $author_id,
                    'image' => $image,
                    'caption' => $caption]);
            echo "Added post successfully";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function addComment($post_id, $author_id, $text){
        try{
            $sql = "INSERT INTO comments (post_id, author_id, text) VALUES (:post_id, :author_id, :text)";
            insertRequest($sql, [
                    'post_id' => $post_id,
                    'author_id' => $author_id,
                    'text' => $text]);
            echo "Added comment successfully";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function addTag($post_id, $tag_name){
        try{
            $sql = "SELECT * FROM tag_post_table WHERE tag_name=:tag_name AND post_id=:post_id";
            if (selectRequest($sql, [
                        'tag_name' => $tag_name,
                        'post_id' => $post_id]) -> fetch() != null){
                echo "Tag already exists on this post";
                return;
            }

            $sql = "INSERT INTO tag_post_table (tag_name, post_id) VALUES (:tag_name, :post_id)";
            insertRequest($sql, [
                        'tag_name' => $tag_name,
                        'post_id' => $post_id]);
            echo "Added tag successfully";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }

    }
    function validateUserCredentials($username, $password){
        try{
            $sql = "SELECT password FROM users WHERE username=:username";
            $stmt = selectRequest($sql, ['username' => $username]);

            return ($stmt->fetch()['password'] == $password);
        }
        catch (PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }


?>
