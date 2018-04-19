<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <!-- zavolá funkci pro všechny uživatele, kteří se následně vypíší v tabulce -->
    <?php $result = Model::getAllUser(); ?>
    <table>
        <tr><td> id zákazníka </td> <td> status </td> <td> role </td> <td> email </td> <td> jméno </td> <td> příjmení </td></tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr> <td><?php echo $row["id_zakaznika"] . " " ?></td>
                <td><?php echo $row["status_zakaznika"] . " " ?></td>
                <td><?php if ($row["id_role"] == 0) {
                            echo 'Běžný uživatel ';
                          } else { echo 'administrátor ';} ?>
                </td>
                <td><?php echo $row["email"] . " "; ?></td>
                <td><?php echo $row["jmeno"] . " "; ?></td>
                <td><?php echo $row["prijmeni"] . " "; ?></td>
                <!-- vytvoří button, který přesune uživatele na detail zákazníka s možností upravit jeho účet -->
                <td><button><a style="color:black;" href="userDetail.php?id_zakaznika=<?php echo $row["id_zakaznika"] ?> "> detail uživatele</a></button></td></tr>
                    <?php
                }
                ?>
    </table>
</section>
<?php include 'footer.php'; ?>