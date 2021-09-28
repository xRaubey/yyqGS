<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/26/21
 * Time: 3:19 PM
 */


/**
 * Used to check if a user account has existed in databases.
 * Return invalid if the user account has already existed.
 */
require_once "../../private/initialize.php";

if(is_post_request()){

    $register_name = isset($_POST['an'])?$_POST['an']:null;

    if($register_name!=null){

        $sql_a = "SELECT * FROM log_in WHERE account='" .$register_name . "'";
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

