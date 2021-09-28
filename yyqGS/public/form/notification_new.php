<?php

/**
 * Update notification.
 */

require_once "../../private/initialize.php";
//$id = isset($_POST['id'])?$_POST['id']:null;

$tid = isset($_POST['tid'])?$_POST['tid']:null;

$cid = isset($_POST['cid'])?$_POST['cid']:null;

$rid = isset($_POST['rid'])?$_POST['rid']:null;

$page = isset($_POST['page'])?$_POST['page']:null;

$country = isset($_POST['country'])?$_POST['country']:null;




//$position = $_POST['index'];
//$position = $position+1;

//
//$req_user = "SELECT * FROM log_in WHERE id='" .$id. "'";
//$result_user = mysqli_query($db,$req_user);
//$subject_user = mysqli_fetch_assoc($result_user);
//$receiver = $subject_user['user_name'];

//$req1 = "SELECT * FROM notification WHERE receiver='" . $receiver. "' AND replier!='" .$receiver. "'";
//$result1 = mysqli_query($db,$req1);
//$subject1 = mysqli_fetch_assoc($result1);
//$row = mysqli_num_rows($result1);
//
//$position = $row - $position;



$req = "UPDATE notification SET new='0' WHERE country='" . $country . "' AND t_id='".$tid."' AND r_id='" . $rid ."' AND c_id='".$cid."' AND page='".$page."'";
$result = mysqli_query($db,$req);
//$subject = mysqli_fetch_assoc($result);

//redirect_to(url_for("personal_center.php?id=".$id));