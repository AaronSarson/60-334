<!-- NOTE: this code was modified from the given code in the previous projects folder-->
<?php
require_once 'libcollection.php';
generateHeader('Admin Page')
?>

<?php
if ($DB_FIRST_ADMIN_ONLY == FALSE)
{
?>
  <p>You must have administration permission</p>
<?php
/*Display a message indicating status of the below operations*/
} else {
    if(isset($_SESSION['message'])) {
    echo '<p id="message">' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);
}
?>
  <a href="dbinit.php">Initialize Database</a><br/>
  <a href="populatetables.php">Populate Database tables With Example Data</a><br />
<?php 
   db_connect();
   $users = number_of('users');
   $books = number_of('generatedbooks');
   db_close();
   echo '<p>Number of site users:' . $users . '</p>';
   echo '<p>Number of books created:' . $books . '</p>';
?>
  <p>Turn off administrator permission when complete.</p>
<?php
}
generateFooter();
?>





