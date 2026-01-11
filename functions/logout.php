<?php

session_start();

if (!$_SESSION["auth_user"]) {
    header(header: "Location: http://localhost:8080/microblog/index.php");
    die();
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header(header: "Location: http://localhost:8080/microblog/index.php");
