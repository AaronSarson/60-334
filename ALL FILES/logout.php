<?php
require_once 'libcollection.php';
startSession();
logout();
header('location: index.php');
?>