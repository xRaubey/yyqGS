<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/14/21
 * Time: 7:35 PM
 */

/**
 * Get the system time stored in the database.
 */

require_once '../../private/initialize.php';

//$time = isset($_POST['time'])?$_POST['time']:'';
//$time = mysqli_real_escape_string($db,$time);

$req = "SELECT * FROM timer";
$result = mysqli_query($db,$req);
$subject = mysqli_fetch_assoc($result);
$update = $subject['last_update'];

echo $update;

//if(mysqli_num_rows($result)>=1){
//    echo $update;
//}
//else {
//    echo $update;
//}