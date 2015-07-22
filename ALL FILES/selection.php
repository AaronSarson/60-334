<?php // Selection.php
require_once 'libcollection.php';
startSession();
$book = '';
$book_to_edit = '';
$title = '';
$hero = '';
$villain = '';
$story = '';

if (isset($_SESSION['edit'])){
    //page now is for edit 
    $book_to_edit = $_SESSION['edit'];
    unset($_SESSION['edit']);
}

echo <<<_END
<html>
<head>
<title>Selection</title>
<style>
@import url('css/style2.css');
</style>
</head>
<body>
_END;

if ($book_to_edit == ''){
  echo '<form method="post" action="generateNewStory.php">';
}else{
   echo '<form method="post" action="editStory.php">';
  db_connect();
  $book = retrive_book('generatedbooks', intval($book_to_edit), '*');
  db_close();
  $title = $book['title'];
  $story = $book['story'];
  $hero = $book['hero'];
  $villain = $book['villain'];
}


echo <<<_END
<fieldset> 
<h1>Title:</h1>
<input type="text" name="title" value="$title" />
<br/>
<br/>
<br/>

<h1>Hero:</h1><br/>
<select name="hero" size="1">
_END;

$heros = array('Jack', 'Red Riding Hood', 'Hansel and Gretel');
foreach ($heros as $value) {
    echo '<option value="'. $value. '" ';
    if ($value == $hero){
        echo'selected="selected" ';
    }
    echo '> ' . $value . '</option>';
}

echo '</select> <br/>';

echo '<h1>villain:</h1><br/>';
echo '<select name="villain" size="1">';
$villains = array('Giant', 'Wolf', 'Witch');

foreach ($villains as $value) {
    echo '<option value="'. $value. '" ';
    if ($value == $hero){
        echo'selected="selected" ';
    }
    echo '> ' . $value . '</option>';
}

echo '</select> <br/>';



echo '<h1>Story:</h1><br/>';
echo '<select name="story" size="1">';
$stories = array('1' => 'Hensel and Gretel','2' => 'Jack the giant slayer', '3' => 'Little red riding hood' );
$count = 1;
foreach ($stories as $key => $value) {
    echo '<option value="'. $count. '" ';
    if ($key == $story){
        echo'selected="selected" ';
    }
    echo '> ' . $value . '</option>';
    $count += 1;
}

echo <<<_END
</select> <br/>
<input type="hidden" name="id" id="id" value="$book_to_edit" />
<input  type="image" src="images/button.jpg" id="buttons" type="submit" value="Done" />
<fieldset>
</form>
</body>
</html>
_END;
?>