<?php

class Model {
    //vytvoření soly, která se následně používá na zahešování hesla
    const SALT = "fafakwnfkangeajekgna";

    //vyváří funkci, která vypíše údaje o programu z databáze
    public static function getProgram($id_programu = null) {
        $where = "";
        if (isset($id_programu)) {
            $where = "WHERE p.id_programu='$id_programu'";
        }

        $query5 = "SELECT p.id_programu, p.datumcas, f.nazev_filmu, sa.jmeno_salu, p.cena, tp.nazev
    FROM program p
    JOIN filmy f ON p.id_filmu = f.id_filmu
    JOIN typy_promitani tp ON p.id_typu_promitani = tp.id_typu_promitani
    JOIN saly sa ON p.jmeno_salu = sa.jmeno_salu
    $where ;";
        $result5 = MySQLDb::queryString($query5);
        $program = array();
        while ($row5 = mysqli_fetch_assoc($result5)) {
            $program[] = $row5;
        }
        return $program;
    }

    //vytváří funkci, která přihlásí uživatele tím, že zkontroluje zda se v databázi nachází email s tímto heslem a pak vypíše všechny informace
    public static function login($email, $password) {
        $hash = md5($password . self::SALT . $email);
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' AND `heslo` = '$hash' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    //vytváří funkci, která kontroluje zda už není daný sál v databázi 
    public static function getHall($name_hall) {
        $query = "SELECT * FROM `saly` WHERE `jmeno_salu` = '$name_hall' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //vytváří funkci, která vkládá jednotlivá data o sálu do databáze
    public static function insertHall($name_hall, $rady, $sloupce) {
        $query = "insert into `saly` values('$name_hall', '$rady', '$sloupce');";
        $result = MySQLDb::queryString($query);
        return $result;
    }

    //vytváří funkci, která kontroluje zda je daný film v databázi
    public static function getMovie($name_movie) {
        $query = "SELECT * FROM `filmy` WHERE `nazev_filmu` = '$name_movie' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        return $result;
    }

    //vytváří funkci, která vkládá nový program do databáze
    public static function insertProgram($threeD, $name_hall, $id_filmu, $datetime, $price, $language, $datetime2) {
        $query = "insert into `program` values('', '$threeD', '$name_hall' ,'$id_filmu', '$datetime', '$price', '$language', '$datetime2');";
        $result = MySQLDb::queryString($query);
            return $result;
        }

    //vytváří funkci, která program maže
    public static function smazani($id_programu) {
        $query = "DELETE FROM `program` WHERE `id_programu` = '$id_programu' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        return $result;
    }

    //vytváří funkci, která vypisuje všechny uživatele z databáze
    public static function getAllUser() {
        $query = "SELECT * FROM `zakaznici`";
        $result = MySQLDb::queryString($query);
        return $result;
    }

    //vytváří funkci, která vypíše údaje o konkrétním uživateli
    public static function getUser($id_zakaznika) {
        $query = "SELECT * FROM `zakaznici` WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //vytváří funkci, která mění heslo konkrétnímu uživateli
    public static function updatePassword($email, $password, $id_zakaznika) {
        $salt = "fafakwnfkangeajekgna";
        $hash = md5($password . $salt . $email);
        $query = "UPDATE `zakaznici` SET `heslo` = '$hash' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění jméno konkrétnímu uživateli
    public static function updateName($jmeno, $id_zakaznika) {
        $query = "UPDATE `zakaznici` SET `jmeno` = '$jmeno' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění příjmení konkrétnímu uživateli
    public static function updatePrijmeni($prijmeni, $id_zakaznika) {
        $query = "UPDATE `zakaznici` SET `prijmeni` = '$prijmeni' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění roli konkrétnímu uživateli
    public static function updateRole($id_role, $id_zakaznika) {
        $query = "UPDATE `zakaznici` SET `id_role` = '$id_role' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění status konkrétnímu uživateli
    public static function updateStatus($status_zakaznika, $id_zakaznika) {
        $query = "UPDATE `zakaznici` SET `status_zakaznika` = '$status_zakaznika' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění email konkrétnímu uživateli
    public static function updateEmail($email, $id_zakaznika) {
        $query = "UPDATE `zakaznici` SET `email` = '$email' WHERE `id_zakaznika` = '$id_zakaznika';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která vypisuje údaje o konkrétním programu
    public function getProgramU($id_programu) {
        $query = "SELECT * FROM `program` WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    
    //vytváří funkci, která vypisuje údaje o konkrétním filmu
    public function getFilm($id_filmu) {
        $query = "SELECT * FROM `filmy` WHERE `id_filmu` = '$id_filmu';";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    
    //vytváří funkci, která mění typ promítání (jestli je 2D nebo 3D
    public function updateTypPromitani($id_typu_promitani, $id_programu) {
        $query = "UPDATE `program` SET `id_typu_promitani` = '$id_typu_promitani' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění jméno sálu u programu
    public function updateSalu($jmeno_salu, $id_programu) {
        $query = "UPDATE `program` SET `jmeno_salu` = '$jmeno_salu' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění film u konkrétního programu
    public function updateFilm($nazev_filmu, $id_programu) {
        $query = "SELECT * FROM `filmy` WHERE `nazev_filmu` = '$nazev_filmu';";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        $id_filmu = $row["id_filmu"];
        $query2 = "UPDATE `program` SET `id_filmu` = '$id_filmu' WHERE `id_programu` = '$id_programu';";
        $result2 = MySQLDb::queryString($query2);
        return $result2;
    }
    
    //vytváří funkci, která mění čas promítaní u programu
    public function updateDatumCas($datumcas, $id_programu) {
        $query = "UPDATE `program` SET `datumcas` = '$datumcas' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění cenu u programu
    public function updateCena($cena, $id_programu) {
        $query = "UPDATE `program` SET `cena` = '$cena' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění jazyk u programu
    public function updatejazyk($jazyk, $id_programu) {
        $query = "UPDATE `program` SET `jazyk` = '$jazyk' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    //vytváří funkci, která mění čas konce předprodeje u programu
    public function updateKonecPredprodeje($konec_predprodeje, $id_programu) {
        $query = "UPDATE `program` SET `konec_predprodeje` = '$konec_predprodeje' WHERE `id_programu` = '$id_programu';";
        $result = MySQLDb::queryString($query);
        return $result;
    }
}