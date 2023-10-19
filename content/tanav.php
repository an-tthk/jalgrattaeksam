<?php
	global $yhendus;

    $page_ = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

	$kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE slaalom=1 AND ringtee=1 AND (t2nav=-1 OR t2nav=2)");
	$kask->bind_result($id, $eesnimi, $perekonnanimi);
	$kask->execute();
?>

<div class="container-fluid">
    <h1 class="display-5 mb-3">Tänavasõit</h1>
    <table class="table table-striped">
        <?php
            while ($kask->fetch()) {
                echo "
                    <tr> 
                        <td class='align-middle'>$eesnimi</td> 
                        <td class='align-middle'>$perekonnanimi</td> 
                        <td> 
                            <a class='btn btn-success btn-sm' href='?page=$page_&korras_id=$id'>Korras</a> 
                            <a class='btn btn-warning btn-sm' href='?page=$page_&vigane_id=$id'>Ebaõnnestunud</a> 
                        </td> 
                    </tr> 
                ";
            }
        ?>
    </table>
</div>
