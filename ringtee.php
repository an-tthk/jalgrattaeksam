<?php
    require_once("libs/conf.php");
    global $yhendus;

    session_start();
    if (!isset($_SESSION['tuvastamine'])) {
        header('Location: login.php');
        exit();
    }

    if (!empty($_REQUEST["korras_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET ringtee=1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["korras_id"]);
        $kask->execute();
    }

    if (!empty($_REQUEST["vigane_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET ringtee=2 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["vigane_id"]);
        $kask->execute();
    }

    $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus>=9 AND (ringtee=-1 OR ringtee=2)");
    $kask->bind_result($id, $eesnimi, $perekonnanimi);
    $kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Ringtee</title>
</head>
<body>
<?php
    include('navigation.php');
?>
<main>
    <h1>Ringtee</h1>
    <table>
        <?php
        while($kask->fetch()){
            echo "
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td> 
 <a href='?korras_id=$id'>Korras</a> 
 <a href='?vigane_id=$id'>Ebaõnnestunud</a> 
 </td> 
</tr> 
 ";
        }
        ?>
    </table>
</main>
</body>
</html>