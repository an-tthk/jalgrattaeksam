<?php
    require_once("libs/conf.php");
    global $yhendus;

    session_start();

    if (isset($_REQUEST["sisestusnupp"])) {
        if (!empty($_REQUEST["eesnimi"])
         && !empty($_REQUEST["perekonnanimi"])
         && !preg_match("#[0-9]#", $_REQUEST["eesnimi"])
         && !preg_match("#[0-9]#", $_REQUEST["perekonnanimi"])) {

            $kask = $yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
            $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
            $kask->execute();
            $yhendus->close();

            //header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
            header("Location:teooriaeksam.php");
            exit();
        } else {
            echo "!!!";
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
    include('header.php');
    include('navigation.php');
?>
<main>
    <h1>Registreerimine</h1>
    <form action="?">
        <dl>
            <dt>Eesnimi:</dt>
            <dd><input type="text" name="eesnimi" /></dd>
            <dt>Perekonnanimi:</dt>
            <dd><input type="text" name="perekonnanimi" /></dd>
            <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
        </dl>
    </form>
</main>
</body>
</html>