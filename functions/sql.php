<?php
function create_user($dbh, $email, $password_hash) {
    $sth = $dbh->prepare("INSERT INTO auth_user (email, password_hash) VALUES (:email, :password_hash)");
    $sth->execute(["email" => $email, "password_hash" => $password_hash]);
    $sth = $dbh->prepare("SELECT id, email FROM auth_user WHERE email = :email");
    $sth->execute(["email" => $email]);
    return $sth->fetch();
}

function fetch_user_to_login($dbh, $email) {
    $sth = $dbh->prepare("SELECT id, email, password_hash FROM auth_user WHERE email = :email");
    $sth->execute(["email" => $email]);
    return $sth->fetch();
}

function fetch_posts($dbh) {
    $sth = $dbh->prepare("SELECT p.id, p.title, p.content, p.created_at, u.email 
                          FROM post p LEFT JOIN auth_user u ON p.auth_user = u.id 
                          ORDER BY p.created_at DESC");
    $sth->execute();
    return $sth->fetchAll();
}

function create_post($dbh, $user_id, $title, $content) {
    $sth = $dbh->prepare("INSERT INTO post (auth_user, title, content) VALUES (:user, :title, :content)");
    $sth->execute(["user" => $user_id, "title" => $title, "content" => $content]);
    return $sth->rowCount();
}