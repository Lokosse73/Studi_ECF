<div>
    <form action="#" method="post">
        <input type="hidden" name="PostType" value="8462">
        <input class="redButton" type="submit" value="Déconnexion">
    </form>
    <?php
    require_once "Script/Php/ConnectSQL.php";
    $structId = $_SESSION['struct_id'];
    $sql = "SELECT * FROM `structure` WHERE struct_id = ?";

    $query = $link->prepare($sql);

    $query->bind_param('i', $structId);

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