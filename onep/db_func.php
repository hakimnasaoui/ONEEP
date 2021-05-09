<?php

require_once("pers_func.php");
//require_once("mana.php");

define("_SERVER_", "localhost");
define("_USER_", "root");
define("_PASS_", "");
define("_DB_", "onep");

session_start();
//connect to the server and the main database and return the connection
function db_connect()
{
    $cn = @mysqli_connect(_SERVER_,_USER_,_PASS_);
    if(!$cn)
        return false;
    mysqli_query($cn,"SET NAMES 'utf8'");
    $db = mysqli_select_db($cn, _DB_);
    if(!$db)
        return false; //database not found
    return $cn;
}


function db_select($query)
{
    //echo $query;
    $cn = db_connect();
    if (strpos(strtolower($query), "select") === false) return false;
    $result = mysqli_query($cn,$query);
    $res = array();
    while($row = mysqli_fetch_assoc($result)) { $res[] = $row; }
    mysqli_close($cn);
    return $res;
}


function db_execute($query)
{
    //echo $query;
    $cn = db_connect();
    if (strpos(strtolower($query), "insert") === false &&
        strpos(strtolower($query), "update") === false &&
        strpos(strtolower($query), "delete") === false)
        return false;
    $result = mysqli_query($cn,$query);
    mysqli_close($cn);
    return true;
}


function crypt_pass($password)
{
    $salt = "NMO";
    $hashToStoreInDb = password_hash($password.$salt, PASSWORD_BCRYPT);
    return $hashToStoreInDb;
}

function check_crypted_pass_correct($password, $existingHashFromDb)
{
    $salt = "NMO";
    $isPasswordCorrect = password_verify($password.$salt, $existingHashFromDb);
    return $isPasswordCorrect ;
}


?>