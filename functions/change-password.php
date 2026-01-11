<?php

session_start();

if ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "POST") {

    include "db.php";
    include "sql.php";

    $auth_user_id = $_SESSION["auth_user"]->id;
    $new_password = $_POST["change-password-input"];

    $success = change_password($dbh, $auth_user_id, $new_password);

    if ($success) {
        header(header: "Location: http://localhost:8080/microblog/profile.php?id=$auth_user_id");
    } else {
        die("Failed to change password");
    }

} else {
    die("Unauthorized");
}
