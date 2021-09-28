<?php

/**
 * Update profile image.
 */
require_once "../../private/initialize.php";
session_start();

if(is_post_request()){
//    $id = $_SESSION['profile_id'];

    $id = isset($_SESSION['ID'])?$_SESSION['ID']:null;

    if($id!=null){

        $profile_picture = $_POST['profile'];

        $image = base64_decode(substr($profile_picture,strpos($profile_picture,",")));

        $image_name = $id."profile_image";

        $image_path = "../uploaded_images/" . $image_name . ".png";

        $f = finfo_open();

        $type = finfo_buffer($f,$image,FILEINFO_MIME_TYPE);

        $size = strlen($image);

        $extension_array = array('image/jpg','image/jpeg','image/png','jpg','jpeg','png');

        $error1 = '';
        $error2 = '';

        if(in_array($type,$extension_array)){
            if($size < 5000000){

                if(file_exists($image_path)){
                    if(unlink($image_path)){
                        $location = "../uploaded_images/";
//                move_uploaded_file($image,$location.$image_name);
                        file_put_contents($image_path, $image);

                        $req = "UPDATE log_in SET image_name ='".$image_name."' WHERE id='" . $id ."'";
                        mysqli_query($db,$req);
                    };
                }
                else{
                    $location = "../uploaded_images/";
//                move_uploaded_file($image,$location.$image_name);
                    file_put_contents($image_path, $image);

                    $req = "UPDATE log_in SET image_name ='".$image_name."' WHERE id='" . $id ."'";
                    mysqli_query($db,$req);
                }



            }
            else{
                $error1=  'The file is bigger then 5m bytes!';
            }

        }
        elseif(empty($type) && empty($image) && empty($name)){

        }
        elseif(!in_array($type,$extension_array)){
            $error2= 'Incorrect file type!';
        }
        else{

        }
        //    echo $type.' session:'.$_SESSION['ID']. 'size:'.strlen($image);
        echo json_encode(['id'=>$id,'error1'=>$error1,'error2'=>$error2]);

    }
    else{
        $error1="ID session doesn't exist";
        $error2="";
        echo json_encode(['error1'=>$error1,'error2'=>$error2]);
    }


}

