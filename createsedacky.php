<!DOCTYPE hmtl>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
        
        /*
        for ($rows=1; $rows <= 10; $rows++) {
        for ($columns=1; $columns <= 20; $columns++){
            $sql = "
                    INSERT INTO `sedacky` (`id_salu`, `rada`, `cislo_rada`, `cena_sedacky`) 
                        VALUES            ( 	1 , $rows	, $columns	,	1 );
        ";
            echo $sql . "<br>";
        }
        }
         *
         */
        
        $idPromitani = 1;
        
         for ($seat=1; $seat <= 200; $seat++) {
        $sql2 = "
                INSERT INTO `sedacky_program` (`id_sedacky`, `id_promitani`, `id_status`)
VALUES ('$seat', '$idPromitani', '1'); ";
        
        echo $sql2 . "<br>"; 
        }
        
        $rada = $row["cislo_rada"];
        
        if ($rada != $row["cislo_rada"]) {
            echo "<br>";
        }
        ?>
    </body>
</html>

