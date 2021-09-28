<?php
require_once '../private/initialize.php';
session_start();
?>

<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="author" content="yyq">
        <meta name="description" content="LikeCenter">
        <title>Global News</title>
        <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/signup.css') ?>">
        <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/bootstrap.css') ?>">

    </head>


    <body>

        <div id="container" class="container h-100 p-0 m-0">
            <div id="signUp_UI" class="row w-100 h-100 align-content-center justify-content-center p-0 m-0">

                <div class="col-10 col-md-8 col-lg-6 bg-light h-50 rounded row">

                    <div class="col-12 text-center" id="title">Sign Up</div>

                    <form id="su_form" class="col-12 p-0 m-0" action="<?php echo url_for('/form/sign_up.php') ?>" method="post" autocomplete="off">

                        <!--                    <div id="formTitle"><input type="text" placeholder="Account Name" id="an" name="account">-->
                        <!--                    <br>-->
                        <!--                    </div>-->

                        <div class="form-group row col-12 justify-content-around">
                            <input class="form-control col-5" type="text" placeholder="Account Name" id="an" name="account" autocomplete="off">
                            <div id="an_feedback" class="col-5"></div>
                        </div>

                        <!--                    <div id="notice1">-->
                        <!---->
                        <!--                    </div>-->

                        <!--                    <div id="formUser">-->
                        <!--                    <input type="text" placeholder="User Name" id="un" name="user_name">-->
                        <!--                    </div>-->

                        <div class="form-group row col-12 justify-content-around">
                            <input class="form-control col-5" type="text" placeholder="User Name" id="un" name="user_name" autocomplete="off">
                            <div id="un_feedback" class="col-5"></div>
                        </div>

                        <!--                    <div id="notice2">-->
                        <!---->
                        <!--                    </div>-->

                        <!--                    <div id="formPassword">-->
                        <!--                    <input type="password" placeholder="Password" id="password" name="password">-->
                        <!--                    </div>-->


                        <div class="form-group row col-12 justify-content-around">
                            <input class="form-control col-5" type="password" placeholder="Password" id="password" name="password" autocomplete="off">
                            <div id="ps_feedback" class="col-5"></div>
                        </div>

                        <!--                    <div id="formComfirm">-->
                        <!--                    <input type="password" placeholder="Comfirm Password" id="password2" name="password2">-->
                        <!--                    </div>-->

                        <div class="form-group row col-12 justify-content-around">
                            <input class="form-control col-5" type="password" placeholder="Comfirm Password" id="password2" name="password2" autocomplete="off">
                            <div id="cf_feedback" class="col-5"></div>
                        </div>



                        <!--                    <div id="notice3">-->
                        <!---->
                        <!--                    </div>-->

                        <input class="btn btn-danger" type="button" name="goback" value="Go Back" id="gb_button">
                        <input class="btn btn-primary" type="submit" name ="submit" value="Sign Up" id="su_button2">
                    </form>


                </div>

            </div>
        </div>


        <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
        <script src="<?php echo url_for('/script/bootstrap.js')?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo url_for('/script/signup.js') ?>"></script>

    </body>



</html>