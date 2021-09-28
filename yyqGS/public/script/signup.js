$(document).ready(function(){


    /*
        Go back functionality.
     */

    $("#gb_button").on("click",function(){
        window.location = 'index.php';
    });


    /*
        Window resize handler.
     */

    var $height = 500;
    var $width = 600;
    var $window_height = window.innerHeight;
    var $window_width = window.innerWidth;
    var $window_height2 = window.innerHeight-6;
    var $window_width2 = window.innerWidth-6;
    var $signUp = $("#signUp_UI");


    if($window_height>=$height && $window_width>=$width){

        $signUp.css({height:$height,width:$width});

    }
    else if($window_height<$height && $window_width>=$width){

        $signUp.css({height:$height,width:$width});

    }
    else if($window_height>=$height && $window_width<$width){

        $signUp.css({height:$height,width:$window_width2});

    }
    else{

        $signUp.css({height:$height,width:$window_width2});

    }

    var $actual_height = $signUp.height();
    var $actual_width = $signUp.width();
    var $top = ($window_height-($actual_height+6))/2;
    var $left = ($window_width-($actual_width+6))/2;

    if($window_height>=$height && $window_width>=$width){

        $signUp.css({left:$left,top:$top});
    }
    else if($window_height<$height && $window_width>=$width){

        $signUp.css({left:$left,top:"0px"});
    }
    else if($window_height>=$height && $window_width<$width){

        $signUp.css({left:$left,top:$top});
    }
    else{

        $signUp.css({left:$left,top:"0px"});
    }


    $(window).on("resize",function () {
        $height = 500;
        $width = 600;
        $window_height = window.innerHeight;
        $window_width = window.innerWidth;
        $window_height2 = window.innerHeight-6;
        $window_width2 = window.innerWidth-6;


        if($window_height>=$height && $window_width>=$width){
            $signUp.css({height:$height,width:$width});

        }
        else if($window_height<$height && $window_width>=$width){
            $signUp.css({height:$height,width:$width});

        }
        else if($window_height>=$height && $window_width<$width){
            $signUp.css({height:$height,width:$window_width2});

        }
        else{
            $signUp.css({height:$height,width:$window_width2});

        }

        $actual_height = $signUp.height();
        $actual_width = $signUp.width();
        $top = ($window_height-($actual_height+6))/2;
        $left = ($window_width-($actual_width+6))/2;

        if($window_height>=$height && $window_width>=$width){

            $signUp.css({left:$left,top:$top});
        }
        else if($window_height<$height && $window_width>=$width){

            $signUp.css({left:$left,top:"0px"});
        }
        else if($window_height>=$height && $window_width<$width){

            $signUp.css({left:$left,top:$top});
        }
        else{

            $signUp.css({left:$left,top:"0px"});
        }

    });


    /*
        Information validation functionality.
     */


    $("#an").blur(function () {

        var ts = $(this);

        var regex = new RegExp("^[a-zA-Z0-9]+$");

        var account_name = $(this).val();

        if(account_name.length<4){
            $(this).addClass("is-invalid");
            $("#an_feedback").html("Account should be at least 4 characters long!").addClass("invalid-feedback");
        }
        else if(!regex.test(account_name)){

            $(this).addClass("is-invalid");
            $("#an_feedback").html("No special characters allowed!").addClass("invalid-feedback");
        }

        else{

            $.ajax({
                url:"./form/check_account.php",
                method:"POST",
                data:{an:account_name},
                success:function (d) {
                    console.log(d);

                    if(d==='valid'){
                        ts.removeClass("is-invalid");
                        ts.addClass("is-valid");
                        $("#an_feedback").html("Looks good!").removeClass("invalid-feedback").addClass("valid-feedback");

                    }
                    else if(d==='invalid'){
                        ts.addClass("is-invalid");
                        $("#an_feedback").html("This name has been used!").addClass("invalid-feedback");
                    }
                },
                error:function () {
                    $("#an_feedback").html("Something is wrong!").addClass("invalid-feedback");
                    location.reload();

                }
            })

        }

    });

    $("#un").blur(function () {

        var ts = $(this);

        var regex = new RegExp("^[a-zA-Z0-9]+$");

        var user_name = $(this).val();

        if(user_name.length<4){
            $(this).addClass("is-invalid");
            $("#un_feedback").html("Display name should be at least 4 characters long!").addClass("invalid-feedback");
        }
        else if(!regex.test(user_name)){

            $(this).addClass("is-invalid");
            $("#un_feedback").html("No special characters allowed!").addClass("invalid-feedback");
        }

        else{

            $.ajax({
                url:"./form/check_username.php",
                method:"POST",
                data:{un:user_name},
                success:function (d) {
                    console.log(d);

                    if(d==='valid'){
                        ts.removeClass("is-invalid");
                        ts.addClass("is-valid");
                        $("#un_feedback").html("Looks good!").removeClass("invalid-feedback").addClass("valid-feedback");

                    }
                    else if(d==='invalid'){
                        ts.addClass("is-invalid");
                        $("#un_feedback").html("This name has been used!").addClass("invalid-feedback");
                    }
                },
                error:function () {
                    $("#un_feedback").html("Something is wrong!").addClass("invalid-feedback");
                    location.reload();

                }
            })

        }

    });

    $("#password").blur(function () {

        var ts = $(this);

        var regex = new RegExp("^[a-zA-Z0-9]+$");

        var password = $(this).val();

        if(password.length<6){
            $(this).addClass("is-invalid");
            $("#ps_feedback").html("Display name should be at least 6 characters long!").addClass("invalid-feedback");
        }
        else if(!regex.test(password)){

            $(this).addClass("is-invalid");
            $("#ps_feedback").html("No special characters allowed!").addClass("invalid-feedback");
        }

        else{

            ts.removeClass("is-invalid");
            ts.addClass("is-valid");
            $("#ps_feedback").html("Looks good!").removeClass("invalid-feedback").addClass("valid-feedback");

        }

    });

    $("#password2").blur(function () {

        var ts = $(this);

        // var regex = new RegExp("^[a-zA-Z0-9]+$");

        var confirm = $(this).val();

        if(confirm !== $("#password").val()){
            $(this).addClass("is-invalid");
            $("#cf_feedback").html("Doesn't match!").addClass("invalid-feedback");
        }
        else{

            ts.removeClass("is-invalid");
            ts.addClass("is-valid");
            $("#cf_feedback").html("Looks good!").removeClass("invalid-feedback").addClass("valid-feedback");

        }

    });





    /*
        Validate the information, and redirect to the profile image page.
     */

    $("#su_button2").on("click",function (e) {
        e.preventDefault();

        if(!($("#an").hasClass("is-valid") && $("#un").hasClass("is-valid") && $("#password").hasClass("is-valid") && $("#password2").hasClass("is-valid"))){


            alert("Input valid information!");


        }
        else {
            var $form = $("#su_form");

            $.ajax({
                type:"POST",
                url:"./form/sign_up.php",
                data:$form.serialize(),
                success:function (d) {

                    var $data = d.split(",");
                    if($data[0] =='' && $data[1] =='' && $data[2] =='' && $data[3] =='' && $data[4] =='' && $data[5] ==''){
                        location.href = "./profile_picture.php"
                    }
                    else{

                        location.reload();
                        // if($data[0] !=''){
                        //     $("#notice1").html($data[0]);
                        // }
                        // else if($data[3] !=''){
                        //     $("#notice1").html($data[3]);
                        // }
                        // else{
                        //     $("#notice1").empty();
                        // }
                        //
                        // if($data[1] !=''){
                        //     $("#notice2").html($data[1]);
                        // }
                        // else if($data[4] !=''){
                        //     $("#notice2").html($data[4]);
                        // }
                        // else{
                        //     $("#notice2").empty();
                        // }
                        //
                        // if($data[2] !=''){
                        //     $("#notice3").html($data[2]);
                        // }
                        // else if($data[5] != ''){
                        //     $("#notice3").html($data[5]);
                        // }
                        // else{
                        //     $("#notice3").empty();
                        // }
                    }

                },
                error:function () {
                    location.reload();
                }

            });

        }

    });

});