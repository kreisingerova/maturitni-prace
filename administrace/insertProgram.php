<!-- vložení headru a menu -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <!-- když má někdo dostatečné oprávnění, zobrazí se mu formulář na přidání programu do databáze -->
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
            <input type="text" name="name_hall" />
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

//pokud je formulář ohledně programů vyplněný do proměnných se uloží jednotlivé údaje 
    if (isset($submit_program)) {
        $name_hall = filter_input(INPUT_POST, "name_hall");
        $name_movie = filter_input(INPUT_POST, "name_movie");
        $datetime = filter_input(INPUT_POST, "datetime");
        $datetime2 = filter_input(INPUT_POST, "datetime2");
        $language = filter_input(INPUT_POST, "language");
        $threeD = filter_input(INPUT_POST, "3D");
        $price = filter_input(INPUT_POST, "price");

        //volá funkci která kontroluje že v databázi daný film je
        $result = Model::getMovie($name_movie);
        $row2 = mysqli_fetch_assoc($result);
        $id_filmu = $row2["id_filmu"];
        if ($result->num_rows == 1) {

            //volá funkci pro vložení údajů z formuláře do databáze
            $insertProgram = Model::insertProgram($threeD, $name_hall, $id_filmu, $datetime, $price, $language, $datetime2);
            if ($insertProgram) {
                echo 'Přidání programu bylo úspěšné';
                
                //dotaz pro databázi, která vypíše daný program, u kterého potřebujeme zjistit id
                $query2 = "SELECT * FROM `program` WHERE `id_typu_promitani` = '$threeD' AND `jmeno_salu` = '$name_hall' AND `id_filmu` = '$id_filmu' AND `datumcas` = '$datetime' AND `cena` = '$price' AND `jazyk` = '$language' AND `konec_predprodeje` = '$datetime2' LIMIT 1;";
                $result2 = MySQLDb::queryString($query2);
                $row2 = mysqli_fetch_assoc($result2);
                
                //id a jméno sálu se uloží do proměnný
                $id_programu = $row2['id_programu'];
                $jmeno_salu = $row2['jmeno_salu'];   
                
                //dotaz pro databázi, která vypíše údaje o sálu
                $query100 = "SELECT * FROM `saly` WHERE `jmeno_salu` = '$jmeno_salu'";
                $result100 = MySQLDb::queryString($query100);
                $row100 = mysqli_fetch_assoc($result100);
                
                //uloží údaje do proměnné
                $sloupec = $row100['sloupce']; 
                $rada2 = $row100['rady'];  
                
                //vytváří jednotlivé sedačky podle toho kolik sloupců a řad jsme měli u sálu, ty se zapisují do databáze
                for ($rows = 1; $rows <= $rada2; $rows++) {
                    for ($columns = 1; $columns <= $sloupec; $columns++) {
                        $query4 = "INSERT INTO `sedacky_program` (`id_promitani`, `jmeno_salu`, `id_status`, `rada`, `cislo_rada`, `id_zakaznika`) VALUES('$id_programu', '$name_hall', '1', '$rows', '$columns', '0');";
                        $result4 = MySqlDb::queryString($query4);
                    }
                }

            }
        } else {
            echo 'Přidání programu nebylo úspěšné';
        }
    }
    include 'footer.php';
    ?>
