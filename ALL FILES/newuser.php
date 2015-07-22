<?php
require_once 'libcollection.php';
startSession();
$user = $pass = $conf = '';
generateHeader("Login", array ("css/loginStyle.css"), array("js/handleForm.js"));
if (isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['conf'])){
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $conf = $_SESSION['conf'];
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    unset($_SESSION['conf']);
}
?>
<div class="password" onmouseover="checkPasswordMatch();checkEmail();">
    <form onsubmit="isFormFilled(this);" method="POST" action="createNewUser.php">
        <fieldset id = "field">
          <h1>New User</h1>
          <?php
           if(isset($_SESSION['message'])){
               echo '<p>' . $_SESSION['message'] . '</p>';
               unset($_SESSION['message']);
           }
          ?>
          <p>Please enter your email:</p>
          <input id="email" type="text" name="username" value ="<?php echo $user ?>"onchange="checkEmail();" />
          <p id="emailVar"></p>
          <p class="ques">Please enter a password:</p>
          <input id = "password" type="password" name="password" value="<?php echo $pass ?>" onchange="checkPasswordMatch();"/>
           <p class="ques">Please confirm password:</p>
           <input id="confirmPass" type="password" name="passwordConfirm" value ="<?php echo $conf ?>"onchange="checkPasswordMatch();"/><br />
          <div >
          <p id="passwordComparison" ></p>
          <input class="center1" type="submit" name="Button1" value="Submit" />
          <input class="center2" type="reset" value="Reset" action="clear" onclick="window.location.reload()"/>
          </div>
        </fieldset>
      </form>
    </div>
<?php
  generateFooter();
?>

