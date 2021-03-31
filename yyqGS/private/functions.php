<?php

    function url_for($script_path){
        if($script_path[0] != '/')
        {
            $script_path = '/' . $script_path;
        }
        return WWW_ROOT.$script_path;
    }

    function u($string){
        return urlencode($string);
    }
    function raw_u($string){
        return rawurldecode($string);
    }
    function h($string){
        return htmlspecialchars($string);
    }

    function is_post_request(){
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function is_get_request(){
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function redirect_to($location){
        header('Location:'.$location);
    }
?>