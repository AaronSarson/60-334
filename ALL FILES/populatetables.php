<?php
require_once 'libcollection.php';
startSession();
$list_of_users = array(
  array('username' => 'jonahHill@teksavvy.com', 'password' => 'abdcdef'),
  array('username' => 'mollie@gmail.com', 'password' => '1234567'),
  array('username' => 'kolby@teksavvy.com', 'password' => 'abc123')
);

$list_of_books = array(
    array ('username' => 'jonahHill@teksavvy.com', 'title' => 'My first story', 'story' => '2', 'hero' => 'Jack',
           'villain' => 'Giant', 'lair' => 'Castle'),
    array ('username' => 'jonahHill@teksavvy.com', 'title' => 'My second story', 'story' => '3', 'hero' => 'Red Riding Hood',
           'villain' => 'Witch', 'lair' => 'Gingerbread-house'),
    array ('username' => 'kolby@teksavvy.com', 'title' => 'The best story', 'story' => '1', 'hero' => 'Jack',
           'villain' => 'Wolf', 'lair' => 'Den')
);

db_connect();

while (count($list_of_users) != 0){
    $user = array_pop($list_of_users);
    db_add_new_user($user['username'], $user['password']);
}

while (count($list_of_books) != 0){
    $book = array_pop($list_of_books);
    db_add_new_book($book['username'], $book['title'], $book['story'], $book['hero'], $book['villain'], $book['lair']);
}

$message .= 'Tables populated successfully';
$_SESSION['message'] = $message;

header('location: adminPage.php');
?>

