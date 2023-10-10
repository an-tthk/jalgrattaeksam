<?php
require_once("libs/conf.php");
global $yhendus;

session_start();
if (isset($_SESSION['tuvastamine'])) {
    header('Location: admin.php');
    exit();
}

if (!empty($_POST['login']) && !empty($_POST['pass'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));

    $sool = 'taiestisuvalinetekst';
    $kryp = crypt($pass, $sool);

    $paring = "SELECT * FROM kasutajad WHERE kasutaja='$login' AND parool='$kryp'";
    $valjund = mysqli_query($yhendus, $paring);

    if (mysqli_num_rows($valjund) == 1) {
        $_SESSION['tuvastamine'] = 'misiganes';
        header('Location: admin.php');
    } else {
        echo "kasutaja või parool on vale";
    }
}
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Kasutaja registreerimine</title>
</head>
<body>
<?php
include('navigation.php');
?>
<main>
<h1>Login</h1>
<form action="" method="post">
    Login: <input type="text" name="login"><br>
    Password: <input type="password" name="pass"><br>
    <input type="submit" value="Logi sisse">
</form>
</main>
</body>
</html>