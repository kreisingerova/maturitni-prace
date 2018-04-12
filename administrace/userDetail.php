<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<section>
    <?php
    $id_zakaznika = filter_input(INPUT_GET, "id_zakaznika");
    
    $submit = filter_input(INPUT_POST, "submit");
    if (isset($submit)) {
        $id_role = filter_input(INPUT_POST, "id_role");
        $status_zakaznika = filter_input(INPUT_POST, "status_zakaznika");
        $email = filter_input(INPUT_POST, "email");
        $jmeno = filter_input(INPUT_POST, "jmeno");
        $prijmeni = filter_input(INPUT_POST, "prijmeni");
        $password = filter_input(INPUT_POST, "password");
        $password2 = filter_input(INPUT_POST, "password2");

        if (isset($password) && isset($password2)) {
            if ($password == $password2) {
                $result = Model::updatePassword($email, $password, $id_zakaznika);
            }
        }
        if (isset($id_role)) {
            $result = Model::updateRole($id_role, $id_zakaznika);
        }
        
        if (isset($status_zakaznika)) {
            $result = Model::updateStatus($status_zakaznika, $id_zakaznika);
        }
        
        if (isset($email)) {
            $result = Model::updateEmail($email, $id_zakaznika);
        }
        
        if (isset($jmeno)) {
            $result = Model::updateName($jmeno, $id_zakaznika);
        }
        
        if (isset($prijmeni)) {
            $result = Model::updatePrijmeni($prijmeni, $id_zakaznika);
        }
        
    }
    
    $row = Model::getUser($id_zakaznika);
    echo $row["id_zakaznika"] . " ";
     if($row["id_role"] == 0){
         echo 'Běžný uživatel';
     } else {
         echo 'administrátor';
    }
    echo  " " . $row["status_zakaznika"] . " " . $row["email"] . " " . $row["jmeno"] . " " . $row["prijmeni"] . "<br><br>";
    ?>
    
    <form method="post">
        <input type="hidden" name="id_user" value="<?php echo $row["id_zakaznika"]; ?>" />
        <label>role uživatele</label>
        <select type="text" name="id_role">
            <option value=" "> </option>
            <option value="0">Běžný uživatel </option>
            <option value="1">Administrátor </option>
        </select>
        <br>
        <label>Status</label>
        <input type="text" name="status_zakaznika" value="<?php echo $row["status_zakaznika"]; ?>" />
        <br>
        <label>email</label>
        <input type="text" name="email" value="<?php echo $row["email"]; ?>" />
        <br>
        <label>jméno</label>
        <input type="text" name="jmeno" value="<?php echo $row["jmeno"]; ?>" />
        <br>
        <label>přijmení</label>
        <input type="text" name="prijmeni" value="<?php echo $row["prijmeni"]; ?>" />
        <br>
        <label>heslo</label>
        <input type="password" name="password" />
        <br>
        <label>heslo pro kontrolu</label>
        <input type="password" name="password2" />
        <br>
        <input name="submit" type="submit" value="Odeslat"/>
    </form>

</section>
<?php include 'footer.php'; ?>