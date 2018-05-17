<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <div id="sedacky">
    <h1>Objednat sedačku</h1>
    <hr>
    <br>
    <?php
    // z url adresy se načtou potřebné údaje
    $id_programu = filter_input(INPUT_GET, "id_programu");
    $id_sedacky = filter_input(INPUT_GET, "id_sedacky");
    //zavolá se funkce pro detail o sedačce
    $getSedacky = Model::getsedacky($id_programu, $id_sedacky);
    while ($row8 = mysqli_fetch_assoc($getSedacky)) {
        echo "Film: " . $row8["nazev_filmu"] . "<br> Sál: " . $row8["jmeno_salu"] . "<br> Řada: " . $row8["rada"] . "<br> Sedačka: " . $row8["cislo_rada"] . "<br> Čas promítání: " . $row8["datumcas"] . "<br> Cena: " . $row8["cena"]; 
    }
    ?>
    <br>
    <br>
    <!-- vytvoří 2 tlačítka, jedno pro rezervování a druhé pro koupení -->
    <a href="provestObjednavku.php?id_programu=<?php echo $id_programu ?>&id_sedacky=<?php echo $id_sedacky ?>&koupit=2">Rezervovat</a>
    <br>
    <a href="provestObjednavku.php?id_programu=<?php echo $id_programu ?>&id_sedacky=<?php echo $id_sedacky ?>&koupit=3">Koupit</a>
    </div>
</section>
<?php include 'footer.php'; ?>