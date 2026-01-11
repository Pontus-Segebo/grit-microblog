<?php

session_start();

if (!$_SESSION["auth_user"]) {
    header(header: "Location: http://localhost:8080/microblog/login.php");
    die();
}

include "functions/db.php";
include "functions/sql.php";

if ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "GET") {
    $post_id = $_GET["id"];
    $auth_user_id = $_SESSION["auth_user"]->id;

    $post = fetch_post_to_edit($dbh, $auth_user_id, $post_id);
    
    if (!$post) {
        die("Unauthorized access");
    }
} elseif ($_SESSION["auth_user"] && $_SERVER["REQUEST_METHOD"] == "POST") {
    $auth_user_id = $_SESSION["auth_user"]->id;
    $post_id = $_POST["edit-post-id"];
    $post_title = $_POST["edit-post-title"];
    $post_content = $_POST["edit-post-content"];

    $post_edited = edit_post(
        $dbh,
        $auth_user_id,
        $post_id,
        $post_title,
        $post_content
    );

    if ($post_edited) {
        header(header: "Location: http://localhost:8080/microblog/post.php?id=$post_id");
    } else {
        die("Failed to edit post");
    }
}

$title = "Edit Post";
include 'components/head.php';
?>

<h1>Edit Post</h1>
<form action="/microblog/edit_post.php" method="post">
    <input type="text" name="edit-post-id" id="edit-post-id" value="<?= $post->post_id ?>" hidden>
    <div>
        <label for="edit-post-title">Title:</label>
        <input type="text" name="edit-post-title" id="edit-post-title" value="<?= $post->title ?>">
    </div>
    <div>
        <label for="edit-post-content">Content:</label>
        <textarea name="edit-post-content" id="edit-post-content">
            <?= $post->content ?>
        </textarea>
    </div>
    <button type="submit">Save Post</button>
</form>

<?php
include 'components/footer.php';
?>
