
<?php include 'header.php'; ?>
<?php
//pokud je formulář vyplněný, uloží se údaje do proměnných
$submit = filter_input(INPUT_POST, "submit");

if (isset($submit)) {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    
    
    //volá funkci pro přihlášení
    $login = Model::login($email, $password);
    
    //pokud to uživatele přihlásilo, uloží se jednotlivé údaje z databáze do sessionu, který umožní pamatování si těchto údajů, dokud se uživatel neodhlásí
    if ($login != NULL) {
        $_SESSION["email"] = $email;
        $_SESSION["id_role"] = $login['id_role'];
        $_SESSION["id_zakaznika"] = $login['id_zakaznika'];
    }
        
    }
?>
    <?php include 'menu.php'; ?>
<section>
    <div id="sedacky">
    <!-- pokud někdo není přihlášení, nabídne mu to formulář pro přihlášení (registrace není v administrátorský sekci k dispozici) -->
        <?php  if (!isset($_SESSION["email"])) { ?>
        <form method="post" action="login.php">
            <label>email</label>
            <input type="text" name="email" />
            <br>
            <label>heslo</label>
            <input type="password" name="password" />
            <br>
            <input id="submit" name="submit" type="submit" value="Přihlásit"/>
        </form>
        <?php }  else {
     echo 'Jste přihlášený jako: ' . $_SESSION["email"];
     echo "<br>";
     
        ?>
        <?php } ?>
    </div>
        </section>
<?php include 'footer.php'; ?>


