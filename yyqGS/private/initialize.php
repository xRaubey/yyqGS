<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 11/2/17
 * Time: 4:40 PM
 */

/**
 * Defined global variables that help local the files.
 */
    define("PRIVATE_PATH",dirname(__FILE__));
    define("PROJECT_PATH",dirname(PRIVATE_PATH));
    define("PUBLIC_PATH",PROJECT_PATH . "/public");
    define("SHARED_PATH",PRIVATE_PATH . "/shared");

    $public_end = strpos($_SERVER['SCRIPT_NAME'],'/public') +7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'],0, $public_end);
    define("WWW_ROOT",$doc_root);

    require_once 'functions.php';
    require_once 'database.php';

    $db = db_conntect();

    mysqli_set_charset($db, "utf8");