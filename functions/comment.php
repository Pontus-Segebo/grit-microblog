<?php

session_start();

if ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "POST") {
    include "db.php";
    include "sql.php";

    $auth_user_id = $_SESSION["auth_user"]->id;
    $post_id = $_POST["comment-post-id"];
    $content = $_POST["comment-content"];
    
    $create_comment_sql = 
    "INSERT INTO post_comment 
        (auth_user, post, content)
    VALUES (:auth_user_id, :post_id, :content)
    ";

    $create_comment_sth = $dbh->prepare($create_comment_sql);

    $success = $create_comment_sth->execute([
        "auth_user_id" => $auth_user_id, 
        "post_id" => $post_id, 
        "content" => $content
    ]);

    // make better error handling
    if ($success) {
        header(header: "Location: http://localhost:8080/microblog/post.php?id=$post_id");
    } else {
        echo "falied to add comment";
    }

} else {
    die("Unauthorized");
}
