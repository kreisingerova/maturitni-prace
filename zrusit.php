<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
   <?php
    $id_programu = filter_input(INPUT_GET, "id_programu");
    $id_sedacky = filter_input(INPUT_GET, "id_sedacky");
    $id_zakaznika = $_SESSION["id_zakaznika"];
    
    $query11 = "UPDATE `sedacky_program` SET
                                `id_status` = '1',
                                `id_zakaznika` = '0'
                                WHERE `id_sedacky` = '$id_sedacky' AND `id_promitani` = '$id_programu' AND `id_zakaznika` = '$id_zakaznika' LIMIT 1;";
    $result11 = MySQLDB::queryString($query11);
    echo 'Rezervace úspěšně zrušena'; ?>
</section>
<?php include 'footer.php'; ?>

