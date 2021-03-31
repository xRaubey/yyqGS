$(document).ready(function(){

    $("#gb_button").on("click",function(){
        window.location = 'index.php';
    });

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

    var $form = $("#su_form");

    $("#su_button2").on("click",function (e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"/yyqGS/public/form/sign_up.php",
            data:$form.serialize(),
            success:function (d) {
                var $data = d.split(",");
                if($data[0] =='' && $data[1] =='' && $data[2] =='' && $data[3] =='' && $data[4] =='' && $data[5] ==''){
                    location.href = "/yyqGS/public/profile_picture.php"
                }
                else{
                    if($data[0] !=''){
                        $("#notice1").html($data[0]);
                    }
                    else if($data[3] !=''){
                        $("#notice1").html($data[3]);
                    }
                    else{
                        $("#notice1").empty();
                    }

                    if($data[1] !=''){
                        $("#notice2").html($data[1]);
                    }
                    else if($data[4] !=''){
                        $("#notice2").html($data[4]);
                    }
                    else{
                        $("#notice2").empty();
                    }

                    if($data[2] !=''){
                        $("#notice3").html($data[2]);
                    }
                    else if($data[5] != ''){
                        $("#notice3").html($data[5]);
                    }
                    else{
                        $("#notice3").empty();
                    }
                }

            }

        });
    })
});