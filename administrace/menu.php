<!-- když bude mít někdo dostatečná práva, zobrazí se mu odkaz na přidání programu a sálu do databáze -->
<?php //if (@$_SESSION["id_role"] == "1") { ?>
   <!-- <a href="insertion.php">Přidání programu a sálu</a> -->
<?php //} ?>
<header>
    <a href="index.php"><img src="banner1.jpg" /></a>
</header>
<div class="menu">
    <?php if (@$_SESSION["id_role"] == 1) { ?><button class="odkazy"><a href="insertHall.php">Přidání sálů do databáze</a></button>
    <button class="odkazy"><a href="insertFilm.php">Přidání filmů do databáze</a></button> 
    <button class="odkazy"><a href="insertProgram.php">Přidání programů do databáze</a></button> 
    <button class="odkazy"><a href="userList.php">Přehled a úprava uživatelů</a></button> 
    <button class="odkazy"><a href="programList.php">Přehled programů</a>
    </button><button class="odkazy"><a href = "logout.php">Odhlásit se</a></button><button class="odkazy"><?php echo 'Jste přihlášený jako: ' . $_SESSION["email"]; ?></button>
    <?php } ?>
    <?php if (!isset($_SESSION["email"])) { ?><button class="odkazy"><a href="login.php">Přihlásit</a></button><?php }?>
</div>