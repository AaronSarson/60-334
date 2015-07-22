<?php
require_once 'libcollection.php';
startSession();
$message = '';
$user = '';
$password = '';
generateHeader("Login", array("css/loginStyle.css"), array("http://code.jquery.com/ui/1.9.2/jquery-ui.js", "https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", "jquery/jqueryClock.js"));
?>
<div id="loginClock"></div>
<div class="password">
    <form action="tryLogin.php" method="POST">
        <fieldset>
          <h1>Login</h1>
          <?php
            if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                echo '<p>Incorrect username/password combination</p>';
            }
          ?>
          <p>Please enter your username:</p>
          <input type="text" name="username" value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; unset($_SESSION['username']);} ?>"/>
          <p class="ques">Please enter your password:</p>
          <input type="password" name="password" value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password']; unset($_SESSION['password']);} ?>"/><br />
          <input class="center1" type="submit" name="Button1" value="Login" />
          <input class="center2" type="reset" value="Reset" onclick="window.location.reload()"/>
        </fieldset>
        <div id="newUserLink"><a href="newuser.php">create an account</a></div>
        <br/>
      </form>
    </div>
<?php
  generateFooter();
?>
