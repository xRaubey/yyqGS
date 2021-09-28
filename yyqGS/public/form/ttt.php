<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/15/21
 * Time: 4:33 PM
 */

/**
 * This is just a file for tesing.
 */

require_once '../../private/initialize.php';
//$name = 'United States';
//$name = htmlspecialchars($name);
//echo $name;
//$name = mysqli_real_escape_string($db,$name);
//echo $name;


//
//
////$d_req = "DELETE FROM `comments` WHERE `user` = GN";
//$r1 = mysqli_query($db,"DELETE FROM `comments` WHERE `user` = 'GN'");
//
//
////$d_req2 = "DELETE FROM `new_thread` WHERE author = GN";
//$r2 = mysqli_query($db,"DELETE FROM `new_thread` WHERE author = 'GN'");
//
//
//mysqli_query($db,"UPDATE timer SET last_update = '620172800000'");
//
//



//echo 'aa'.$r1. ' '.$r2;
//
//if($r1&&$r2){
//    echo '1';
//}
//
//else{
//    echo '2';
//}
//
//
//$rr = mysqli_query($db,"SELECT * FROM liked LIMIT 2");
//
//while($row=mysqli_fetch_assoc($rr)){
//    echo $row['user_name'];
//}


//$res =  mysqli_query($db,"SELECT t_id, MAX(t_id) FROM comments GROUP BY t_id");

//$res =  mysqli_query($db,"SELECT MAX(t_id) FROM comments WHERE country = 'india'");

//print_r(mysqli_fetch_assoc($res)['MAX(t_id)']);

//echo mysqli_fetch_assoc($res)['MAX(t_id)'];

//while($row = mysqli_fetch_assoc($res)){
//    echo $row['t_id'];
//}

//$req = "SELECT COUNT(DISTINCT `country`) FROM `new_thread`";




//$array = [];
//
//$req = "SELECT country, COUNT(*) FROM new_thread GROUP BY country";
//$result = mysqli_query($db,$req);
//$aa = mysqli_fetch_assoc($result);

//echo mysqli_fetch_array($result)[0];

//while($row = mysqli_fetch_assoc($result)){
//
//    array_push($array,['cname' => $row['country'] , 'amount' => $row['COUNT(*)']]);
////    echo json_encode('cname:'.$row['country'].'amount:'.$row['COUNT(*)']);
//}
//
////print_r(json_encode($array));
//echo json_encode($array);

//echo $array;
//
//echo '<br>';
//
//print_r($array);
//
//echo '<br>';
//
//var_dump($array);

//while($row=mysqli_fetch_assoc($result)){
//    echo "<br>";
//    echo $row['country'];
//}

//while($row=mysqli_fetch_assoc($result)){
//    echo "<br>";
//    echo $row['country'];
//}

//echo "asa";
//echo mysqli_real_escape_string($db,"\"");



//$c = $_POST['content'];
//$c = json_decode($c);
//
//
//
//$cont = $c[0];


//echo json_encode($c);
//$r = $c[0];
//
//$r = $c[0]['urlToImage'];
//$r = preg_replace("#\\\u([0-9a-f]+)#ie","iconv('UCS-2','UTF-8',pack('H4','\\1'))",$r);
//$r = json_encode($r['urlToImage'], JSON_UNESCAPED_UNICODE);

//$r = file_get_contents($r);

//$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
//echo finfo_file($finfo, $r);
//finfo_close($finfo);

//echo exif_imagetype($r);
//echo mime_content_type($r);
//echo mime_content_type($r);
//echo file_get_contents($r);

//echo pathinfo($r, PATHINFO_FILENAME);

//$location = "./uploaded_images/";
//
//$content = file_get_contents("https://d2bs8hqp6qvsw6.cloudfront.net/article/images/800x800/promoted_content/promo/2019-07-22t130129z_1_lynxnpef6l11y_rtroptp_4_microsoft-results-100825276-orig_1_1_1_1.jpg");
////Store in the filesystem.
//$fp = fopen("/uploaded_images/fa.jpg", "w");
//fwrite($fp, $content);
//fclose($fp);


//copy("https://d2bs8hqp6qvsw6.cloudfront.net/article/images/800x800/promoted_content/promo/2019-07-22t130129z_1_lynxnpef6l11y_rtroptp_4_microsoft-results-100825276-orig_1_1_1_1.jpg", "../uploaded_images/fa.jpg");


//$get = file_get_contents("https://d2bs8hqp6qvsw6.cloudfront.net/article/images/800x800/promoted_content/promo/2019-07-22t130129z_1_lynxnpef6l11y_rtroptp_4_microsoft-results-100825276-orig_1_1_1_1.jpg");
//
//if($get){
//    file_put_contents("../uploaded_images/fa.jpg",$get);
//    echo base64_encode($get);
//}
//else{
//    echo "Image error.";
//}

//$s = get_headers($r,1);
//
//echo $s["Content-Length"];

//echo $r;
//echo $r;

//$r = str_replace("\u0022", "\\\"", $r );
//$r = str_replace("\u0027", "\\'",  $r );

//echo json_encode($c[0], JSON_UNESCAPED_SLASHES);
//echo preg_replace("#\\\u([0-9a-f]+)#ie","iconv('UCS-2','UTF-8',pack('H4','\\1'))",$r);

//echo htmlspecialchars(json_encode($c[0]));

//echo $c[0]['title'];


//echo $location = "./uploaded_images/";

//$name = mysqli_real_escape_string($db,$_FILES['tImage']['name']);
//
//echo pathinfo($_FILES['tImage']['name'],PATHINFO_FILENAME);

//echo $_POST['tic'].' '.$_POST['cid'].' '.$_POST['page'];



//echo PROJECT_PATH;



//var_dump(unlink(PUBLIC_PATH."/uploaded_images/49profile_image.png"));