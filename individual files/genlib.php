<?php

function generateNav(){
echo <<< ZZEOF
    <div id="nav">
        <h4 id="title">Storybook Generator</h4><br/>
        <ul id="navPrt2">
            <li><a href="home.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="accountsettings.php">Account Settings</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>
ZZEOF;
}
function generateHeader($title, $css = array(), $js = array())
{
  session_start();
  header('Content-Type: text/html');

  $title = htmlspecialchars($title);
  $link = $script = '';
  foreach ($css as $cssFile){
    $link .= '<link rel="stylesheet" type="text/css" href="'.$cssFile.'" />';
  }
  foreach ($js as $jsFile){
    $script .= '<script type="application/javascript" src="'.$jsFile.'"></script>';
  }
  echo <<<ZZEOF
<!DOCTYPE html>
<html>
<head>
  <title>$title</title>
ZZEOF;
if ($link != ''){ //css exists
  echo $link;
}
if ($script != ''){ //js exists 
  echo $script;
}
echo <<<ZZEOF
</head>
<body>
ZZEOF;
}

function generateFooter (){
    echo '</body></html>';
    exit(0);
}

function startSession(){
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
}

function canUserNavigateToPage(){
 global $_SESSION;
 if (!isset($_SESSION['username'])){
   header('Location: index.php'); 
 }
}

function logout(){
    global $_SESSION;
    unset($_SESSION['username']);
}
?>