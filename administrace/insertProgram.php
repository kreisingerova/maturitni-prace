<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
<!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání sálu a programu do databáze -->
<?php if (@$_SESSION["id_role"] == "1") { ?>
<h1>Programy</h1>
<form method="post" action="insertProgram.php">
    <label>3D</label>
    <select type="text" name="3D">
        <option value="2">Ano</option>
        <option value="1">Ne</option>
    </select>
    <br>
    <label>Jméno sálu ve kterém se program vysílá</label>
    <input type="text" name="name_hall2" />
    <br>
    <label>Název filmu</label>
    <input type="text" name="name_movie" />
    <br>
    <label>Datum a čas vysílání</label>
    <input type="datetime" name="datetime" value="rrrr-mm-dd 00:00:00" />
    <br>
    <label>cena</label>
    <input type="int" name="price" />
    <br>
    <label>Jazyk</label>
    <input type="text" name="language" />
    <br>
    <label>Konec předprodeje</label>
    <input type="datetime" name="datetime2" value="rrrr-mm-dd 00:00:00"/>
    <br>
    <input name="submit_program" type="submit" value="Odeslat"/>
</form>

<?php } ?>
<?php
require_once 'autoloader.php';
$submit_program = filter_input(INPUT_POST, "submit_program");

//pokud je formulář ohledně programů vyplněný a sál je v databázi, údaje se do ní zapíšou 
if (isset($submit_program)) {
    $name_hall2 = filter_input(INPUT_POST, "name_hall2");
    $name_movie = filter_input(INPUT_POST, "name_movie");
    $datetime = filter_input(INPUT_POST, "datetime");
    $datetime2 = filter_input(INPUT_POST, "datetime2");
    $language = filter_input(INPUT_POST, "language");
    $threeD = filter_input(INPUT_POST, "3D");
    $price = filter_input(INPUT_POST, "price");

        $getHall2 = Model::getHall2($name_hall2);
        $row = mysqli_fetch_assoc($getHall2);
        $id_salu = $row["id_salu"]; 
        
        $result = Model::getMovie($name_movie);
        $row2 = mysqli_fetch_assoc($result);
        $id_filmu = $row2["id_filmu"];
        if ($result->num_rows == 1) {
            
            $insertProgram = Model::insertProgram($threeD, $id_salu, $id_filmu, $datetime, $price, $language, $datetime2);
            if ($insertProgram) {
                echo 'Přidání programu bylo úspěšné';
            }
        } else {
            echo 'Přidání programu nebylo úspěšné';
        }
}
 include 'footer.php'; ?>
