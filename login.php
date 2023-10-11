<?php
	require_once("libs/conf.php");
	global $yhendus;

	$tagasi = (isset($_REQUEST['tagasi']) && !empty($_REQUEST['tagasi'])) ? $_REQUEST['tagasi'] : "admin.php";
	if (!file_exists($tagasi)) {
		$tagasi = "admin.php";
	}

	session_start();
	if (isset($_SESSION['tuvastamine'])) {
		header('Location: ' . $tagasi);
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
			header('Location: ' . $tagasi);
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
	include('header.php');
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