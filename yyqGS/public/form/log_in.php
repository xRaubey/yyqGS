<?php

/**
 * Verify the account and password.
 */

require_once '../../private/initialize.php';
session_start();

if(is_post_request()){
    $an = isset($_POST['account_li']) ? $_POST['account_li'] : '';
    $psw = isset($_POST['password_li']) ? $_POST['password_li'] : '';

    $req = "SELECT * FROM log_in WHERE account='" . h($an) . "'";
    $result = mysqli_query($db,$req);
    $subject = mysqli_fetch_assoc($result);
    $row = mysqli_num_rows($result);
    $_SESSION['ID'] = isset($subject['id'])?$subject['id']:'';
//    $_SESSION['id'] = isset($subject['id'])?$subject['id']:'';


    if($row === 1 && $psw === $subject['password']){
        $_SESSION['loggedIn'] = true;
        echo $subject['id'];
    }

    else{
        echo 'Account or Password is not correct!';
        //redirect_to(url_for('index.php'));
    }

}