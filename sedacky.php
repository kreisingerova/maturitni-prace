<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <h1>Objednat sedačku</h1>
    <?php
    $id_programu = filter_input(INPUT_GET, "id_programu");
    $id_sedacky = filter_input(INPUT_GET, "id_sedacky");
    
    $getSedacky = Model::getsedacky($id_programu, $id_sedacky);
    while ($row8 = mysqli_fetch_assoc($getSedacky)) {
        echo "Film: " . $row8["nazev_filmu"] . "<br> Sál: " . $row8["jmeno_druhu"] . "<br> Řada: " . $row8["rada"] . "<br> Sedačka: " . $row8["cislo_rada"] . "<br> Čas promítání: " . $row8["datumcas"] . "<br> Cena: " . $row8["cena"]; 
    }
    var_dump($getSedacky)
    ?>
    <br>
    <br>
    <a href="provestObjednavku.php?id_programu=<?php echo $id_programu ?>&id_sedacky=<?php echo $id_sedacky ?>&koupit=2">Rezervovat</a>
    <br>
    <a href="provestObjednavku.php?id_programu=<?php echo $id_programu ?>&id_sedacky=<?php echo $id_sedacky ?>&koupit=3">Koupit</a>
</section>
<?php include 'footer.php'; ?>