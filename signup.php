<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "functions/db.php";
    include "functions/sql.php";
    
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $user = create_user($dbh, $_POST["email"], $password_hash);
    
    if ($user) {
        $_SESSION["auth_user"] = $user;
        header("Location: /microblog/profile.php");
        exit;
    }
}
include 'components/head.php';
?>

<h1>Signup</h1>
<form method="post">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Signup</button>
</form>

<?php include 'components/footer.php'; ?>