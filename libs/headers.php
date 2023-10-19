<?php

global $yhendus;

session_start();

$page_ = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";
$page_check = !str_contains($page_, '.php') ? $page_ . '.php' : $page_;

$tagasi = (isset($_REQUEST['tagasi']) && !empty($_REQUEST['tagasi'])) ? $_REQUEST['tagasi'] : "registreerimine";
$tagasi_check = !str_contains($tagasi, '.php') ? $tagasi . '.php' : $tagasi;

if (!file_exists('content/' . $tagasi_check)) {
    $tagasi = "registreerimine";
}

$blocked = array(
    "ringtee.php",
    "slaalom.php",
    "tanav.php",
    "teooriaeksam.php",
    "lubadeleht.php"
);

if (!isset($_SESSION['tuvastamine']) && in_array($page_check, $blocked)) {
    header("Location: index.php?page=login&tagasi=$page_");
    exit();
}

if ($page_check == 'registreerimine.php') {
    if (isset($_REQUEST["sisestusnupp"])) {
        if (!empty($_REQUEST["eesnimi"])
            && !empty($_REQUEST["perekonnanimi"])
            && !preg_match("#[0-9]#", $_REQUEST["eesnimi"])
            && !preg_match("#[0-9]#", $_REQUEST["perekonnanimi"])) {

            $kask = $yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
            $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
            $kask->execute();
            $yhendus->close();

            header("Location: $_SERVER[PHP_SELF]?page=teooriaeksam");
            exit();
        } else {
            header("Location: $_SERVER[PHP_SELF]?page=$page_&errormsg=1");
            exit();
        }
    }
}

if ($page_check == 'teooriaeksam.php') {
    if (!empty($_REQUEST["teooriatulemus"])) {
        $tulemus = $_REQUEST["teooriatulemus"];

        if (!preg_match("#[A-z]#", $tulemus)) {
            $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
            $kask->bind_param("ii", $tulemus, $_REQUEST["id"]);
            $kask->execute();

            if ($tulemus >= 10) {
                header("Location: $_SERVER[PHP_SELF]?page=slaalom");
                exit();
            }
        } else {
            header("Location: $_SERVER[PHP_SELF]?page=$page_&errormsg=1");
            exit();
        }
    }
}

if ($page_check == 'ringtee.php') {
	if (!empty($_REQUEST["korras_id"])) {
		$kask = $yhendus->prepare("UPDATE jalgrattaeksam SET ringtee=1 WHERE id=?");
		$kask->bind_param("i", $_REQUEST["korras_id"]);
		$kask->execute();

		header("Location: $_SERVER[PHP_SELF]?page=tanav");
		exit();
	}

	if (!empty($_REQUEST["vigane_id"])) {
		$kask = $yhendus->prepare("UPDATE jalgrattaeksam SET ringtee=2 WHERE id=?");
		$kask->bind_param("i", $_REQUEST["vigane_id"]);
		$kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=$page_");
        exit();
	}
}

if ($page_check == 'slaalom.php') {
    if (!empty($_REQUEST["korras_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET slaalom=1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["korras_id"]);
        $kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=ringtee");
        exit();
    }

    if (!empty($_REQUEST["vigane_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET slaalom=2 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["vigane_id"]);
        $kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=$page_");
        exit();
    }
}

if ($page_check == 'tanav.php') {
    if (!empty($_REQUEST["korras_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET t2nav=1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["korras_id"]);
        $kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=lubadeleht");
        exit();
    }

    if (!empty($_REQUEST["vigane_id"])) {
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET t2nav=2 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["vigane_id"]);
        $kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=$page_");
        exit();
    }
}

if ($page_check == 'lubadeleht.php') {
	if (!empty($_REQUEST["vormistamine_id"])) {
		$kask = $yhendus->prepare("UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
		$kask->bind_param("i", $_REQUEST["vormistamine_id"]);
		$kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=$page_");
        exit();
	}

	if (!empty($_REQUEST["kustutus_id"])) {
		$kask = $yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
		$kask->bind_param("i", $_REQUEST["kustutus_id"]);
		$kask->execute();

        header("Location: $_SERVER[PHP_SELF]?page=$page_");
        exit();
	}
}

if ($page_check == 'login.php') {
    if (isset($_SESSION['tuvastamine'])) {
        header("Location: $_SERVER[PHP_SELF]?page=$tagasi");
        exit();
    }

    if (!empty($_POST['login']) && !empty($_POST['pass'])) {
        $login = htmlspecialchars(trim($_POST['login']));
        $pass = htmlspecialchars(trim($_POST['pass']));

        $sool = 'taiestisuvalinetekst';
        $kryp = crypt($pass, $sool);

        $kask = $yhendus->prepare("SELECT kasutaja FROM kasutajad WHERE kasutaja=? AND parool=?");
        $kask->bind_param("ss", $login, $kryp);
        $kask->bind_result($kasutaja);
        $kask->execute();

        if ($kask->fetch()) {
            $_SESSION['tuvastamine'] = 'misiganes';
            $_SESSION['kasutaja'] = $kasutaja;
            header("Location: $_SERVER[PHP_SELF]?page=$tagasi");
            exit();
        } else {
            header("Location: $_SERVER[PHP_SELF]?page=$page_&errormsg=1");
            exit();
        }
    }
}

if ($page_check == 'logout.php') {
    session_destroy();
    header("Location: $_SERVER[PHP_SELF]?page=$tagasi");
    exit();
}
