<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
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
        <a href="logout.php">Odhlásit se</a>
        <a href="index.php">Úvodní stránka</a> 
        <?php } ?>
        </section>
<?php include 'footer.php'; ?>
<?php

$submit = filter_input(INPUT_POST, "submit");

if (isset($submit)) {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    

    $login = Model::login($email, $password);
    var_dump($login);
    if ($login != NULL) {
        $_SESSION["email"] = $email;
        $_SESSION["id_role"] = $row['id_role'];
        $_SESSION["id_zakaznika"] = $row['id_zakaznika'];
    }
        
    }
?>

