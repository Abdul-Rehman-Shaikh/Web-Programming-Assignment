<?php
    require_once 'utilities/db.php'; 
    session_start();
    $post_id = $_GET["id"];
    
    try {
        $db_connection = db_connect() ;
        $select_post_and_user = "
            select b.*, u.user_full_name
            from blogpost b join user u
            on (b.user_id = u.user_id)
            where b.post_id = :post_id
        ";

       $select_statment = $db_connection->prepare($select_post_and_user);
       $select_statment->bindParam(":post_id", $post_id);
       $select_statment->execute();

       $post_data = $select_statment->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "<h1>DB Connection Failure</h1>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="my-style.css?v=<?php echo time(); ?>">
    <title>Read Blog</title>
</head>

<body>
    <?php include "header.php"; ?>

    <main class="post-main">
        <section class="post-section">
            <div class="post-title">
                <label for="">Post Title</label>
                <h1><?= $post_data["post_title"]?></h1>
            </div>
                
            <div class="post-author">
                <label>Author Name</label> 
                <h1>By: 
                    <span style="text-transform:uppercase">
                        <?= $post_data["user_full_name"] ?>
                    </span>
                </h1>
            
                <h3 class="post-date">Published on: 
                    <?php $post_date = $post_data["post_date"];
                            $post_date = date_create($post_date);
                            $post_date = date_format($post_date,"D, jS F, Y");
                            echo $post_date; ?>
                </h3>
            </div>

            <div class="post-body">
                <p class="post-body-para">
                    <label>Post Body</label>
                    <?= $post_data["post_body"] ?>
                </p>

                <div class="post-body-buttons">
                    <div class="grp-1">
                        <button title="Like Post">
                            <a href="addlike.php?postId=<?= $post_data['post_id'] ?>">
                                Like
                            </a>
                        </button>
                        <button title="Mark as Read">
                            <a href="addread.php?postId=<?= $post_data['post_id'] ?>">
                                Mark As Read
                            </a>
                        </button>
                    </div>

                    <div class="grp-2">
                        <button title="Follow Author">
                            <a href="addfollower.php?postId=<?= $post_data['post_id'] ?>">
                                Follow
                            </a>
                        </button>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer>
        <h3>
            This page was developed by Abdul Rehman Shaikh(2K20/CSC/1)
        </h3> 
    </footer>

</body>
</html>