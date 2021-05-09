<?php
require_once 'db_func.php';

function is_empty($v)
{
    return (!isset($v) || empty($v));
}


function is_email($email)
{
    $expression = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (preg_match($expression, $email))
        return true; //"Email format is correct!";
    else
        return false; //"Email format is NOT correct!";
}

function secure_string($str)
{
    //tested .. succeed 100 % B) :
    $cn = db_connect();
    $str = trim($str);
    $str = stripslashes($str);
    $str = mysqli_real_escape_string($cn, $str);
    $str = htmlspecialchars_decode($str);
    //$str = html_entity_decode($str,null,'UTF-8'/*'ISO-8859-15'*/);
    $str = htmlspecialchars($str);
    //$str = addcslashes($str, '%_');
    //$str = @addcslashes(/*addslashes*/mysqli_real_escape_string($cn, stripslashes((trim($str)))), '%_');
    return $str;
}

function as_float($val)
{
    if(is_empty($val)) return "NULL";
    preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
    return (float)$o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
}

function get_center_caption($n)
{
    $center = db_select("SELECT * FROM centres WHERE UPPER(N) = UPPER('$n')");
    return @$center[0]["CENTRE"];
}

function is_logged()
{
    return (isset($_SESSION["USER"]["USERNAME"]));
}

function round_it($dec, $precision)
{
    if(is_empty($dec))
        return "";
    return number_format((float)$dec, 2, '.', '');
}

function sum_col($assoc_array, $key_name)
{
    return array_sum(array_column($assoc_array, $key_name));
}


?>