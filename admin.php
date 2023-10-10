<?php
session_start();
if (!isset($_SESSION['tuvastamine'])) {
    header('Location: login.php');
    exit();
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
    include('header.php');
    include('navigation.php');
?>
<main>
<h1>Salajane info</h1>
<p>Salainfo</p>
<form action="logout.php" method="post">
    <input type="submit" value="Logi välja" name="logout">
</form>
</main>
</body>
</html>