<?php

class Model {

    const SALT = "fafakwnfkangeajekgna";

    public static function getProgram($id_programu = null) {
        $where = "";
        if (isset($id_programu)) {
            $where = "WHERE p.id_programu='$id_programu'";
        }

        $query5 = "SELECT p.id_programu, p.datumcas, f.nazev_filmu, sa.jmeno_salu, p.cena, sa.druh_salu, tp.nazev
    FROM program p
    JOIN filmy f ON p.id_filmu = f.id_filmu
    JOIN typy_promitani tp ON p.id_typu_promitani = tp.id_typu_promitani
    JOIN saly sa ON p.id_salu = sa.id_salu
    $where ;";
        $result5 = MySQLDb::queryString($query5);
        $program = array();
        while ($row5 = mysqli_fetch_assoc($result5)) {
            $program[] = $row5;
        }
        return $program;
    }

    public static function updateSedacka($id_programu, $id_sedacky, $koupit, $id_zakaznika) {

        $query9 = "UPDATE `sedacky_program` SET
                                `id_status` = '$koupit',
                                `id_zakaznika` = '$id_zakaznika'
                                WHERE `id_sedacky` = '$id_sedacky' AND `id_promitani` = '$id_programu' LIMIT 1;";
        $result9 = MySQLDB::queryString($query9);
        return $result9;
    }

    public static function getEmail($email) {
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        if ($result->num_rows == 0) {
            return FALSE;
        }
        return TRUE;
    }

    public static function registrace($email, $name, $second_name, $hash) {
        $query2 = "insert into `zakaznici` values('', '0','registrovany', '', '$email', '$name', '$second_name' , '$hash');";
        $result2 = MySQLDb::queryString($query2);
        return $result2;
    }

    public static function login($email, $password) {
        $hash = md5($password . self::SALT . $email);
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' AND `heslo` = '$hash' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    public static function getsedacky($id_programu, $id_sedacky) {
        $query = "SELECT * FROM `program` p
                          JOIN `filmy` f ON p.id_filmu = f.id_filmu
                          JOIN `saly` s ON p.id_salu = s.id_salu
                          JOIN `druhy_salu` d ON s.druh_salu = d.druh_salu
                          JOIN `sedacky` sed ON s.id_salu = sed.id_salu
                          WHERE p.id_programu=$id_programu AND id_sedacky=$id_sedacky
                          ORDER BY rada, cislo_rada";
        $result = MySQLDb::queryString($query);
        return $result;
    }

    public static function getSedackyProgram($id_programu) {
        $query = "SELECT * FROM `sedacky_program` sp
                          JOIN `program` p ON sp.id_promitani = p.id_programu
                          JOIN `status` s ON sp.id_status = s.id_status
                          JOIN `sedacky` sed ON sp.id_sedacky = sed.id_sedacky
                          WHERE p.id_programu=$id_programu
                          ORDER BY rada, cislo_rada";
        $result = MySQLDB::queryString($query);

        return $result;
    }

    public static function getHall($name_hall) {
        $query = "SELECT * FROM `saly` WHERE `jmeno_salu` = '$name_hall' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public static function insertHall($name_hall, $type) {
        $query = "insert into `saly` values('', '$name_hall', '$type');";
        $result = MySQLDb::queryString($query);
        if ($result->num_rows == 0) {
            return FALSE;
        }
        return TRUE;
    }
    
    public static function getHall2($name_hall2) {
        $query = "SELECT * FROM `saly` WHERE `jmeno_salu` = '$name_hall2' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    public static function getMovie($name_movie) {
        $query = "SELECT * FROM `filmy` WHERE `nazev_filmu` = '$name_movie' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        return $result;
    }
    
    public static function insertProgram($treeD, $id_salu, $id_filmu, $datetime, $price, $language, $datetime2) {
    $query = "insert into `program` values('', '$treeD', '$id_salu' ,'$id_filmu', '$datetime', '$price', '$language', '$datetime2');";
    $result = MySQLDb::queryString($query);
    if ($result->num_rows == 0) {
            return FALSE;
        }
        return TRUE;
    }
}
