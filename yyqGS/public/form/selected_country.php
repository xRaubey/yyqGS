<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/1/21
 * Time: 5:47 PM
 */

require_once "../../private/initialize.php";
session_start();


$_SESSION['country'] = mysqli_real_escape_string($db,$_POST['country']);
$country = $_SESSION['country'];
echo $country;