<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/14/21
 * Time: 9:48 PM
 */

/**
 * Update all news stored in database.
 */

require_once '../../private/initialize.php';

header('Content-Type: text/html; charset=utf-8');

$news = isset($_POST['news'])?$_POST['news']:'';
//$news2 = mysqli_real_escape_string($db,$news);

//$news_records = json_decode($news);

 session_start();

// $id=$_SESSION['id'];
 $id= 0; // global news offiial id
 $country = isset($_POST['country'])? $_POST['country'] : '';
 $country = mysqli_real_escape_string($db,$country);
 $currentTime = isset($_POST['currentTime'])? $_POST['currentTime'] : '';
 $category = isset($_POST['category'])? $_POST['category'] : '';
 $category = mysqli_real_escape_string($db,$category);



 $n = 0;
 $error1=null;
 $error2=null;
 $error3='';
 $tid = '';


// $test_array = [];
 if(is_post_request()){

//     $d_req = "DELETE FROM `comments` WHERE `user` = 'GN'";
//     $r1 = mysqli_query($db,$d_req);
//
//
//     $d_req2 = "DELETE FROM `new_thread` WHERE `author` = 'GN'";
//     $r2 = mysqli_query($db,$d_req2);
//
//     $req_update = "UPDATE timer SET last_update = '" . $currentTime . "' LIMIT 1";
//     $result_update = mysqli_query($db,$req_update);

//     $test_array = [];

//     echo $currentTime;

     $res_n =  "SELECT MAX(t_id) FROM comments WHERE country='" .$country. "'";
     $result_n = mysqli_query($db,$res_n);
     $tid = mysqli_fetch_assoc($result_n)['MAX(t_id)'];


     for($i=0;$i<sizeof($news);$i++){

         $nt = $news[$i]['title'];
         $nt = htmlspecialchars($nt);
         $nt = mysqli_real_escape_string($db,$nt);

         $content = $news[$i]['content'];
         $content = htmlspecialchars($content);
         $content = mysqli_real_escape_string($db,$content);


         $web_url = $news[$i]['url'];
         $web_url = htmlspecialchars($web_url);
         $web_url = mysqli_real_escape_string($db,$web_url);

         $author = "GN";

         $tid++;


         // original

    //         $name = mysqli_real_escape_string($db,$_FILES['tImage']['name']);
    //         $image = mysqli_real_escape_string($db,$_FILES['tImage']['tmp_name']);
    //         $type = mysqli_real_escape_string($db,$_FILES['tImage']['type']);
    //         $size = mysqli_real_escape_string($db,$_FILES['tImage']['size']);
    //
    //
    //         $extension_array = array('image/jpg','image/jpeg','image/png','image/pdf','image/gif');
    //
    //
    //         if(in_array($type,$extension_array)){
    //             if($size < 5000000){
    //                 $location = "/uploaded_images/";
    //                 move_uploaded_file($image,$location.$name);
    //
    //             }
    //             else{
    //                 $error1 = 'The file is bigger then 5m bytes!';
    //             }
    //
    //         }
    //         elseif(empty($type) && empty($image) && empty($name)){
    //
    //         }
    //         else{
    //             $error2 = 'Incorrect file type!';
    //         }

         // original


         // new


         $url = $news[$i]['urlToImage'];
         $url = mysqli_real_escape_string($db,$url);

         $type = pathinfo($url, PATHINFO_EXTENSION);

         $name = pathinfo($url, PATHINFO_FILENAME);
         $name = mysqli_real_escape_string($db,$name);
//         $name = mysqli_real_escape_string($db,$name.time()."gs");
//         $name = mysqli_real_escape_string($db,$name.'+'.strval(time()).'+'.rand(1,20) .'gs');
//         $name = h($name);

         $image = $url;

//         $size = get_headers($url,1);
//         $size = mysqli_real_escape_string($db,$size["Content-Length"]);
//
//         $extension_array = array('jpg','jpeg','png','pdf','gif');

//         if(in_array($type,$extension_array)){
//             if($size < 5000000){
//                 $location = PUBLIC_PATH."/uploaded_images/";
//                 copy($url, $location.$name);
//             }
//             else{
//                 $error1 = 'The file is bigger then 5m bytes!';
//             }
//
//         }
//         elseif(empty($type) && empty($image) && empty($name)){
//
//         }
//         else{
//             $error2 = 'Incorrect file type!';
//         }


         // new


//         array_push($test_array,$i);

//         $news_record = json_decode($news[$i]);
//         $news_record['title'];
//         array_push($test_array,json_encode($news[$i]['title']));

//         $nt = json_encode($news[$i]['title'],JSON_UNESCAPED_UNICODE);
//         $nt = $news[$i]['title'];
//         $nt = htmlspecialchars($nt);
//         $nt = mysqli_real_escape_string($db,$nt);
//
////         $content = json_encode($news[$i]['content'], JSON_UNESCAPED_UNICODE);
//         $content = $news[$i]['content'];
//         $content = htmlspecialchars($content);
//         $content = mysqli_real_escape_string($db,$content);
////         $content = strip_tags($content);
////         $author = json_encode($news[$i]['author']);
////         $author = mysqli_real_escape_string($db,$author);
//         $author = "GN";
//
//
//         $url = $news[$i]['urlToImage'];
//         $url = mysqli_real_escape_string($db,$url);
//
//         $type = pathinfo($url, PATHINFO_EXTENSION);
//
//
////         $name = mysqli_real_escape_string($db,$_FILES['tImage']['name']);
//
////         $name_post = time();
//         $name = pathinfo($url, PATHINFO_FILENAME);
//         $name = mysqli_real_escape_string($db,$name. $i. 'gs'.'.'.$type);
//
////         $image = mysqli_real_escape_string($db,$_FILES['tImage']['tmp_name']);
////         $image = base64_encode(file_get_contents($url));
////         $image = mysqli_real_escape_string($db,$image);
//
//         $image = $url;
//
//
////         $type = pathinfo($url, PATHINFO_EXTENSION);
//
////         $size = mysqli_real_escape_string($db,$_FILES['tImage']['size']);
//
//         $size = get_headers($url,1);
//         $size = mysqli_real_escape_string($db,$size["Content-Length"]);

//         $size = 2001;

//         $url=$_POST['img_url'];
//         $data = file_get_contents($url);
//         $new = 'images/new_image.jpg';
//         file_put_contents($new, $data);


//         $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));



//         $extension_array = array('image/jpg','image/jpeg','image/png','image/pdf','image/gif');

//         $extension_array = array('jpg','jpeg','png','pdf','gif');
//
//     if(in_array($type,$extension_array)){
//         if($size < 5000000){
//             $location = "../uploaded_images/";
//             copy($url, $location.$name);
////             move_uploaded_file(file_get_contents($url),$location.$name);
//
//         }
//         else{
//             $error1 = 'The file is bigger then 5m bytes!';
//         }
//
//     }
//     elseif(empty($type) && empty($image) && empty($name)){
//
//     }
//     else{
//         $error2 = 'Incorrect file type!';
//     }




     if($nt != null && $content!=null && $error1==null && $error2==null){
//
//         $req_author = "SELECT * FROM log_in WHERE id='" .$id. "'";
//         $result_author = mysqli_query($db,$req_author);
//         $subject_author = mysqli_fetch_assoc($result_author);
//
//         $req_n = "SELECT * FROM new_thread WHERE country='" .$country. "' AND ";
//         $result_n = mysqli_query($db,$req_n);
//         $n = mysqli_num_rows($result_n);
//
//         $res_n =  "SELECT MAX(t_id) FROM comments WHERE country='" .$country. "'";
//         $result_n = mysqli_query($db,$res_n);
//         $n = mysqli_fetch_assoc($result_n)['MAX(t_id)']+1;
//
//         $tid = $n;
         date_default_timezone_set("America/Chicago");
         $date = date("Y-m-d");
         $date2 = date("Y/m/d H:i:s");

         $req = "INSERT INTO new_thread (title,country,t_id,date,author,latest,category)
                 VALUES ('".$nt."','" . $country ."','" .$tid."','".$date."','".$author."','".$date2."','".$category."')";
         $result = mysqli_query($db,$req);


         $req_thread = "INSERT INTO comments (user,receiver,comment,country,t_id, c_id, r_id,time,image_name,images,page,url)
                  VALUES('"
             .$author."','-','"
             .$content."','"
             .$country."','"
             .$tid."','1','0','"
             .$date2."','"
             .$name."','"
             .$image."','1','"
             .$web_url."')";


         if(!mysqli_query($db,$req_thread)){

             $req_thread = "INSERT INTO comments (user,receiver,comment,country,t_id, c_id, r_id,time,image_name,images,page,url)
                  VALUES('"
                 .$author."','-','"
                 .$content."','"
                 .$country."','"
                 .$tid."','1','0','"
                 .$date2."','"
                 .time()."GN','"
                 .$image."','1','".$web_url."')";

             mysqli_query($db,$req_thread);

         }

//         if($result){
////             $new_id = mysqli_insert_id($db);
////             $_SESSION['THREAD_ID']=$new_id;
//
//             $req_thread = "INSERT INTO comments (user,receiver,comment,country,t_id, c_id, r_id,time,image_name,images,page)
//                  VALUES('"
//                 .$author."','-','"
//                 .$content."','"
//                 .$country."','"
//                 .$tid."','1','0','"
//                 .$date2."','"
//                 .$name."','"
//                 .$image."','1')";
//             mysqli_query($db,$req_thread);
//
//             //redirect_to(url_for("thread.php?id=" .$id."&country=".$country."&tid=".$tid));
//
//
//         }
//         else{
//             echo mysqli_error($db);
//             exit();
//         }
     }
     else{
         $error3 = "Please fill your theme and content!";
     }
     echo $error1.','.$error2.','.$error3.','.$id.','.$country.','.$tid.','.$name;

     }

//     echo json_encode($test_array);
//     echo (json_encode($news[0]['title']));


//     echo $test_array;
 }

 else{
     echo "Get Method";
 }