<header>
    <a href="index.php"><img src="banner1.jpg" /></a>
</header>
<!-- Vytváří menu pro uživatele, pokud je někdo přihlášený, napíše mu to pod jakým účtem je přihlášený a pokud není, dá mu to možnost registrace či přihlášení -->
<div class="menu">
    <button class="odkazy"><a href="index.php">Úvodní stránka</a></button><button class="odkazy"><a href="programList.php">Přehled programů</a></button> <?php if (!isset($_SESSION["email"])) { ?><button class="odkazy"><a href="registration.php">Registrace</a></button> <button class="odkazy"><a href="login.php">Přihlásit</a></button><?php } else {
        ?><button class="odkazy"><a href = "logout.php">Odhlásit se</a></button><button class="odkazy"><?php echo 'Jste přihlášený jako: ' . $_SESSION["email"]; ?></button><?php } ?>
</div>
