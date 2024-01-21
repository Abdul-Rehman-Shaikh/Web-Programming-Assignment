<?php
    require_once 'utilities/db.php';
    session_start();

    if( !(isset($_GET["postId"]) && isset($_SESSION["_user"])) ){
        header("Location: index.php");
    }

    $post_id = $_GET["postId"];
    $user_id = $_SESSION["_user"]["user_id"];

    try {
        $db_connection = db_connect();

        $select_count = "select count(*) as count
                                        from blogpostlikes
                                        where post_id = :post_id
                                        and user_id = :user_id";
    
        $select_statment = $db_connection->prepare($select_count);
        
        $select_statment->bindParam(":post_id", $post_id);
        $select_statment->bindParam(":user_id", $user_id);
       
        $select_statment->execute();
        $count = $select_statment->fetch(PDO::FETCH_ASSOC);
        $count = (int) $count["count"];

        if($count === 0) {
            $insert_statment = "insert into blogpostlikes(post_id, user_id)
                                            values(:post_id, :user_id)";
            $insert = $db_connection->prepare($insert_statment);
            $insert->bindParam(":post_id", $post_id);
            $insert->bindParam(":user_id", $user_id);
            $insert->execute();
        }

    }catch(PDOException $e) {

    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Like</title>
</head>

<body>
    <?php if($count === 1):  ?>
        <h1><?= "You already Liked the Post" ?></h1>
    <?php else: ?>
        <h1><?= "Your Like has been Added" ?></h1>
        <?php endif; ?>
        <button><a href="home.php">Home Page</a></button>

</body>
</html>

