<?php
require_once 'db_func.php';
require_once 'pers_func.php';

if(!is_logged())
    exit;

if(@!is_empty($_POST["op"]))
{
    $op=@strtolower(secure_string($_POST["op"]));
    if($op == "del")
    {
        $t = @strtolower(secure_string($_POST["t"]));
        $id =  @strtolower(secure_string($_POST["id"]));
        if($t != "eg" && $t != "immeuble" && $t != "centre")
            exit;
        if(!is_empty($id)) {
           //echo "DELETE FROM centres WHERE UPPER(N) = UPPER('$id') ";
            if($t == "centre")
                db_execute("DELETE FROM centres WHERE UPPER(N) = UPPER('$id') ");
            else {
                $id = (int)$id;
                if($id>0)
                    db_execute("DELETE FROM $t WHERE ID = $id ");
            }
        }
        exit;
    }
}

?>