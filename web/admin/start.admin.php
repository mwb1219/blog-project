<?php

session_start();
$auid = (int)$input->session('auid');
$user = $db -> get("select * from adminuser where id='{$auid}'");
if(($auid < 1 || !is_array($user))  && defined('NOT_LOGIN') == FALSE){
    header("location:". ADM_PATH ."/login.php");
    exit;
}

