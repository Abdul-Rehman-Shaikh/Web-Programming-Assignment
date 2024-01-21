<?php
    require_once 'utilities/db.php';
    session_start();

    if( !(isset($_GET["postId"]) && isset($_SESSION["_user"])) ){
        header("Location: index.php");
    }

    $post_id = $_GET["postId"];
    $follower_id = $_SESSION["_user"]["user_id"];

    //get user_id from blogpost with the help of post_id
    try {
        $db_connection = db_connect();

        $sql = "select user_id
                    from blogpost
                    where post_id = :post_id";
        
        $statment = $db_connection->prepare($sql);
        $statment->bindParam(":post_id", $post_id);
        $statment->execute();

        $user_id = $statment->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $user_id["user_id"];

        //check if user has already followed the author and 
        //take appropriate action
        $sql = "select count(*) as count
                    from userfollower
                    where user_id = :user_id
                    and follower_id = :follower_id";

        $statment = $db_connection->prepare($sql);
        $statment->bindParam(":user_id", $user_id);
        $statment->bindParam(":follower_id", $follower_id);
        $statment->execute();

        $count = $statment->fetch(PDO::FETCH_ASSOC);
        $count = (int) $count["count"];

        if($count === 0) {
            $insert_statment = "insert into userfollower(user_id, follower_id)
                                            values(:user_id, :follower_id)";
            $insert = $db_connection->prepare($insert_statment);
            $insert->bindParam(":user_id", $user_id);
            $insert->bindParam(":follower_id", $follower_id);
            $insert->execute();
        }
    } catch(PDOException $e) {}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow Author</title>
</head>

<body>
    <?php if($count === 1): ?>
        <h1><?= "You are already FOLLOWING this Author" ?></h1>
    <?php else: ?>
        <h1>
            <?= "This Author has been successfully added to your FOLLOWING list" ?>
        </h1>
    <?php endif; ?>
    <button><a href="home.php">Home Page</a></button>
    
</body>
</html>


