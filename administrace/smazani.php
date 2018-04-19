<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
   <?php
   //načítá id programu z url adresy
    $id_programu = filter_input(INPUT_GET, "id_programu");
   
    //ověřuje zda to chce administrátor vážně smazat
    ?>
    <form method="post" action="smazani.php">
        <input id="submit" name="submit" type="submit" value="Chcete tento program opravdu smazat?"/>
    </form>
    <?php
    //pokud uživatel klikne zavolá funkci pro smazání
    $submit = filter_input(INPUT_POST, "submit");
    if (isset($submit)){
        $smazani = Model::smazani($id_programu);
        if ($smazani) {
            echo 'mazání proběhlo úspěšně';
        }
    }
    ?>
    
</section>
<?php include 'footer.php'; ?>

