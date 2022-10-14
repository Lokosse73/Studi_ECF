<?php
require_once("Script/Php/PostMethode.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light">
        <title>gym</title>
        <link rel="icon" href="Image/Gym_Logo.png">
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="Script/Css/style.css">
        <link rel="stylesheet" href="Script/Css/switchBox.css">
        <link href="https://fonts.cdnfonts.com/css/bahnschrift" rel="stylesheet">

    </head>
    <body>
    <?php
    if(!isset($_SESSION['email'])){
        require_once "Script/Php/connection.php";
    }else{
        if($_SESSION['connectionLvl'] == 0){
            //la version du site pour une structure
            require_once "Script/Php/StructureVersion.php";
        }elseif ($_SESSION['connectionLvl'] == 1){
            //le version du site pour un partenaire
            require_once "Script/Php/PartnerVersion.php";
        }elseif ($_SESSION['connectionLvl'] == 2){
            //le version du site pour un un admin
            require_once "Script/Php/AdminVersion.php";
            require_once "Script/Php/AddPartner.php";
            require_once "Script/Php/AddStructure.php";
            require_once "Script/Html/tuto.html";
        }
    }
    ?>
    </body>
</html>