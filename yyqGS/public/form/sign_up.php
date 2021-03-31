<?php
require_once '../../private/initialize.php';

session_start();

unset($_SESSION['key2']);


if(is_post_request()){

    $an = isset($_POST['account'])?$_POST['account']:'';
    $psw = isset($_POST['password'])?$_POST['password']:'';
    $psw2 = isset($_POST['password2'])?$_POST['password2']:'';
    $un = isset($_POST['user_name'])?$_POST['user_name']:'';

    $an_len = strlen($an);
    $psw_len = strlen($psw);
    $un_len = strlen($un);

    $error1 = '';
    $error2 = '';
    $error3 = '';
    $error4 = '';
    $error5 = '';
    $error6 = '';

    if($an_len < 4 || $an_len > 20 || !preg_match("/^[a-zA-Z0-9]+$/",$an)){

        $error1="4-20 characters.<br>(No special characters allowed)";
    }
    if ($un_len>20 || empty($un) || !preg_match("/^[a-zA-Z0-9]+$/",$un)){

        $error2="1-20 characters.<br>(No special characters allowed)";
    }
    if($psw_len<6){

        $error3="At least 6 characters.";
    }




        $sql_a = "SELECT * FROM log_in WHERE account='" .$an . "'";
        $result_a = mysqli_query($db,$sql_a);
        $row = mysqli_num_rows($result_a);

        $sql_un = "SELECT * FROM log_in WHERE user_name='" .$un . "'";
        $result_un = mysqli_query($db,$sql_un);
        $row2 = mysqli_num_rows($result_un);

        if($row >0){

            $error4 = "This account is already existed!";
        }

        elseif ($row2>0){

            $error5 = "This user name is already existed!";
        }

        elseif(h($psw) === h($psw2) && $row == 0){

            $sql = "INSERT INTO log_in (account,user_name, password) VALUES ('". h($an) . "','" .h($un) . "','" . h($psw) . "');";
            $result = mysqli_query($db, $sql);

            if($result){
                $new = mysqli_insert_id($db);
                $_SESSION['profile_id']=$new;
                $_SESSION['signUp'] = true;
                $_SESSION['loggedIn'] = true;
            }
            else{
                $_SESSION['profile_id']='';
                echo mysqli_error($db);
                db_disconnect($db);
                exit();
            }
        }

        else{

            $error6 ="Password doesn't not match.";
        }


    echo $error1.",".$error2.",".$error3.",".$error4.",".$error5.",".$error6;
}
/*
 * <?php
require_once '../../private/initialize.php';

session_start();

if(is_post_request()){

    $an = isset($_POST['account'])?$_POST['account']:'';
    $psw = isset($_POST['password'])?$_POST['password']:'';
    $psw2 = isset($_POST['password2'])?$_POST['password2']:'';
    $un = isset($_POST['user_name'])?$_POST['user_name']:'';

    $an_len = strlen($an);
    $psw_len = strlen($psw);
    $un_len = strlen($un);

    if($an_len < 4 && $an_len > 20 || $psw_len < 6){
        $_SESSION['TOO_SHORT'] = 'Account or Password is too short or too long';
        redirect_to(url_for('signup_home.php'));
    }
    elseif ($un_len>20){
        $_SESSION['UN_LONG'] = 'User name is too long';
        redirect_to(url_for('signup_home.php'));
    }
    elseif (empty($un)){
        $_SESSION['UN_EMPTY'] = 'User name can\'t be empty';
        redirect_to(url_for('signup_home.php'));
    }
    elseif(!preg_match("/^[a-zA-Z0-9]+$/",$an)){
        $_SESSION['AN_WRONG'] = 'Only letters and numbers allowed';
        redirect_to(url_for('signup_home.php'));
    }

    else{
        unset($_SESSION['TOO_SHORT'],$_SESSION['UN_LONG'],$_SESSION['UN_EMPTY'],$_SESSION['AN_WRONG']);

        $sql_a = "SELECT * FROM log_in WHERE account='" .$an . "'";
        $result_a = mysqli_query($db,$sql_a);
        $row = mysqli_num_rows($result_a);

        $sql_un = "SELECT * FROM log_in WHERE user_name='" .$un . "'";
        $result_un = mysqli_query($db,$sql_un);
        $row2 = mysqli_num_rows($result_un);

        if($row >0){
            $_SESSION['REPEAT_ACCOUNT'] = 'This account name is already existed!';
            redirect_to(url_for('signup_home.php'));
        }

        elseif ($row2>0){
            $_SESSION['REPEAT_USERNAME'] = 'This user name is already existed!';
            redirect_to(url_for('signup_home.php'));
        }

        elseif(h($psw) === h($psw2) && $row == 0){
            unset($_SESSION['NOT_MATCHED']);
            $sql = "INSERT INTO log_in (account,user_name, password) VALUES ('". h($an) . "','" .h($un) . "','" . h($psw) . "');";
            $result = mysqli_query($db, $sql);

            if($result){
                $new = mysqli_insert_id($db);
                $_SESSION['profile_id']=$new;
                redirect_to(url_for('profile_picture.php?id=') . $new);
            }
            else{
                $_SESSION['profile_id']='';
                echo mysqli_error($db);
                db_disconnect($db);
                exit();
            }
        }

        else{
            $_SESSION['NOT_MATCHED'] = 'Passwords not matched!';
            redirect_to(url_for('signup_home.php'));
        }
    }
}
?>
 */

?>