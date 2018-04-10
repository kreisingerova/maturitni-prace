<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <!-- když někdo bude nepříhlášený, zobrazí se mu formulář na přihlášení -->
    <?php //if (!isset($_SESSION["email"])) { ?>
    <!-- <form method="post" action="login.php">
         <label>email</label>
         <input type="text" name="email" />
         <label>heslo</label>
         <input type="password" name="password" />
         <input name="submit" type="submit" value="Odeslat"/>
     </form> -->
    <?php
    // } else {
    // echo 'Jste přihlášený jako: ' . $_SESSION["email"] . "<br>";
    // echo 'Jste na indexu';
    ?>
    <?php // } ?>
    <!-- když bude mít někdo dostatečná práva, zobrazí se mu odkaz na přidání programu a sálu do databáze -->
    <?php //if (@$_SESSION["id_role"] == "1") { ?>
        <!-- <a href="insertion.php">Přidání programu a sálu</a> -->
    <?php //} ?>
    <!-- pokud někdo bude nepřihlášený, zobrazí se mu odkaz na registraci, nebo přihlášení -->
    <?php if (!isset($_SESSION["email"])) { ?>
        <!-- <a href="registration.php">Zaregistrovat se . </a>
         <a href="login.php">Přihlásit se <br></a> -->
        <?php
        //pokud někdo bude přihlášení, zobrazí se mu odkaz na ohlášení a objednání lístku 
        // } else {
        //$query = "SELECT * FROM `zakaznici`";
        //$result = MySQLDb::queryString($query);
        //while ($row = mysqli_fetch_assoc($result)) {
          //  echo $row["email"] . " ";
        //}
        ?>
        <!-- <a href = "logout.php">Odhlásit se . </a>
        <a href="order.php"> Objednat si lístek <br></a> -->
<?php } ?>
    <!-- <a href="userList.php">seznam uživatelů . </a> -->
    <!-- <a href="hallList.php">přehled sálů . </a> -->
    <!-- <a href="orderList.php">přehled objednávek . </a> -->
    <!-- <a href="insertion.php">přidání sálu/programu</a> -->
    <h1>obsah</h1>
</section>
<?php include 'footer.php'; ?>