<?php
require_once 'libcollection.php';
session_start();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){

$passConfirm = $_POST['passwordConfirm'];
$pass = $_POST['password'];
$usr = $_POST['username'];

if (validatePass($pass) && validateEmail($usr) && ($pass === $passConfirm) ){

/*connect to databasse*/
db_connect();
if (is_username_unique($usr)){
db_add_new_user($usr, $pass);
db_close();
$_SESSION['username'] = $usr;
header('Location: home.php');
} else {
     $_SESSION['message'] = '';
     $_SESSION['message'] = $usr . ' already exists';
}

db_close();
}
}
if (!isset($_SESSION['username'] )){
    
    $_SESSION['user'] = $usr;
    $_SESSION['pass'] = $pass;
    $_SESSION['conf'] = $passConfirm;
    if (!isset($_SESSION['message'])){
        $_SESSION['message'] = '';
    }
    if (!validatePass($pass)){
        $_SESSION['message'] .= 'Password must contain at least 1 character and no more than 20 characters.<br/>';
    }
    if (!validateEmail($usr)){
        $_SESSION['message'] .= 'Not a valid email.<br/>';
    }
    if ($pass != $passConfirm){
        $_SESSION['message'] .= 'Password fields do not match.<br/>';
    }
header('Location: newuser.php');
}
?>