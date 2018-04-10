<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <?php
    $id_programu = filter_input(INPUT_GET, "id_programu"); 
    $promitani = Model::getProgram($id_programu);
    
    $getSedackyProgram = Model::getSedackyProgram($id_programu);
    $rada = 0;
    ?>
    <table border="1">
    <?php
    while ($row7 = mysqli_fetch_assoc($getSedackyProgram)) {
        switch ($row7["id_status"]) {
            case 1;
                $color = "green";
                break;
            case 2;
                $color = "orange";
                break;
            case 3;
                $color = "red";
                break;
        }
        if ($rada != $row7["rada"]) {
            ?> <tr> <?php
            ?><td><?php echo "Řada" . $row7["rada"] . ": "; ?> </td><?php
            }


            $rada = $row7["rada"];
            ?> <td style="background-color: <?php echo $color ?>;">
                <?php if ($row7["id_status"] == 1) { ?>
                        <a href="sedacky.php?id_programu=<?php echo $row7["id_programu"] ?>&id_sedacky=<?php echo $row7["id_sedacky"] ?> "> <?php echo $row7["cislo_rada"] . "/" . $row7["rada"] . " " . $row7["nazev"]; ?></a>
                <?php
                } elseif ($_SESSION["id_zakaznika"] == $row7["id_zakaznika"]&&$row7["id_status"] == 2) { ?>
                        <a href="zrusit.php?id_programu=<?php echo $row7["id_programu"] ?>&id_sedacky=<?php echo $row7["id_sedacky"] ?> "> <?php echo $row7["cislo_rada"] . "/" . $row7["rada"] . " " . "Zrušit rezervaci";?></a>
               <?php } elseif ($_SESSION["id_zakaznika"] != $row7["id_zakaznika"]) {
                    echo $row7["cislo_rada"] . "/" . $row7["rada"] . " " . $row7["nazev"];
                } elseif ($_SESSION["id_zakaznika"] == $row7["id_zakaznika"]&&$row7["id_status"] == 3) {
                echo $row7["cislo_rada"] . "/" . $row7["rada"] . " " . $row7["nazev"];
            }
                ?> 
                </td> 
                    <?php
                    if ($rada != $row7["rada"]) {
                        ?> </tr> <?php
                     } } ?>
    </table>
              <!--  <table>
                    <tr><td><p>čas promítání</p></td> <td><?php // echo $row5["datumcas"]; ?></td></tr>
                    <tr><td><p>Název filmů</p></td> <td><?php // echo $row5["nazev_filmu"]; ?></td></tr>
                    <tr><td><p>číslo sálu</p></td> <td><?php // echo $row5["jmeno_salu"]; ?></td></tr>
                    <tr><td><p>cena</p></td> <td><?php // echo $row5["cena"]; ?></td></tr>
                    <tr><td><p>3D/2D</p></td> <td><?php // echo $row5["nazev"]; ?></td></tr>
                </table> -->
    <?php 
    ?>
    </section>
    <?php include 'footer.php'; ?>