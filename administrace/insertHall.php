<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání sálu do databáze -->
    <?php if (@$_SESSION["id_role"] == "1") { ?>
        <h1>Sály</h1>
        <form method="post" action="insertHall.php">
            <label>Jméno sálu</label>
            <input type="text" name="name_hall" />
            <br>
            <label>Počet řad</label>
            <input type="int" name="rady" />
            <br>
            <label>Počet sloupců</label>
            <input type="int" name="sloupce" />
            <br>
            <input name="submit_hall" type="submit" value="Odeslat"/>
        </form>
    <?php } ?>
    <?php include 'footer.php'; ?>
    <?php
    require_once 'autoloader.php';
    $submit_hall = filter_input(INPUT_POST, "submit_hall");
//pokud je formulář na přidání sálu vyplněný uloží se údaje do proměnné 
    if (isset($submit_hall)) {
        $name_hall = filter_input(INPUT_POST, "name_hall");
        $rady = filter_input(INPUT_POST, "rady");
        $sloupce = filter_input(INPUT_POST, "sloupce");

        //volá funkci pro kontrolu, zda sál není už v databázi
        $getHall = Model::getHall($name_hall);
        if ($getHall == NULL) {
            //volá funkci pro vložení údajů do databáze
            $insertHall = Model::insertHall($name_hall, $rady, $sloupce);
            if ($insertHall == TRUE) {
                echo 'Přidání sálu bylo úspěšné';
                
            }
        }
        }
        