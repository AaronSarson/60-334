<?php
require_once 'libcollection.php';

startSession();

$result = TRUE;
$message = '';

try
{
  $result = generate_tables();
}
catch (PDOException $e)
{
  $result = FALSE;
}

if ($result == TRUE){
    $message .= 'Tables created successfully';
} else {
    $message .= 'ERROR : Table generation failed';
}

$_SESSION['message'] = $message;
header('location: adminPage.php');
?>

