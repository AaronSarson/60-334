<?php 
require_once 'libcollection.php';
session_start();
canUserNavigateToPage();
db_connect();
$result = retrive_info('generatedbooks', $_SESSION['username'], '*');
db_close();
?>
<!DOCTYPE html>
<?php
  generateHeader("Home", array("css/homeStyle.css"), array("js/circle.js"));
  generateNav();
?>
    <div id="first">
    <p class="intro">Welcome to storybook generator!</p>
   <p> Here you have the opportunity to create your 
    own personal storybooks.  You pick a template, characters, and setting and leave
    the rest to us.</p>
    </div>
    <div id="content">
        <h4>Previous Works</h4>
        <p>Read previous works</p>
        <?php
        if (count($result) != 0){
        while (count($result) != 0) {
            $book = array_pop($result);
            
            echo <<<ZZEOF
            <form action="userAction.php" method="POST">
            <input type = "hidden" name="id" value="{$book['id']}"/>
            <label>{$book["title"]}</label>
            <input type="submit" name="read" id="read" value="read" />
            <input type="submit" name="edit" id="edit" value="edit"/>
            <input type="submit" name="delete" id="delete" value="delete"/>
            </form>
ZZEOF;
        }
        } else {
            echo '<p id="noBooksMessage">You have no books! Start creating today!</p>';
        }
        ?>
        <br/>
    </div>
    <div id="newWork">
        <h4>New Masterpiece</h4>
        <a href="selection.php">Create a new story</a>
    </div>
    <div>
      <?php
        makeCircle(1,'images/giant.jpg');
       ?>
    </div>
<?php 
 generateFooter();
?>

