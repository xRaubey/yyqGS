<?php

/**
 * Create a new thread, and import data into database.
 */

 require_once "../../private/initialize.php";
 session_start();

// $id=$_SESSION['id'];
 $id= isset( $_SESSION['ID']) ? $_SESSION['ID']: '';
 $country = isset($_SESSION['country'])? $_SESSION['country'] : '';
 $country = mysqli_real_escape_string($db,$country);
 $n = 0;
 $error1='';
 $error2='';
 $error3='';
 $tid = '';
 if(is_post_request()){

     $nt = isset($_POST['title']) ? $_POST['title'] : '';
     $nt = mysqli_real_escape_string($db,$nt);
     $content = isset($_POST['content']) ? $_POST['content'] : '';
     $content = mysqli_real_escape_string($db,$content);

//     $name_post = time();


     $type = pathinfo($_FILES['tImage']['name'],PATHINFO_EXTENSION);
//     $type = mysqli_real_escape_string($db,$_FILES['tImage']['type']);

     $image = mysqli_real_escape_string($db,$_FILES['tImage']['tmp_name']);
     if($image==null){
         $image='';
     }

     $name = mysqli_real_escape_string($db,pathinfo($_FILES['tImage']['name'],PATHINFO_FILENAME));

     if($name==null){
         $name='';
     }
     else{
         $name = $name."GN".time().rand(1,20)."GN.".$type;
     }



     $size = mysqli_real_escape_string($db,$_FILES['tImage']['size']);

//     $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

     $extension_array = array('image/jpg','image/jpeg','image/png','image/pdf','image/gif','jpg','jpeg','png');


     if(in_array($type,$extension_array)){
         if($size < 5000000){
             $location = "../uploaded_images/";
             move_uploaded_file($image,$location.$name);

         }
         else{
             $error1 = 'The file is bigger then 5m bytes!';
         }

     }
     elseif(empty($type) && empty($image) && empty($name)){

     }
     else{
         $error2 = 'Incorrect file type!';
     }

     if($nt != '' && $content!='' && $error1=='' && $error2==''){

         $req_author = "SELECT * FROM log_in WHERE id='" .$id. "'";
         $result_author = mysqli_query($db,$req_author);
         $subject_author = mysqli_fetch_assoc($result_author);

//         $req_n = "SELECT * FROM new_thread WHERE country='" .$country. "'";
//         $result_n = mysqli_query($db,$req_n);
//         $n = mysqli_num_rows($result_n);


         $res_n =  "SELECT MAX(t_id) FROM comments WHERE country='" .$country. "'";
         $result_n = mysqli_query($db,$res_n);
         $n = mysqli_fetch_assoc($result_n)['MAX(t_id)']+1;


         $tid = $n;
         date_default_timezone_set("America/Chicago");
         $date = date("Y-m-d");
         $date2 = date("Y/m/d H:i:s");

         $req = "INSERT INTO new_thread (title,country,t_id,date,author,latest,category) 
                 VALUES ('".$nt."','" . $country ."','" .$n."','".$date."','".$subject_author['user_name']."','".$date2."', 'other')";
         $result = mysqli_query($db,$req);


         if($result){
//             $new_id = mysqli_insert_id($db);
//             $_SESSION['THREAD_ID']=$new_id;

             $req_thread = "INSERT INTO comments (user,receiver,comment,country,t_id, c_id, r_id,time,image_name,images,page)
                  VALUES('"
             .$subject_author['user_name']."','-','"
             .$content."','"
             .$country."','"
             .$tid."','1','0','"
             .$date2."','"
                 .$name."','"
            .$image."','1')";
             mysqli_query($db,$req_thread);

            //redirect_to(url_for("thread.php?id=" .$id."&country=".$country."&tid=".$tid));


         }
         else{
             echo mysqli_error($db);
             exit();
         }
     }
     else{
        $error3 = "Please fill your theme and content!";
     }
     echo $error1.','.$error2.','.$error3.','.$id.','.$country.','.$tid.','.$name;
 }
 else{
     echo "Error - Get Method.";
 }