<?php
require_once 'libcollection.php';
startSession();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['id'])){
    $id = $_POST['id'];
    /***read book****/
    if (isset($_POST['read'])) { 
        db_connect();
        $result = retrive_book('generatedbooks', $id, '*');
        db_close();

        $location = 'storygen.php?title=' . urlencode($result['title']) . '&story='. 
        urlencode($result['story']) . "&hero=". urlencode($result['hero']) . '&villain=' . urlencode($result['villain']) .'&lair='. urlencode($result['lair']). '&page=0';
        header('location: ' . $location);
    
    /***edit book***/
    } elseif(isset($_POST['edit'])){
        $_SESSION['edit'] = $id;
        header('location: selection.php');
        
    /***delete book***/
    } elseif(isset($_POST['delete'])){
        delete_book($id);
        header('location: home.php');
    }
}
}
?>







