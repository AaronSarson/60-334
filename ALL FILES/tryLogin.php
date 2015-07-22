<?php
require_once 'libcollection.php';
if (isset($_POST['username']) && isset($_POST['password'])){
    
startSession();

$pass = $_POST['password'];
$usr = $_POST['username'];

if (validate_login($usr, $pass)){
    $_SESSION['username'] = $usr;
    header('Location: home.php');
}
}

if(!isset($_SESSION['username'])){
    $_SESSION['password'] = $pass;
    $_SESSION['username'] = $usr;
    header('Location: index.php');
}
?>