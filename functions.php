<?php
session_start();


$pdo = new PDO('mysql:host=localhost;dbname=portfolio;', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
function inputCleaning($name)
{
    if (!empty($_POST["$name"])) {
        return htmlspecialchars(addslashes($_POST["$name"]));
    } else {
        $error['empty'] = "The $name is required. ";
    }
}
function userConnected()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
