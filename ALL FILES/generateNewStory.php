<?php
require_once 'libcollection.php';
startSession();
$storyGenerated = FALSE;
if (isset($_POST['title']) && isset($_POST['hero']) && isset($_POST['villain']) && isset($_POST['story'])){
    
    $title = strip_tags($_POST['title']);
    
    if ($title != ''){
    $storyGenerated = TRUE; 
    $hero = $_POST['hero'];
    $villain = $_POST['villain'];
    $story = $_POST['story'];
    $user = $_SESSION['username'];
    $lair_list = array('Wolf' => 'Den', 'Witch' => 'Gingerbread-house', 'Giant' => 'Castle');
    $lair = $lair_list[$villain]; //select appropriate lair with respect to villain
    
    db_connect();
    db_add_new_book($user, $title, $story, $hero, $villain, $lair);
    db_close();
    
    $location = 'storygen.php?title=' . urlencode($title) . '&story='. 
        urlencode($story) . "&hero=". urlencode($hero) . '&villain=' . urlencode($villain) .'&lair='. urlencode($lair). '&page=0';
    header('location: ' . $location);
    } else {
        /*
    $_SESSION['hero'] = $_POST['hero'];
    $_SESSION['villain'] = $_POST['villain'];
    $_SESSION['story'] = $_POST['story']; */
    }
}

if ($storyGenerated == FALSE){
    header('location: selection.php');
}

