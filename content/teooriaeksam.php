<?php
	global $yhendus;

	$kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus FROM jalgrattaeksam WHERE teooriatulemus < 9");
	$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus);
	$kask->execute();
?>

<div class="container-fluid">
    <h1 class="display-5 mb-3">Teooriaeksam</h1>
    <table class="table">
        <?php
            while ($kask->fetch()) {
                $tulemus_msg = $teooriatulemus == -1 ? "" : "Tulemus praegu: " . $teooriatulemus;
                echo " 
                    <tr> 
                        <td class='align-middle'>$eesnimi</td>
                        <td class='align-middle'>$perekonnanimi</td>
                        <td>
                            <div class='row g-2 col-sm-5 mx-5 my-2 align-items-center'>
                                <form method='post' action=''>
                                    <input type='hidden' name='id' value='$id' />
                                    <div class='input-group' aria-describedby='tulemus_block'>
                                        <input type='text' class='form-control form-control-sm' name='teooriatulemus' placeholder='Sisesta tulemus' />
                                        <button type='submit' class='btn btn-primary btn-sm'>OK</button>
                                    </div>
                                    <div id='tulemus_block' class='form-text'>$tulemus_msg</div>
                                </form>
                            </div>
                        </td> 
                    </tr> 
                ";
            }
        ?>
    </table>
</div>