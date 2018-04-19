<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
   <?php
    //načte z url adresy potřebné údaje a uloží je to do proměnné
    $id_programu = filter_input(INPUT_GET, "id_programu");
    $id_sedacky = filter_input(INPUT_GET, "id_sedacky");
    $koupit = filter_input(INPUT_GET, "koupit");
    $id_zakaznika = $_SESSION["id_zakaznika"];
    //zavolá funkci pro úpravu sedačky 
    $objednavka = Model::updateSedacka($id_programu, $id_sedacky, $koupit, $id_zakaznika);
    
    if ($koupit == 2) {
    echo 'sedačka byla úspěšně rezervovaná';
    } else {
    echo 'sedačka byla úspěšně koupená';
    }
    ?>
</section>
<?php include 'footer.php'; ?>

