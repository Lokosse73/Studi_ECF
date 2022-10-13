<div class="hidden" id="AddStructureScreen">
    <div class="form-comp">
        <div class="form-Panel">
            <form action="#" method="post">
                <h3>Ajouter une structure</h3>
                <label>Structure_email*<input type="email" name="structure_email" required></label>
                <label>Structure_name*<input type="text" name="owner_name" required></label>
                <label>Adresse*<input type="text" name="address" required></label>
                <label>Contact<input type="text" name="contact" ></label>
                <div style="display: flex; justify-content: space-between;">
                    <input type="hidden" value="1187" name="PostType">
                    <input type="hidden" value="" id="AddStructId" name="client_id">
                    <input class="greenButton" type="submit" value="Ajouter">
                    <input class="redButton" type="reset" onclick="HiddeElement('AddStructureScreen')" value="Annuler">
                </div>
            </form>
        </div>
    </div>
</div>