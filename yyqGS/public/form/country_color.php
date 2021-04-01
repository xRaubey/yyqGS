<?php
require_once "../../private/initialize.php";
session_start();
$country = isset($_POST['country'])?$_POST['country']:'';
$country = mysqli_real_escape_string($db,$country);
ini_set('max_execution_time', 0);
if(is_post_request()){
    $req = "SELECT * FROM new_thread WHERE country='".$country."'";
    $result = mysqli_query($db,$req);
    if(isset($result))
    {
        $row = mysqli_num_rows($result);
        echo $row;
    }
}
