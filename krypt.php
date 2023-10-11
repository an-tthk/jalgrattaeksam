<?php
	$parool = 'qwerty';
	$sool = 'taiestisuvalinetekst';
	$kryp = crypt($parool, $sool);

	echo $kryp;