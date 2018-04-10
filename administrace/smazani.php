<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
   <?php
    $id_programu = filter_input(INPUT_GET, "id_programu");
   
    
    ?>
    <form method="post" action="smazani.php">
        <input id="submit" name="submit" type="submit" value="Chcete tento program opravdu smazat?"/>
    </form>
    <?php
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

