<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "functions/db.php";
    include "functions/sql.php";
    
    $user = fetch_user_to_login($dbh, $_POST["email"]);
    
    if ($user && password_verify($_POST["password"], $user->password_hash)) {
        $_SESSION["auth_user"] = $user;
        header("Location: /microblog/profile.php");
        exit;
    }
}
include 'components/head.php';
?>

<h1>Login</h1>
<form method="post">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php include 'components/footer.php'; ?>