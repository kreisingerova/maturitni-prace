<!-- když bude mít někdo dostatečná práva, zobrazí se mu odkaz na přidání programu a sálu do databáze -->
<?php //if (@$_SESSION["id_role"] == "1") { ?>
   <!-- <a href="insertion.php">Přidání programu a sálu</a> -->
<?php //} ?>
<header>
    <a href="index.php"><img src="banner1.jpg" /></a>
</header>
<div class="menu">
    <?php if (@$_SESSION["id_role"] == 1) { ?><button class="odkazy"><a href="insertion.php">Přidání do databáze</a></button> <?php } ?>
    <button class="odkazy"><a href="news.php">Novinky</a></button> <button class="odkazy"><a href="movieList.php">Přehled filmů</a></button> <button class="odkazy"><a href="programList.php">Přehled programů</a>
    </button> <?php if (!isset($_SESSION["email"])) { ?><button class="odkazy"><a href="registration.php">Registrace</a></button> <button class="odkazy"><a href="login.php">Přihlásit</a></button><?php } else {
        ?><button class="odkazy"><a href = "logout.php">Odhlásit se</a></button><button class="odkazy"><?php echo 'Jste přihlášený jako: ' . $_SESSION["email"]; ?></button><?php } ?>
</div>
