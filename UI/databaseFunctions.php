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
    function addPost($author_id, $image, $petname, $caption, $tags){
        try{
            $sql = "INSERT INTO posts (author_id, image, pet_name, caption, votes) VALUES (:author_id, :image, :petname, :caption, 0)";

            if ($tags == []){
                insertRequest($sql, [
                        'author_id' => $author_id,
                        'image' => $image,
                        'petname' => $petname,
                        'caption' => $caption]);
                return;
            }

            $pdo = makeConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['author_id' => $author_id,
                    'image' => $image,
                    'petname' => $petname,
                    'caption' => $caption]);
            echo "Added post successfully";

            $post_id = $pdo->lastInsertId();
            foreach ($tags as $index => $tag_name) {
                addTag($post_id, $tag_name);
            }
            echo "Added tags successfully";
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
    function addLike($post_id, $user_id) {
        try{
            $sql = "INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)";
            insertRequest($sql, [
                        'post_id' => $post_id,
                        'user_id' => $user_id]);
            echo "Added like successfully";

            $sql = "UPDATE posts SET votes = votes + 1 WHERE id=:post_id";
            insertRequest($sql, ['post_id' => $post_id]);
            echo "Incrememented like count";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }

    function removeLike($post_id, $user_id) {
        try{
            $sql = "DELETE FROM likes WHERE post_id=:post_id AND user_id=:user_id";
            insertRequest($sql, [
                        'post_id' => $post_id,
                        'user_id' => $user_id]);
            echo "Removed like successfully";

            $sql = "UPDATE posts SET votes = votes - 1 WHERE id=:post_id";
            insertRequest($sql, ['post_id' => $post_id]);
            echo "Decrememnted like count";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function isLiked($post_id, $user_id) {
        try{
            $sql = "SELECT * FROM likes WHERE post_id=:post_id AND user_id=:user_id";
            $stmt = selectRequest($sql, ['post_id' => $post_id, 'user_id' => $user_id]);

            return $stmt->fetch() != null;
        }
        catch (PDOException $pe){
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
    function addPetOfTheWeek($week_of_win, $post_id){
        try{
            $sql = "INSERT INTO pet_of_the_week (week_of_win, post_id) VALUES (:week_of_win, :post_id)";
            insertRequest($sql, [
                        'week_of_win' => $week_of_win,
                        'post_id' => $post_id]);
            echo "Added post of the week successfully";
        }
        catch (PDOException $pe)
        {
            die("Could not connect to host :" . $pe->getMessage());
        }

    }
    function incrementLikeTotal($author_id) {
        try{
            $sql = "UPDATE users SET likes = likes + 1 WHERE id=:author_id";
            $stmt = insertRequest($sql, ['author_id' => $author_id]);
        }
        catch (PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function incrementCommentTotal($author_id) {
        try{
            $sql = "UPDATE users SET comments = comments + 1 WHERE id=:author_id";
            $stmt = insertRequest($sql, ['author_id' => $author_id]);
        }
        catch (PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function decrementLikeTotal($author_id) {
        try{
            $sql = "UPDATE users SET likes = likes - 1 WHERE id=:author_id";
            $stmt = insertRequest($sql, ['author_id' => $author_id]);

        }
        catch (PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getUserTotals ($username){
        try{
            $sql = "SELECT likes, comments FROM users WHERE username=:username";
            $stmt = selectRequest($sql, ['username' => $username]);

            return $stmt->fetch();
        }
        catch (PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getPostCount(){
        try{
            $sql = "SELECT COUNT(*) FROM posts";
            $stmt = selectRequest($sql, []);
            return $stmt->fetch()["COUNT(*)"];
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getUserCount(){
        try{
            $sql = "SELECT COUNT(*) FROM users";
            $stmt = selectRequest($sql, []);
            return $stmt->fetch()["COUNT(*)"];
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getPostInfo($post_id){
        try{
            $sql = "SELECT * FROM posts WHERE id=:post_id";
            $stmt = selectRequest($sql, ['post_id' => $post_id]);
            return $stmt->fetch();
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getUserID($username){
        try{
            $sql = "SELECT id FROM users WHERE username=:username";
            $stmt = selectRequest($sql, ['username' => $username]);
            return $stmt->fetch()['id'];
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getUserName($id){
        try{
            $sql = "SELECT username FROM users WHERE id=:id";
            $stmt = selectRequest($sql, ['id' => $id]);
            return $stmt->fetch()['username'];
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }

    }
    function getProfilePicture($username){
        try{
            $sql = "SELECT profile_picture FROM users WHERE username=:username";
            $stmt = selectRequest($sql, ['username' => $username]);
            return $stmt->fetch()['profile_picture'];
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getTags($id) {
        try{
            $sql = "SELECT tag_name FROM tag_post_table WHERE post_id=:id";
            $stmt = selectRequest($sql, ['id' => $id]);
            return $stmt;
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getPostsFromUser($userID){
        try{
            $sql = "SELECT * FROM posts WHERE author_id=:id";
            $stmt = selectRequest($sql, ['id' => $userID]);
            return $stmt->fetchAll();
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getComments($id) {
        try{
            $sql = "SELECT author_id, text FROM comments WHERE post_id=:id";
            $stmt = selectRequest($sql, ['id' => $id]);
            return $stmt;
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }
    function getPostIDFromTag($tag){
        try{
            $sql = "SELECT post_id FROM tag_post_table WHERE tag_name=:tag";
            $stmt = selectRequest($sql, ['tag' => $tag]);
            return $stmt->fetchAll();
        }
        catch(PDOException $pe){
            die("Could not connect to host :" . $pe->getMessage());
        }
    }

?>
