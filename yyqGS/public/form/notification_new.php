<?php
require_once "../../private/initialize.php";
$id = $_GET['id'];
$position = $_POST['index'];
$position = $position+1;


$req_user = "SELECT * FROM log_in WHERE id='" .$id. "'";
$result_user = mysqli_query($db,$req_user);
$subject_user = mysqli_fetch_assoc($result_user);
$receiver = $subject_user['user_name'];

$req1 = "SELECT * FROM notification WHERE receiver='" . $receiver. "' AND replier!='" .$receiver. "'";
$result1 = mysqli_query($db,$req1);
$subject1 = mysqli_fetch_assoc($result1);
$row = mysqli_num_rows($result1);

$position = $row - $position;



$req = "UPDATE notification SET new='0' WHERE receiver='" . $receiver . "' AND replier!='".$receiver."' AND position='" . $position ."'";
$result = mysqli_query($db,$req);
$subject = mysqli_fetch_assoc($result);

redirect_to(url_for("personal_center.php?id=".$id));