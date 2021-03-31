<?php
require_once "../../private/initialize.php";
$position = $_POST['index'];
$position = $position+1;


$id = $_GET['id'];

$req_user = "SELECT * FROM log_in WHERE id='" . $id ."'";
$result_user = mysqli_query($db,$req_user);
$subject_user = mysqli_fetch_assoc($result_user);

$req1 = "SELECT * FROM notification WHERE receiver='" . $subject_user['user_name']. "'";
$result1 = mysqli_query($db,$req1);
$subject1 = mysqli_fetch_assoc($result1);
$row = mysqli_num_rows($result1);

$position = $row - $position;

$req = "SELECT * FROM notification WHERE receiver='" . $subject_user['user_name']."' AND position='" . $position ."'";
$result = mysqli_query($db,$req);
$subject = mysqli_fetch_assoc($result);


echo $id.",".$subject['country'].",".$subject['t_id'].",".$subject['page'];
