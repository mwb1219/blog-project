<?php
class input {
    function post($key){
        if(isset($_POST[$key])){
            $value = $_POST[$key];
        }else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
    
    function get($key){
        if(isset($_GET[$key])){
            $value = $_GET[$key];
        }else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
    
    function cookie($key){
        /* @var $_COOKIE type */
        if(isset($_COOKIE[$key])){
            $value = $_COOKIE[$key];
        }else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
    
    function session($key){
        /* @var $_COOKIE type */
        if(isset($_SESSION[$key])){
            $value = $_SESSION[$key];
        }else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
}
