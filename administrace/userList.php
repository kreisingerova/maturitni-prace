<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
<?php
    $result = Model::getAllUser();
        while ($row = mysqli_fetch_assoc($result)) {
    echo $row["id_zakaznika"] . " " . $row["id_role"] . " " . $row["status_zakaznika"] . " " . " " . $row["email"] . " " . $row["jmeno"] . " " . $row["prijmeni"] . " " ; ?>
    <button><a style="color:black;" href="userDetail.php?id_zakaznika=<?php echo $row["id_zakaznika"] ?> "> detail uživatele</a></button> <br>
<?php
}
?>
</section>
<?php include 'footer.php'; ?>