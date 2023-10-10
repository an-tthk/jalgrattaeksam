<?php
$serverinimi = "localhost";
$kasutajanimi = "an";
$parool = "qwerty";
$andmebaas = "an";
$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset('UTF8');