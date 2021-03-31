<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 11/2/17
 * Time: 4:40 PM
 */
    define("PRIVATE_PATH",dirname(__FILE__));
    define("PROJECT_PATE",dirname(PRIVATE_PATH));
    define("PUBLICE_PATE",PROJECT_PATE . "/public");
    define("SHARED_PATH",PRIVATE_PATH . "/shared");

    $public_end = strpos($_SERVER['SCRIPT_NAME'],'/public') +7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'],0, $public_end);
    define("WWW_ROOT",$doc_root);

    require_once 'functions.php';
    require_once 'database.php';

    $db = db_conntect();