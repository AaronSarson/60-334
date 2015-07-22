<?php
function validatePass($pass){
    //pass can only be 20 char long
    if (strlen($pass) > 20 || strlen($pass) == 0){
        return FALSE;
    }
    return TRUE;
}

function validateEmail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return TRUE;
    }
    return FALSE;
}
?>

