<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <h1>Program</h1>
    <!--
    $query5 = "SELECT p.id_programu, p.datumcas, f.nazev_filmu, sa.jmeno_salu, p.cena, sa.druh_salu, tp.nazev
    FROM program p
    JOIN filmy f ON p.id_filmu = f.id_filmu
    JOIN typy_promitani tp ON p.id_typu_promitani = tp.id_typu_promitani
    JOIN saly sa ON p.id_salu = sa.id_salu;";
    $result5 = MySQLDb::queryString($query5);
    -->
    <table>
        <tr><td>datum a čas promítání </td> <td> název filmu </td> <td> číslo sálu </td> <td> cena lístku </td> <td> druh sálu </td> <td> 2D/3D </td></tr>
        <?php //while ($row5 = mysqli_fetch_assoc($result5)) { 
         $promitani = Model::getProgram();
                foreach ($promitani as $row5) {
        ?>
            <tr>
                <td><?php echo $row5["datumcas"]; ?></td>
                <td><?php echo $row5["nazev_filmu"]; ?> </td>
                <td><?php echo $row5["jmeno_salu"]; ?></td>
                <td><?php echo $row5["cena"]; ?></td>
                <td><?php echo $row5["druh_salu"]; ?></td>
                <td><?php echo $row5["nazev"]; ?></td>
                <?php
                $now = new DateTime();
               
                
                    
                
                $datumPredprodeje = new DateTime($row5['datumcas']);
                ?>
                    <td><button><a href="smazani.php?id_programu=<?php echo $row5["id_programu"] ?> " style="color:black;">Smazat</a></button></td>
                    <td><button><a href="programDetail.php?id_programu=<?php echo $row5["id_programu"] ?> " style="color:black;">Upravit</a></button></td>
            </tr>
            <br>
<?php }
                
?>
    </table>
</section>
<?php include 'footer.php'; ?>