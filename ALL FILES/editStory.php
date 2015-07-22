<?php
require_once 'libcollection.php';
startSession();
$storyEdit = FALSE;
if (isset($_POST['title']) && isset($_POST['hero']) && isset($_POST['villain']) && isset($_POST['story']) && isset($_POST['id'])){
    
    $title = strip_tags($_POST['title']);
    
    if ($title != ''){
    $storyEdit = TRUE; 
    $hero = $_POST['hero'];
    $villain = $_POST['villain'];
    $story = $_POST['story'];
    $id = $_POST['id'];
    $lair_list = array('Wolf' => 'Den', 'Witch' => 'Gingerbread-house', 'Giant' => 'Castle');
    $lair = $lair_list[$villain]; //select appropriate lair with respect to villain
    
    update_book($id, $title, $story, $hero, $villain, $lair);
    
    $location = 'storygen.php?title=' . urlencode($title) . '&story='. 
        urlencode($story) . "&hero=". urlencode($hero) . '&villain=' . urlencode($villain) .'&lair='. urlencode($lair). '&page=0';
    header('location: ' . $location);
    }
}

if ($storyEdit == FALSE){
    header('location: selection.php');
}