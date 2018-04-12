<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
<!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání sálu a programu do databáze -->
<?php if (@$_SESSION["id_role"] == "1") { ?>
<h1>Sály</h1>
<form method="post" action="insertHall.php">
    <label>Jméno sálu</label>
    <input type="text" name="name_hall" />
    <br>
    <label>druh</label>
    <select type="text" name="type">
        <option value="1">Malý</option>
        <option value="2">Střední</option>
        <option value="3">Velký</option>
    </select>
    <br>
    <input name="submit_hall" type="submit" value="Odeslat"/>
</form>
<?php } ?>
<?php include 'footer.php'; ?>
<?php
require_once 'autoloader.php';
$submit_hall = filter_input(INPUT_POST, "submit_hall");
//pokud je formulář na přidání sálu vyplněný a jméno sálu ještě není v databázi, tak se do ní údaje uloží
if (isset($submit_hall)) {
    $name_hall = filter_input(INPUT_POST, "name_hall");
    $type = filter_input(INPUT_POST, "type");
    
        $getHall = Model::getHall($name_hall);
        if ($getHall == NULL) {
            $insertHall = Model::insertHall($name_hall, $type);
            if ($insertHall == TRUE) {
                echo 'Přidání sálu bylo úspěšné';
            }
        } else {
            echo 'sál už je v databázi';
        }
}
