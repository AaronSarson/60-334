<?php
require_once 'libcollection.php';
startSession();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /***read book****/
    if (isset($_POST['delete'])) { 
           delete_all_user_books();
           delete_user();
           logout();
           header('location: index.php');
    /***edit book***/
    } else{
        if (validatePass($_POST['password'])){
           update_user_pass($_POST['password']);
        } else {
            $_SESSION['message'] = 'Password must contain at least 1 character and no more than 20 characters.<br/>';
            $_SESSION['password'] = $_POST['password'];
        }
        header('location: accountsettings.php');
    }
}
?>
