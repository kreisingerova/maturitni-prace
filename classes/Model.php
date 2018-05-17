<?php

class Model {
    //vytvoření soly, která se následně používá na zahešování hesla
    const SALT = "fafakwnfkangeajekgna";
    //vyváří funkci, která vypíše údaje o programu z databáze
    public static function getProgram() {
        $query5 = "SELECT p.id_programu, p.datumcas, p.konec_predprodeje, f.nazev_filmu, sa.jmeno_salu, p.cena, tp.nazev
    FROM program p
    JOIN filmy f ON p.id_filmu = f.id_filmu
    JOIN typy_promitani tp ON p.id_typu_promitani = tp.id_typu_promitani
    JOIN saly sa ON p.jmeno_salu = sa.jmeno_salu 
    ORDER BY id_programu;";
        $result5 = MySQLDb::queryString($query5);
        $program = array();
        while ($row5 = mysqli_fetch_assoc($result5)) {
            $program[] = $row5;
        }
        return $program;
    }

    //vytváří funkci, která upraví data v databázi, konkrétně upraví její status a přidá id_zákazníka
    public static function updateSedacka($id_programu, $id_sedacky, $koupit, $id_zakaznika) {

        $query9 = "UPDATE `sedacky_program` SET
                                `id_status` = '$koupit',
                                `id_zakaznika` = '$id_zakaznika'
                                WHERE `id_sedacky` = '$id_sedacky' AND `id_promitani` = '$id_programu' LIMIT 1;";
        $result9 = MySQLDB::queryString($query9);
        return $result9;
    }

    //vytváří funkci, která ověřuje, zda byl email už registrován
    public static function getEmail($email) {
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        if ($result->num_rows == 0) {
            return FALSE;
        }
        return TRUE;
    }

    //vytváří funkci, která zapíše data nově registrovaného zákazníka do databáze
    public static function registrace($email, $name, $second_name, $hash) {
        $query2 = "insert into `zakaznici` values('', '0','registrovany', '', '$email', '$name', '$second_name' , '$hash');";
        $result2 = MySQLDb::queryString($query2);
        return $result2;
    }

    //vytváří funkci, která přihlásí uživatele tím, že zkontroluje zda se v databázi nachází email s tímto heslem a pak vypíše všechny informace
    public static function login($email, $password) {
        $hash = md5($password . self::SALT . $email);
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' AND `heslo` = '$hash' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    //vytváří funkci, která vypisuje data o jednotlivé sedačce
    public static function getsedacky($id_programu, $id_sedacky) {
        $query = "SELECT * FROM `program` p
                          JOIN `filmy` f ON p.id_filmu = f.id_filmu
                          JOIN `saly` s ON p.jmeno_salu = s.jmeno_salu
                          JOIN `sedacky_program` sed ON p.id_programu = sed.id_promitani
                          WHERE p.id_programu=$id_programu AND sed.id_sedacky=$id_sedacky
                          ORDER BY rada, cislo_rada";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    public function getSedacky2($id_programu, $id_sedacky) {
        $query = "SELECT * FROM `program` p
                          JOIN `sedacky_program` sed ON p.id_promitani = p.id_programu
                          WHERE p.id_programu=$id_programu AND sed.id_sedacky=$id_sedacky
                          ORDER BY rada, cislo_rada";
        $result = MySQLDb::queryString($query);
        return $result;
        
    }

    //vytváří funci, která vypisuje data o všech sedačkách u daného programu
    public static function getSedackyProgram($id_programu) {
        $query = "SELECT * FROM `sedacky_program` sp
                          JOIN `program` p ON sp.id_promitani = p.id_programu
                          JOIN `status` s ON sp.id_status = s.id_status
                          WHERE p.id_programu=$id_programu
                          ORDER BY rada, cislo_rada";
        $result = MySQLDB::queryString($query);

        return $result;
    }
    
}
