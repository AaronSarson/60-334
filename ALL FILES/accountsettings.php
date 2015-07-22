<?php
require_once 'libcollection.php';
generateHeader("Account Settings", array ("css/loginStyle.css", "css/navbar.css"));
generateNav();
?>
<div class="password" >
    <form method="POST" action="updateAccount.php">
        <fieldset id = "field">
          <h1>Account Settings</h1>
          <?php
            if (isset($_SESSION['message'])){
                echo '<p>' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']);
            }
          ?>
          <p class="ques">Please enter a new password:</p>
          <input id ="password" type="password" name="password" value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password']; unset($_SESSION['password']); } ?>"/><br/>
          <input type="submit" value="Update Password" name="pass" id="pass"/><br />
          <p class="ques">Delete your account:</p>
          <input type="submit" value="Delete Account" name="delete" id="delete"/><br />
        </fieldset>
      </form>
</div>
<?php
  generateFooter();
?>

