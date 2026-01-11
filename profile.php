<?php
session_start();
if (!$_SESSION["auth_user"]) {
    header("Location: /microblog/login.php");
    exit;
}

include "functions/db.php";
include "functions/sql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    create_post($dbh, $_SESSION["auth_user"]->id, $_POST["title"], $_POST["content"]);
}

include 'components/head.php';
?>

<h1>Welcome, <?= $_SESSION["auth_user"]->email ?></h1>

<h2>Create Post</h2>
<form method="post">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <button type="submit">Post</button>
</form>

<?php include 'components/footer.php'; ?>