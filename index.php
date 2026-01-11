<?php
session_start();
include "functions/db.php";
include "functions/sql.php";
$posts = fetch_posts($dbh);
include 'components/head.php';
?>

<h1>Microblog</h1>
<?php foreach ($posts as $post): ?>
    <div>
        <h3><?= htmlspecialchars($post->title) ?></h3>
        <p><?= htmlspecialchars($post->content) ?></p>
        <small>by <?= htmlspecialchars($post->email) ?> at <?= $post->created_at ?></small>
    </div>
<?php endforeach; ?>

<?php include 'components/footer.php'; ?>