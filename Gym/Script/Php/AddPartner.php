<div class="hidden" id="AddClientScreen">
    <div class="form-comp">
        <div class="form-Panel">
            <form action="#" method="post">
                <h3>Ajouter un partenaire</h3>
                <label>client_email*<input type="email" name="client_email" required></label>
                <label>client_name*<input type="text" name="client_name" required></label>
                <label>short_description*<input type="text" name="short_description" required></label>
                <label>full_description<input type="text" name="full_description" ></label>
                <label>logo_url*<input type="text" name="logo_url" required></label>
                <label>url*<input type="text" name="url" required></label>
                <label>dpo<input type="email" name="dpo" ></label>
                <label>technical_contact<input type="email" name="technical_contact" ></label>
                <label>commercial_contact<input type="email" name="commercial_contact" ></label>
                <div style="display: flex; justify-content: space-between;">
                    <input type="hidden" value="0512" name="PostType">
                    <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                    <input class="greenButton" type="submit" value="Ajouter">
                    <input class="redButton" type="reset" onclick="HiddeElement('AddClientScreen')" value="Annuler">
                </div>
            </form>
        </div>
    </div>
</div>