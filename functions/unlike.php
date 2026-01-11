<?php

session_start();

if ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "POST") {
    include "db.php";
    include "sql.php";
    
    $post_id = $_POST["like-post-id"];
    $auth_user_id = $_SESSION["auth_user"]->id;
    
    $has_liked = current_user_has_liked($dbh, $auth_user_id);
    
    // check if user likes post
    if(!$has_liked) {
        die("Cannot remove like since there is none");
    }

    $success = create_post_unlike($dbh, $post_id, $auth_user_id);

    if($success) {
        header(header: "Location: http://localhost:8080/microblog/post.php?id=$post_id");
    } else {
        echo "failed to like post";
    }
} else {
    die("Unathorized");
}
