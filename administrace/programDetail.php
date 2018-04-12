<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <?php
    $id_programu = filter_input(INPUT_GET, "id_programu");
    
    $submit = filter_input(INPUT_POST, "submit");
    if (isset($submit)) {
        $id_typu_promitani = filter_input(INPUT_POST, "id_typu_promitani");
        $id_salu = filter_input(INPUT_POST, "id_salu");
        $nazev_filmu = filter_input(INPUT_POST, "nazev_filmu");
        $datumcas = filter_input(INPUT_POST, "datumcas");
        $cena = filter_input(INPUT_POST, "cena");
        $jazyk = filter_input(INPUT_POST, "jazyk");
        $konec_predprodeje = filter_input(INPUT_POST, "konec_predprodeje");

        if (isset($id_typu_promitani)) {
                $result = Model::updateTypPromitani($id_typu_promitani, $id_programu);
        }
        if (isset($id_salu)) {
            $result = Model::updateSalu($id_salu, $id_programu);
        }
        
        if (isset($nazev_filmu)) {
            $result = Model::updateFilm($nazev_filmu, $id_programu);
        }
        
        if (isset($datumcas)) {
            $result = Model::updateDatumCas($datumcas, $id_programu);
        }
        
        if (isset($cena)) {
            $result = Model::updateCena($cena, $id_programu);
        }
        
        if (isset($jazyk)) {
            $result = Model::updateJazyk($jazyk, $id_programu);
        }
        
        if (isset($konec_predprodeje)) {
            $result = Model::updateKonecPredprodeje($konec_predprodeje, $id_programu);
        }
        
    }
    
    $row = Model::getProgramU($id_programu);
    echo $row["id_programu"] . " ";
     if($row["id_typu_promitani"] == 1){
         echo ' 2D ';
     } else {
         echo ' 3D ';
    }
    echo  " " . $row["id_salu"] . " " . $row["id_filmu"] . " " . $row["datumcas"] . " " . $row["cena"] . " " . $row["jazyk"] . " " . $row["konec_predprodeje"] . "<br><br>";
    
    $id_filmu = $row["id_filmu"];
    $row2 = Model::getFilm($id_filmu);
    ?>
    
    <form method="post">
        <input type="hidden" name="id_programu" value="<?php echo $row["id_programu"]; ?>" />
        <label>typ promítání</label>
        <select type="text" name="id_typu_promitani">
            <option value="1">2D</option>
            <option value="2">3D</option>
        </select>
        <br>
        <label>jméno sálu</label>
        <input type="text" name="id_salu" value="<?php echo $row["id_salu"]; ?>" />
        <br>
        <label>Jméno filmu</label>
        <input type="text" name="nazev_filmu" value="<?php echo $row2["nazev_filmu"]; ?>" />
        <br>
        <label>Datum promítání</label>
        <input type="datetime" name="datumcas" value="<?php echo $row["datumcas"]; ?>" />
        <br>
        <label>cena</label>
        <input type="text" name="cena" value="<?php echo $row["cena"]; ?>" />
        <br>
        <label>jazyk</label>
        <input type="text" name="jazyk" value="<?php echo $row["jazyk"]; ?>" />
        <br>
        <label>konec předprodeje</label>
        <input type="datetime" name="konec_predprodeje" value="<?php echo $row["konec_predprodeje"]; ?>" />
        <br>
        <input name="submit" type="submit" value="Odeslat"/>
    </form>

</section>
<?php include 'footer.php'; ?>