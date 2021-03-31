<?php
require_once '../../private/initialize.php';
session_start();
$length = isset($_POST['length'])?$_POST['length']:'0';
$_SESSION['NEW_COUNT'] = $length;