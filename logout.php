<?php

$tagasi = (isset($_REQUEST['tagasi']) && !empty($_REQUEST['tagasi'])) ? $_REQUEST['tagasi'] : "admin.php";
if (!file_exists($tagasi)) {
    $tagasi = "admin.php";
}

session_start();

if (!isset($_SESSION['tuvastamine'])) {
    header('Location: login.php?tagasi=' . $tagasi);
    exit();
}

if (isset($_REQUEST['logout'])) {
    session_destroy();
    header('Location: ' . $tagasi);
    exit();
}
?>