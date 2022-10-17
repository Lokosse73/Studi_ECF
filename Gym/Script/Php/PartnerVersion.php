<div>
    <form action="#" method="post">
        <input type="hidden" name="PostType" value="8462">
        <input class="redButton" type="submit" value="Déconnexion">
    </form>
    <?php
    require_once "Script/Php/ConnectSQL.php";
    $partnerId = $_SESSION['partner_id'];
    $sql = "SELECT * FROM `partner` WHERE client_id = ?";

    $query = $link->prepare($sql);

    $query->bind_param('i', $partnerId);

    $query->execute();
    $result = $query->get_result();
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
            $NewCard->loadClientsCardInPartnerSide();
        }
    }

    $sql = "SELECT * FROM `structure` WHERE client_id = ?";

    $query = $link->prepare($sql);

    $query->bind_param('i', $partnerId);

    $query->execute();
    $result = $query->get_result();
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
            $NewCard->loadStructureCardInStructSide();
        }
    }
    ?>
</div>