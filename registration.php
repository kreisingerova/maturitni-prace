<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<!-- formulář pro registraci -->
<section>
    <div id="sedacky">
<h1>Registrace</h1>
<br>
<form method="post" action="registration.php">
    <label>Jméno</label>
    <input type="text" name="name" />
    <br>
    <label>Příjmení</label>
    <input type="text" name="second_name" />
    <br>
    <label>Email</label>
    <input type="email" name="email" />
    <br>
    <label>Heslo</label>
    <input type="password" name="password" />
    <br>
    <label>Kontrola hesla</label>
    <input type="password" name="password2" />
    <br>
    <input id="tlacitko" name="submit" type="submit" value="Registrovat"/>
</form>
    </div>
</section>
<?php include 'footer.php'; ?>
<?php
require_once 'autoloader.php';
$submit = filter_input(INPUT_POST, "submit");
$salt = "fafakwnfkangeajekgna";

//pokud je formulář vyplněný, naščtou se z něj údaje do proměnné 
if (isset($submit)) {
    $name = filter_input(INPUT_POST, "name");
    $second_name = filter_input(INPUT_POST, "second_name");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $password2 = filter_input(INPUT_POST, "password2");

    //poku se hesla rovnají, zavolá se funkce pro kontrolu, zda není email v databázi
    if ($password == $password2) {
        $registraceEmail = Model::getEmail($email);
            //heslo se zahashuje a zavolá se funkce pro registraci
            $hash = md5($password . $salt . $email);
            $registrace = Model::registrace($email, $name, $second_name, $hash);
            if ($registrace) {
                echo 'Registrace byla úspěšná';
            }
        } else {
            echo 'email už je zaregistrovaný';
        }
    } else {
        echo 'heslo není stejné';
    }
?>