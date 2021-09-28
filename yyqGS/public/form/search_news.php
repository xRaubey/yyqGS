<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/21/21
 * Time: 3:26 PM
 */


/**
 * Acquire all records from table "new_thread" from database based on the variable "country" and "t_id".
 */

require_once "../../private/initialize.php";

session_start();

$country = isset($_SESSION['country'])?$_SESSION['country']:'';

//$country = "United States";

$req = "SELECT * FROM new_thread WHERE country='".$country."'";
$result = mysqli_query($db,$req);


$title = '';


$content = '';
$image = '';
$user = '';
$image_name = '';
$date = '';
$array = [];

$jrow = [];

while($row = mysqli_fetch_assoc($result)){


    $req2 = "SELECT * FROM comments WHERE country='".$country."' AND t_id='".$row['t_id']."'";
    $result2 = mysqli_query($db,$req2);

    $replies_number = 0;


    $title = htmlspecialchars_decode($row['title']);


    while($replies = mysqli_fetch_assoc($result2)){
        $replies_number++;
        if($replies_number == 1){
            $content = htmlspecialchars_decode($replies['comment']);
            $image = $replies['images'];
            $image_name = $replies['image_name'];
            $date = $replies['time'];
            $user = $replies['user'];
        }
    }


//    $row = json_encode($row);

    $jrow[] = ['rows'=>$replies_number,'content'=>$content,'image'=>$image,'user'=>$user,'image_name'=>$image_name,'date'=>$date,'title'=>$title,'t_id'=>$row['t_id']];

//    array_push($array,$jrow);
}

//echo json_encode($array);

echo json_encode($jrow);