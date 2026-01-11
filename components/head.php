<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Microblog</title>
</head>
<body>
    <nav>
        <a href="/microblog/">Home</a>
        <?php if (empty($_SESSION["auth_user"])): ?>
            <a href="/microblog/signup.php">Signup</a>
            <a href="/microblog/login.php">Login</a>
        <?php else: ?>
            <a href="/microblog/profile.php">Profile</a>
            <a href="/microblog/logout.php">Logout</a>
        <?php endif; ?>
    </nav>