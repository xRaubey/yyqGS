<?php
require_once "../../private/initialize.php";
$position = $_POST['index'];


$id = $_GET['id'];

$req_user = "SELECT * FROM log_in WHERE id='" . $id ."'";
$result_user = mysqli_query($db,$req_user);
$subject_user = mysqli_fetch_assoc($result_user);


$array = [];

$req = "SELECT * FROM liked WHERE user_name='". $subject_user['user_name']."'";
$result = mysqli_query($db,$req);
while ($subject = mysqli_fetch_assoc($result)){
    $array[] = $subject;
}


echo $id.",".$array[$position]['country'].",".$array[$position]['t_id'];
