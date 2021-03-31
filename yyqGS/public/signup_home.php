<?php
require_once '../private/initialize.php';
session_start();
?>

<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LikeCenter">
    <title>Little World</title>
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/signup.css') ?>">
</html>

<body>
    <div id="container">
    <div id="signUp_UI">
        <form id="su_form" action="<?php echo url_for('/form/sign_up.php') ?>" method="post">
            <div id="title">Sign Up</div>

            <div id="formTitle"><input type="text" placeholder="Account Name" id="an" name="account">
            <br>
            </div>

            <div id="notice1">

            </div>

            <div id="formUser">
            <input type="text" placeholder="User Name" id="un" name="user_name">
            </div>
            <div id="notice2">

            </div>

            <div id="formPassword">
            <input type="password" placeholder="Password" id="password" name="password">
            </div>
            <div id="formComfirm">
            <input type="password" placeholder="Comfirm Password" id="password2" name="password2">
            </div>

            <div id="notice3">

            </div>

            <input type="button" name="goback" value="Go Back" id="gb_button">
            <input type="submit" name ="submit" value="Sign Up" id="su_button2">
        </form>
    </div>
    </div>
    <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo url_for('/script/signup.js') ?>"></script>
</body>