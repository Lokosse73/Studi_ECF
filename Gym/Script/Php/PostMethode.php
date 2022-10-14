<?php
$redText = null;
$email = null;
function random_str( // password Generator
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}
session_start();
if(!empty($_POST)) {
    if($_POST['token'] == $_SESSION['token']){
        //connection
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '1205' && !empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            require_once "Script/Php/ConnectSQL.php";
            $sql = "SELECT email FROM `connection` WHERE email = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('s', $email);

            $query->execute();

            $result = $query->get_result();
            if ($result->num_rows > 0) {
                $sql = "SELECT partner_id, struct_id, username , password, connectionLvl FROM `connection` WHERE password = ?;";

                $query = $link->prepare($sql);

                $query->bind_param('s', $password);

                $query->execute();

                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $username = $row['username'];
                        $partnerId = $row['partner_id'];
                        $structId = $row['struct_id'];
                        $connectionLvl = $row['connectionLvl'];

                        $sql = "SELECT * FROM `partner` WHERE client_id = ?";

                        $query = $link->prepare($sql);

                        $query->bind_param('i', $partnerId);

                        $query->execute();
                        $result = $query->get_result();
                        $row = mysqli_fetch_row($result);
                        if ($result->num_rows > 0) {
                            if($row[2] !== "Actif" && $connectionLvl === 0){
                                $redText = "Le partenaire qui vous représente n'est pas activé";
                                sleep(1);
                            }elseif($row[2] !== "Actif" && $connectionLvl === 1){
                                $redText = "Votre compte n'est pas activé";
                                sleep(1);
                            }
                        }
                        if($redText == null){
                            $sql = "SELECT * FROM `structure` WHERE struct_id = ?";

                            $query = $link->prepare($sql);

                            $query->bind_param('i', $structId);

                            $query->execute();
                            $result = $query->get_result();
                            $row = mysqli_fetch_row($result);
                            if ($result->num_rows > 0) {
                                if($row[3] !== "Actif" && $connectionLvl === 0){
                                    $redText = "Votre compte n'est pas activé";
                                    sleep(1);
                                }
                            }
                        }
                        if($redText == null){
                            $_SESSION['email'] = "$email";
                            $_SESSION['password'] = "$password";
                            $_SESSION['username'] = "$username";
                            $_SESSION['partner_id'] = "$partnerId";
                            $_SESSION['struct_id'] = "$structId";
                            $_SESSION['connectionLvl'] = "$connectionLvl";
                            $_SESSION['token'] = md5(time()*rand(175,658));

                            header('Location: index.php');
                            exit();
                        }
                    }
                }
                else{
                    $redText = "Mauvais mot de passe";
                    sleep(1);
                }
            }
            else{
                $redText = "Adresse email introuvable";
                $email = null;
                sleep(1);
            }
        }
        //déconnection
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '8462') {
            session_destroy();
            header('Location: index.php');
            exit();
        }
        //Add Partner
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '0512' && !empty($_POST['client_name'])){
            $email = htmlspecialchars($_POST['client_email']);
            $client_name = htmlspecialchars($_POST['client_name']);
            $active = "non actif";
            $short_description = htmlspecialchars($_POST['short_description']);
            $full_description = htmlspecialchars($_POST['full_description']);
            $logo_url = htmlspecialchars($_POST['logo_url']);
            $url = htmlspecialchars($_POST['url']);
            $dpo = htmlspecialchars($_POST['dpo']);
            $technical_contact = htmlspecialchars($_POST['technical_contact']);
            $commercial_contact = htmlspecialchars($_POST['commercial_contact']);


            $password = random_str(15);
            $connectionLvl = 1;


            require_once "Script/Php/ConnectSQL.php";
            $sql = "INSERT INTO `partner`(`client_name`, `active`, `short_description`, `full_description`, `logo_url`, `url`, `dpo`, `technical_contact`, `commercial_contact`, `accountMail`) 
                VALUES (?,?,?,?,?,?,?,?,?,?)";

            $query = $link->prepare($sql);

            $query->bind_param('ssssssssss',$client_name,$active,$short_description,$full_description,$logo_url,$url,$dpo,$technical_contact,$commercial_contact, $email);

            $query->execute();

            $id = mysqli_insert_id($link);

            $sql = "INSERT INTO `connection`(`partner_id`, `username`, `email`, `password`, `ConnectionLvl`) VALUES (?,?,?,?,?)";

            $query = $link->prepare($sql);

            $query->bind_param('isssi', $id, $client_name,$email,$password,$connectionLvl);

            $query->execute();
            header('Location: index.php');
            exit();
        }
        //Change Active Partner
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '1597' && !empty($_POST['client_id'])){
            $id = $_POST['client_id'];
            require_once "Script/Php/ConnectSQL.php";
            $sql = "SELECT * FROM `partner` WHERE client_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['active'] == 'Actif'){
                        $sql = "UPDATE `partner` SET `active` = 'non actif' WHERE client_id = ?;";
                    }
                    else{
                        $sql = "UPDATE `partner` SET `active` = 'Actif' WHERE client_id = ?;";
                    }
                    $query = $link->prepare($sql);

                    $query->bind_param('i', $id);

                    $query->execute();
                    header('Location: index.php');
                    exit();
                }
            }
        }
        //Delete Partner
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '7951' && !empty($_POST['client_id'])){
            $id = $_POST['client_id'];
            require_once "Script/Php/ConnectSQL.php";
            $sql = "DELETE FROM `connection` WHERE partner_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();

            $sql = "DELETE FROM `partner` WHERE client_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();

            $sql = "DELETE FROM `structure` WHERE client_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();
            header('Location: index.php');
            exit();
        }
        //Add Structure
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '1187' && !empty($_POST['owner_name'])){
            $email = htmlspecialchars($_POST['structure_email']);
            $owner_name = htmlspecialchars($_POST['owner_name']);
            $active = "non actif";
            $address = htmlspecialchars($_POST['address']);
            $contact = htmlspecialchars($_POST['contact']);

            $client_id = htmlspecialchars($_POST['client_id']);

            $password = random_str(15);
            $connectionLvl = 0;


            require_once "Script/Php/ConnectSQL.php";
            $sql = "INSERT INTO `structure`(`client_id`, `owner_name`, `active`, `address`, `contact`, `accountMail`) VALUES (?,?,?,?,?,?)";

            $query = $link->prepare($sql);

            $query->bind_param('isssss',$client_id, $owner_name,$active,$address,$contact, $email);

            $query->execute();

            $id = mysqli_insert_id($link);

            $sql = "INSERT INTO `connection`( `partner_id`, `struct_id`, `username`, `email`, `password`, `ConnectionLvl`) VALUES (?,?,?,?,?,?)";

            $query = $link->prepare($sql);

            $query->bind_param('iisssi', $client_id, $id, $owner_name,$email,$password,$connectionLvl);

            $query->execute();
            header('Location: index.php');
            exit();
        }
        //Change Active Structure
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '2864' && !empty($_POST['struct_id'])){
            $id = $_POST['struct_id'];
            require_once "Script/Php/ConnectSQL.php";
            $sql = "SELECT * FROM `structure` WHERE struct_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['active'] == 'Actif'){
                        $sql = "UPDATE `structure` SET `active` = 'non actif' WHERE struct_id = ?;";
                    }
                    else{
                        $sql = "UPDATE `structure` SET `active` = 'Actif' WHERE struct_id = ?;";
                    }
                    $query = $link->prepare($sql);

                    $query->bind_param('i', $id);

                    $query->execute();
                    header('Location: index.php');
                    exit();
                }
            }
        }
        //Delete Struture
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '5896' && !empty($_POST['struct_id'])){
            $id = $_POST['struct_id'];
            require_once "Script/Php/ConnectSQL.php";
            $sql = "DELETE FROM `connection` WHERE struct_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();

            $sql = "DELETE FROM `structure` WHERE struct_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();
            header('Location: index.php');
            exit();
        }
        //change perms Struture
        if(!empty($_POST['PostType']) && $_POST['PostType'] == '4682' && !empty($_POST['struct_id'])){
            $id = $_POST['struct_id'];

            $perms = implode(',', array($_POST['perms_0'], $_POST['perms_1'], $_POST['perms_2'], $_POST['perms_3'], $_POST['perms_4'], $_POST['perms_5']));
            require_once "Script/Php/ConnectSQL.php";
            $sql = "SELECT * FROM `structure` WHERE struct_id = ?;";

            $query = $link->prepare($sql);

            $query->bind_param('i', $id);

            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $sql = "UPDATE `structure` SET `perms` = ? WHERE struct_id = ?;";

                    $query = $link->prepare($sql);

                    $query->bind_param('si',$perms, $id);

                    $query->execute();
                    header('Location: index.php');
                    exit();
                }
            }
        }
    }
    else{
        $redText = 'token';
    }
}else{
    $redText = null;
    $email = null;
}