<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
<!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání sálu a programu do databáze -->
<?php if (@$_SESSION["id_role"] == "1") { ?>
<h1>Sály</h1>
<form method="post" action="insertion.php">
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

<h1>Programy</h1>
<form method="post" action="insertion.php">
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
    <input type="datetime" name="datetime" />
    <br>
    <label>cena</label>
    <input type="int" name="price" />
    <br>
    <label>Jazyk</label>
    <input type="text" name="language" />
    <br>
    <label>Konec předprodeje</label>
    <input type="datetime" name="datetime2" />
    <br>
    <input name="submit_program" type="submit" value="Odeslat"/>
</form>

<h1>Filmy</h1>
<form method="post" action="insertion.php">
    <label>Jméno filmu</label>
    <input type="text" name="name_movie2" />
    <br>
    <label>přístupnost</label>
    <select type="text" name="pristupnost">
        <option value="12">12+</option>
        <option value="15">15+</option>
        <option value="18">18+</option>
    </select>
    <br>
    <input name="submit_movie" type="submit" value="Odeslat"/>
</form>
</section>
<?php } ?>
<?php include 'footer.php'; ?>
<?php
require_once 'autoloader.php';
$submit_hall = filter_input(INPUT_POST, "submit_hall");
$submit_program = filter_input(INPUT_POST, "submit_program");
$submit_movie = filter_input(INPUT_POST, "submit_movie");

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
        
        $getMovie = Model::getMovie($name_movie);
        $row12 = mysqli_fetch_assoc($result12);
        $id_filmu = $row12["id_filmu"];
        if ($result3->num_rows == 1) {
            
            $insertProgram = Model::insertProgram($treeD, $id_salu, $id_filmu, $datetime, $price, $language, $datetime2);
            if ($insertProgram) {
                echo 'Přidání programu bylo úspěšné';
            }
        } else {
            echo 'Přidání programu nebylo úspěšné';
        }
}

if (isset($submit_movie)) {
    $name_movie2 = filter_input(INPUT_POST, "name_movie2");
    $pristupnost = filter_input(INPUT_POST, "pristupnost");
 
            $query13 = "insert into `filmy` values('', '$name_movie2', '$pristupnost');";
            $result13 = MySQLDb::queryString($query13);
            if ($result13) {
                echo 'Přidání filmu bylo úspěšné';
            }
        } 