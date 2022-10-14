<?php
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'gym_db';
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// create DataBase
$sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME;
$link->query($sql);
$db_selected = mysqli_select_db($link, DB_NAME);

$var = $link->query("SHOW TABLES LIKE 'connection'");
if($var->num_rows != 1){
    // create table 'connection' and add first admin
    $sql = "CREATE TABLE `connection` (
              `id` int(11) NOT NULL,
              `partner_id` int(11) NULL,
              `struct_id` int(11) NULL,
              `username` varchar(50) NOT NULL,
              `email` varchar(50) NOT NULL,
              `password` varchar(20) NOT NULL,
              `ConnectionLvl` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $link->query($sql);
    $sql = "ALTER TABLE `connection` ADD PRIMARY KEY (`id`);";
    $link->query($sql);
    $sql = "ALTER TABLE `connection` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
    $link->query($sql);
    $sql = "INSERT INTO `connection` (`id`, `username`, `email`, `password`, `ConnectionLvl`) VALUES
            (0, 'StudiAdminGym', 'studi-admin@gym.fr', '1205', 2);";
    $link->query($sql);
}


$var = $link->query("SHOW TABLES LIKE 'partner'");
if($var->num_rows != 1){
    // create table 'partner'
    $sql = "CREATE TABLE `partner` (
              `client_id` int(11) NOT NULL,
              `client_name` text NOT NULL,
              `active` text NOT NULL,
              `short_description` text NOT NULL,
              `full_description` text NULL,
              `logo_url` text NOT NULL,
              `url` text NOT NULL,
              `dpo` text NULL,
              `technical_contact` text NULL,
              `commercial_contact` text NULL,
              `accountMail` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $link->query($sql);
    $sql = "ALTER TABLE `partner` ADD PRIMARY KEY (`client_id`);";
    $link->query($sql);
    $sql = "ALTER TABLE `partner` MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;";
    $link->query($sql);
}


$var = $link->query("SHOW TABLES LIKE 'structure'");
if($var->num_rows != 1){
    // create table 'structure'
    $sql = "CREATE TABLE `structure` (
              `client_id` int(11) NOT NULL,
              `struct_id` int(11) NOT NULL,
              `owner_name` text NOT NULL,
              `active` text NOT NULL,
              `address` text NOT NULL,
              `contact` text NULL,
              `perms` text DEFAULT '',
              `accountMail` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $link->query($sql);
    $sql = "ALTER TABLE `structure` ADD PRIMARY KEY (`struct_id`);";
    $link->query($sql);
    $sql = "ALTER TABLE `structure` MODIFY `struct_id` int(11) NOT NULL AUTO_INCREMENT;";
    $link->query($sql);
}