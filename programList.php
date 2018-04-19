<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <h1>Program</h1>
    <!-- tvoření tabulky pro přehled programů -->
    <table>
        <tr><td>datu a čas promítání </td> <td> název filmu </td> <td> číslo sálu </td> <td> cena lístku </td><td> 2D/3D </td><td> konec předprodeje </td></tr>
        <?php 
        //volání funkce pro získání údajů o programu, který se následně uloží do proměnných
         $promitani = Model::getProgram();
                foreach ($promitani as $row5) {
        ?>
            <tr>
                <td><?php echo $row5["datumcas"]; ?></td>
                <td><?php echo $row5["nazev_filmu"]; ?> </td>
                <td><?php echo $row5["jmeno_salu"]; ?></td>
                <td><?php echo $row5["cena"]; ?></td>
                <td><?php echo $row5["nazev"]; ?></td>
                <td><?php echo $row5["konec_predprodeje"]; ?></td>
                <?php
                //získání momentálního času
                $now = new DateTime();
                //ukládá čas a datum konce předprodeje
                $datumPredprodeje = new DateTime($row5["konec_predprodeje"]);
                //pokud je někdo přihlášený a neskončil předprodej, zobrazí se tlačítko pro objednání, tudíž to uživatele přesměruje na detail sálu
                if (isset($_SESSION["email"])) {
                    if ($now <= $datumPredprodeje) {
                        ?>
                        <td><a href="order.php?id_programu=<?php echo $row5["id_programu"] ?> "> objednat</a> <br></td>
                        <?php } else {
                        ?>
                        <td> předprodej skončil </td>
                    <?php
                    }
                } else { ?>
                    <td>Pro objednání se musíte přihlásit</td>    
               <?php }
                ?>
            </tr>
            <br>
<?php }
                
?>
    </table>
</section>
<?php include 'footer.php'; ?>