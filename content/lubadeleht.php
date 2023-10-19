<?php
	global $yhendus;

	$kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus, slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
	$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus, $slaalom, $ringtee, $t2nav, $luba);
	$kask->execute();

	function asenda($nr) {
		if ($nr == -1) { return "."; } // tegemata
		if ($nr ==  1) { return "korras"; }
		if ($nr ==  2) { return "ebaõnnestunud"; }
		return "Tundmatu number";
	}
?>
<div class="container-fluid">
    <h1 class="display-5 mb-3">Lõpetamine</h1>
    <table class="table table-striped">
        <tr>
            <th>Eesnimi</th>
            <th>Perekonnanimi</th>
            <th>Teooriaeksam</th>
            <th>Slaalom</th>
            <th>Ringtee</th>
            <th>Tänavasõit</th>
            <th>Lubade väljastus</th>
            <th></th>
        </tr>
        <?php
            while ($kask->fetch()) {
                $asendatud_slaalom = asenda($slaalom);
                $asendatud_ringtee = asenda($ringtee);
                $asendatud_t2nav = asenda($t2nav);
                $loalahter = ".";
                $row_class = "";

                if ($luba == 1) {
                    $loalahter = "Väljastatud";
                    $row_class = "table-success";
                }

                if ($luba == -1 and $t2nav == 1) {
                    $loalahter = "<a href='?page=lubadeleht&vormistamine_id=$id'>Vormista load</a>";
                    $row_class = "table-warning";
                }

                echo " 
                    <tr class='$row_class'>
                        <td>$eesnimi</td> 
                        <td>$perekonnanimi</td> 
                        <td>$teooriatulemus</td> 
                        <td>$asendatud_slaalom</td> 
                        <td>$asendatud_ringtee</td> 
                        <td>$asendatud_t2nav</td> 
                        <td>$loalahter</td>
                        <td>
                            <a class='link-danger' href='?page=lubadeleht&kustutus_id=$id' onclick='return confirm(\"Kas ikka soovid kustutada?\")'>
                                <i class='fa-solid fa-trash'></i>
                            </a>
                        </td>
                    </tr> 
                ";
            }
        ?>
    </table>
</div>