<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <h1>Program</h1>
    <!-- tvoření tabulky pro přehled programů -->
    <table>
        <tr><td>datum a čas promítání </td> <td> název filmu </td> <td> číslo sálu </td> <td> cena lístku </td> <td> 2D/3D </td> <td></td> </tr>
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
                <!-- vytváří buttony které přesměrují administrátora na stránky, kde bude moct jednotlivé údaje upravit nebo smazat -->
                    <td><button><a href="programDetail.php?id_programu=<?php echo $row5["id_programu"] ?> " style="color:black;">Upravit</a></button></td>
            </tr>
            <br>
<?php }
                
?>
    </table>
</section>
<?php include 'footer.php'; ?>