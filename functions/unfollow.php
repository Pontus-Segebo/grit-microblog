<?php

session_start();

if ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "POST") {
    include "db.php";
    include "sql.php";

    $profile_user_id = $_POST["profile-user-id"];
    $auth_user_id = $_SESSION["auth_user"]->id;

   $current_user_is_following = current_user_is_following(
        $dbh, 
        $auth_user_id, 
        $profile_user_id
    );
    
    // check if user is following
    if(!$current_user_is_following) {
        die("Cannot unfollow since already not following");
    }

    $success = create_unfollow($dbh, $auth_user_id, $profile_user_id);

    if($success) {
        header(header: "Location: http://localhost:8080/microblog/profile.php?id=$profile_user_id");
    } else {
        echo "failed to follow";
    }
} else {
    die("Unathorized");
}
