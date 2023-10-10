<?php
    require_once("libs/conf.php");
    global $yhendus;

    if (!empty($_REQUEST["teooriatulemus"])) {
        $tulemus = $_REQUEST["teooriatulemus"];

        if (!preg_match("#[A-z]#", $tulemus)) {
            $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
            $kask->bind_param("ii", $tulemus, $_REQUEST["id"]);
            $kask->execute();

            if ($tulemus >= 10) {
                header("Location:slaalom.php");
                exit();
            }
        } else {
            echo "!!!";
        }
    }

    $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus=-1");
    $kask->bind_result($id, $eesnimi, $perekonnanimi);
    $kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Teooriaeksam</title>
</head>
<body>
<?php
    include('navigation.php');
?>
<main>
    <table>
        <?php
        while($kask->fetch()){
            echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td><form action=''> 
 <input type='hidden' name='id' value='$id' /> 
 <input type='text' name='teooriatulemus' />
 <input type='submit' value='Sisesta tulemus' /> 
 </form> 
 </td> 
</tr> 
 ";
        }
        ?>
    </table>
</main>

</body>
</html>