<div>
    <div class="PartnerPanel visible" id="PartnerPanel">
        <div class="sticky-top" style="background-color: var(--color1); z-index: 10">
            <nav class="card greencard">
                <div>
                    <form action="#" method="post">
                        <input style="margin-bottom: 10px" class="redButton" type="submit" value="Déconnexion">
                        <br>
                        <input type="text" placeholder="client_name" id="NameSearch">
                        <input type="text" placeholder="client_id" id="IdSearch">
                        <input type="hidden" name="PostType" value="8462">
                    </form>
                </div>
                <div>
                    <button onclick="ClickActif()" class="user-select-none">actif</button>
                    <button onclick="ClickNonActif()" class="user-select-none">non actif</button>
                    <button onclick="ClickTous()" class="user-select-none">Tous</button>
                </div>
                <button class="user-select-none" style="position: fixed; bottom: 10px; right: 10px; width: 50px;height: 50px;border-radius: 50px" onclick="ChowElement('tuto')">?</button>
            </nav>
            <div class="greenButton user-select-none" style="margin: 10px 5px 5px 5px;" onclick="ChowElement('AddClientScreen')">Ouvrir l'accès à un autre partenaire</div>
        </div>
        <main class="grid">
            <?php
            require_once "Script/Php/ConnectSQL.php";

            $sql = "SELECT * FROM `partner`";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $client_id = $row['client_id'];
                    $client_name = $row['client_name'];
                    $active = $row['active'];
                    $short_description = $row['short_description'];
                    $full_description = $row['full_description'];
                    $logo_url = $row['logo_url'];
                    $url = $row['url'];
                    $dpo = $row['dpo'];
                    $technical_contact = $row['technical_contact'];
                    $commercial_contact = $row['commercial_contact'];
                    $accountMail = $row['accountMail'];
                    require_once "Script/Php/Class/CLIENTS.php";
                    $NewCard = new CLIENTS($client_id, $client_name, $active, $short_description, $full_description, $logo_url, $url, $dpo, $technical_contact, $commercial_contact, $accountMail);
                    $NewCard->loadClientsCard();
                }
            }
            ?>
        </main>
    </div>
    <div class="StructurePanel hidden" id="StructurePanel">
        <div class="greenButton user-select-none" style="margin: 5px 5px 5px 5px;" onclick="ReturnPartner()">Retourner a la page des partenaires</div>
        <?php
        require_once "Script/Php/ConnectSQL.php";

        $sql = "SELECT * FROM `partner`";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $client_id = $row['client_id'];
                $client_name = $row['client_name'];
                $active = $row['active'];
                $short_description = $row['short_description'];
                $full_description = $row['full_description'];
                $logo_url = $row['logo_url'];
                $url = $row['url'];
                $dpo = $row['dpo'];
                $technical_contact = $row['technical_contact'];
                $commercial_contact = $row['commercial_contact'];
                $accountMail = $row['accountMail'];
                require_once "Script/Php/Class/CLIENTS.php";
                $NewCard = new CLIENTS($client_id, $client_name, $active, $short_description, $full_description, $logo_url, $url, $dpo, $technical_contact, $commercial_contact, $accountMail);
                $NewCard->loadClientsCardInStructure();
            }
        }?>
        <div class='greenButton user-select-none' style='margin: 5px;' onclick=ChowElement('AddStructureScreen')>Ouvrir l'accès à une autre structure</div>
        <nav class="card greencard">
            <div>
                <input type="text" placeholder="Structure_name" id="StructureNameSearch">
                <input type="text" placeholder="Structure_id" id="StructureIdSearch">
            </div>
            <button class="user-select-none" style="position: fixed; bottom: 10px; right: 10px; width: 50px;height: 50px;border-radius: 50px" onclick="ChowElement('tuto')">?</button>
        </nav>
        <main class="grid">
            <?php
            require_once "Script/Php/ConnectSQL.php";

            $sql = "SELECT * FROM `structure`";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $client_id = $row['client_id'];
                    $struct_id = $row['struct_id'];
                    $owner_name = $row['owner_name'];
                    $active = $row['active'];
                    $address = $row['address'];
                    $contact = $row['contact'];
                    $perms = $row['perms'];
                    $accountMail = $row['accountMail'];
                    require_once "Script/Php/Class/STRUCTURE.php";
                    $NewCard = new STRUCTURE($client_id, $struct_id, $owner_name, $active, $address, $contact, $perms, $accountMail);
                    $NewCard->loadStructureCard();
                }
            }
            ?>
        </main>
    </div>
    <script src="Script/JavaScript/AdminScript.js"></script>
</div>
