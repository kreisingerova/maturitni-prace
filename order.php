<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <?php
    //načítá to id programu z url adresy
    $id_programu = filter_input(INPUT_GET, "id_programu"); 
    //volá funkci pro načtení sedaček u daného programu
    $getSedackyProgram = Model::getSedackyProgram($id_programu);
    $rada = 0;
    ?>
    <table border="1">
    <?php
    //přiřazuje barvu jednotlivým sedačkám podle statusu
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
            //vytváří řadu
        if ($rada != $row7["rada"]) {
            ?> <tr> <?php
            ?><td><?php echo "Řada" . $row7["rada"] . ": "; ?> </td><?php
            }

            //vytváří jednotlivá pole, které znázorňují jednotlivé sedačky a po kliknutí na volnou sedačku to přesměruje uživatele na stránku, kde 
            // si jí bude moct buď rezervovat nebo koupit, pokuď má na u tohoto programu rezervovanou nějakou sedačku, ukáže se mu možnost zrušení
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
    <?php 
    ?>
    </section>
    <?php include 'footer.php'; ?>