<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
<!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání sálu a programu do databáze -->
<?php if (@$_SESSION["id_role"] == "1") { ?>
<h1>Filmy</h1>
<form method="post" action="insertFilm.php">
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
$submit_movie = filter_input(INPUT_POST, "submit_movie");

if (isset($submit_movie)) {
    $name_movie2 = filter_input(INPUT_POST, "name_movie2");
    $pristupnost = filter_input(INPUT_POST, "pristupnost");
 
            $query13 = "insert into `filmy` values('', '$name_movie2', '$pristupnost');";
            $result13 = MySQLDb::queryString($query13);
            if ($result13) {
                echo 'Přidání filmu bylo úspěšné';
            }
        } 