<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require_once("./database.php");
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            die("LOGIN SUCCESSFUL");
        }
    }
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Signup
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>Login</h1>
    <?php if ($is_invalid) : ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>
