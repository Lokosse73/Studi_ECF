<?php
    $_SESSION['token'] = md5(time()*rand(175,658));
?>
<div class="form-comp-connection">
    <div class="form-Panel">
        <form action="#" method="post">
            <img src="Image/Gym_Logo.png" width="100%">
            <?php
            echo "<p style='color: lightcoral;margin-bottom: 0;margin-top: 5px'>$redText</p>";
            ?>
            <label for="email">Email :
                <input type="email" name="email" <?php echo "value='$email'"; ?> required>
            </label>
            <label for="password">Mot de passe :
                <input type="password" name="password" required>
            </label>
            <div style="display: flex; justify-content: space-between;">
                <input type="hidden" value="1205" name="PostType">
                <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                <input class="greenButton" type="submit" value="Connection">
                <input class="redButton" type="reset" value="Annuler">
            </div>
        </form>
    </div>
    <footer>
        <?php
        $date = date("Y");
        echo "Gym © $date";
        ?>
    </footer>
</div>