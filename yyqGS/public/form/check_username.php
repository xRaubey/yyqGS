<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/26/21
 * Time: 3:38 PM
 */

/**
 * Check if a username has existed in the database, if it has, return "invalid".
 */

require_once "../../private/initialize.php";

if(is_post_request()){

    $user_name = isset($_POST['un'])?$_POST['un']:null;

    if($user_name!=null){

        $sql_a = "SELECT * FROM log_in WHERE user_name='" .$user_name . "'";
        if($row=mysqli_fetch_row(mysqli_query($db,$sql_a))>0){

            echo 'invalid';

        }
        else{
            echo 'valid';
        }

    }


}
else{
    echo "Get method";
}

