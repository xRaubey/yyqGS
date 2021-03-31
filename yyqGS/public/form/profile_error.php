<?php
require_once "../../private/initialize.php";
session_start();
$error1 = isset($_SESSION['ERROR1'])?$_SESSION['ERROR1']:'';
$error2 = isset($_SESSION['ERROR2'])?$_SESSION['ERROR2']:'';
unset($_SESSION['ERROR1']);
unset($_SESSION['ERROR2']);

if(!empty($error1) && !empty($error2)){
    echo $error1.",",$error2;
}
elseif (!empty($error1)){
    echo $error1;
}
elseif (!empty($error2)){
    echo $error2;
}