<?php

require_once('config.php');

$db_connection_handle = NULL;

/*connect to database*/
function db_connect()
{
  global $DBUSER, $DBPASS, $DBNAME, $db_connection_handle;

  $db_connection_handle = 
    new PDO("mysql:host=localhost;dbname=$DBNAME", $DBUSER, $DBPASS);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db_connection_handle->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
}

function number_of($table){
    global $db_connection_handle;
    $sql = 'select * from `' . $table . '`'; 
    $st = $db_connection_handle->prepare($sql);
    $st->execute();
    
    if ($st == FALSE){
        return 0;
    } else {
        return $st->rowCount();
    }
    
}

/*close database*/
function db_close(){
    global $db_connection_handle;
    $db_connection_handle = NULL;
}

/*add a new user to database*/
function db_add_new_user($user, $pass)
{
  global $db_connection_handle;
  $adjusted_pass = sha1($pass);

  $user_array = array(':user' => $user, ':pass' => $adjusted_pass);

  $sql = 'INSERT INTO users (username,password) VALUES (:user, :pass)';
  $st = $db_connection_handle->prepare($sql);
  $st->execute($user_array);
}

/*add a new user to database*/
function db_add_new_book($user, $title, $story, $hero, $villain, $lair)
{
  global $db_connection_handle;

  $user_array = array(':user' => $user, ':t' => $title, ':s' => $story, ':h' => $hero, ':v' => $villain, ':l' => $lair);

  $sql = 'INSERT INTO generatedbooks (username,title,story,hero,villain,lair) VALUES (:user, :t, :s, :h, :v, :l)';
  $st = $db_connection_handle->prepare($sql);
  $st->execute($user_array);
}

function update_user_pass($newPass){
if (isset($_SESSION['username'])){ //user validated
   db_connect();
   global $_SESSION, $db_connection_handle;
   $user = $_SESSION['username'];
   $sql = "UPDATE users SET password = ? WHERE username = ?";
   $st = $db_connection_handle->prepare($sql);
   $st->execute(array(sha1($newPass), $user));
   db_close();
}
}

function update_book($id, $newtitle, $newstory, $newhero, $newvillain, $newlair){
   db_connect();
   global $_SESSION, $db_connection_handle;
   $sql = "UPDATE generatedbooks SET title = ?, story = ?, hero = ?, villain = ?, lair = ?  WHERE id = ?";
   $st = $db_connection_handle->prepare($sql);
   $st->execute(array($newtitle, $newstory, $newhero, $newvillain, $newlair, $id));
   db_close();
}
/*delete user*/
function delete_all_user_books(){
    db_connect();
    global $db_connection_handle, $_SESSION;
    $user = $_SESSION['username'];
    $sql = 'DELETE FROM generatedbooks WHERE username =  ?';
    $st = $db_connection_handle->prepare($sql);
    $st->execute(array($user));
    db_close();
}
/*delete user*/
function delete_user(){
    db_connect();
    global $db_connection_handle, $_SESSION;
    $user = $_SESSION['username'];
    $sql = 'DELETE FROM users WHERE username =  ?';
    $st = $db_connection_handle->prepare($sql);
    $st->execute(array($user));
    db_close();
}

/*is that username used already*/
function is_username_unique($usr){
   global $db_connection_handle;
   $sql = 'SELECT * FROM users WHERE username = :username';
   $st = $db_connection_handle->prepare($sql);  
   $st->bindParam(':username', $usr, PDO::PARAM_STR);
   $st->execute();
   $result = $st->fetch(PDO::FETCH_ASSOC);
   
   if ($result == FALSE){
       return TRUE;
   } else {
       return FALSE;
   }
}

function retrive_info($tableName, $usr, $colOfTable){
   global $db_connection_handle;
   $sql = 'SELECT ' . $colOfTable. ' FROM '. $tableName.' WHERE username = :username';
   $st = $db_connection_handle->prepare($sql);  
   $st->bindParam(':username', $usr, PDO::PARAM_STR);
   $st->execute();
   $result = $st->fetchAll(PDO::FETCH_ASSOC);
   return $result;
}

function retrive_book($tableName, $id, $colOfTable){
   global $db_connection_handle;
   $sql = 'SELECT ' . $colOfTable. ' FROM '. $tableName.' WHERE id = :id';
   $st = $db_connection_handle->prepare($sql);  
   $st->bindParam(':id', $id, PDO::PARAM_INT);
   $st->execute();
   $result = $st->fetch(PDO::FETCH_ASSOC);
   return $result;
}

function delete_book($id){
    db_connect();
    global $db_connection_handle;
    $sql = 'DELETE FROM generatedbooks WHERE id =  ?';
    $st = $db_connection_handle->prepare($sql);
    $st->execute(array($id));
    db_close();
}

function validate_login($username, $password){
   db_connect();
   $result = retrive_info('users', $username, '*');
   db_close();
   if (count($result) != 0){
   $userInfo = array_pop($result);
   if (substr(sha1($password), 0, 20) == $userInfo['password']){
       return TRUE;
   }
   }
   return FALSE;
  
}

function generate_tables(){
global $DB_FIRST_ADMIN_ONLY;

if ($DB_FIRST_ADMIN_ONLY == FALSE){
    return TRUE;
}
  try
  {
    db_connect();
    db_create_user_table();
    db_create_generatedbooks_table();
    return TRUE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
  db_close();
}

function db_create_user_table($drop = TRUE)
{
  global $db_connection_handle;

  if ($drop)
  {
    $sql = "DROP TABLE IF EXISTS users";
    $result = $db_connection_handle->exec($sql);
  }

$sql = <<<ZZEOF
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)
ZZEOF;
  $result = $db_connection_handle->exec($sql);

  return $result;
}

function db_create_generatedbooks_table($drop = TRUE)
{
  global $db_connection_handle;

  if ($drop)
  {
    $sql = "DROP TABLE IF EXISTS generatedbooks";
    $result = $db_connection_handle->exec($sql);
  }

$sql = <<<ZZEOF
CREATE TABLE generatedbooks (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  title VARCHAR(30) NOT NULL,
  story INT(11) NOT NULL,
  hero VARCHAR(30) NOT NULL,
  villain VARCHAR(30) NOT NULL,
  lair VARCHAR(30) NOT NULL,
  PRIMARY KEY (id)
)
ZZEOF;
  $result = $db_connection_handle->exec($sql);

return $result;
}
?>