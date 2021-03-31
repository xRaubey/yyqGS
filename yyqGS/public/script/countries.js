$(document).ready(function(){
    var $tb_width = $("#toolbar").width();
    var $button = $("#dialog_button");
    var $b_left = $tb_width/2-$button.width()/2;
    $button.css({left:$b_left});
    $("#gb_button").css({left:$b_left});
    var $pi = $(".profile_image");
    $pi.css({left:$b_left});

    $pi.on("click",function () {
        $.ajax({
            url:"/yyqGS/public/form/get_url.php",
            success:function (d) {
                var $data = d.split(",");
            location.href = "/yyqGS/public/personal_center.php?id=" +$data[0];
        }
        });
    });

    var $bf = 0;
    var $cancel = $("#cancel");
    var $send = $("#send");
    var $loading = $("#loading");
    $button.on("click",function (e) {
        e.preventDefault();
        if($bf===0) {
            $("#new_thread").css({transform:"translateY(-115%)",transition:"transform 1s ease-in-out"});
            $bf=1;
        }
        else{
            $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
            $bf = 0;
        }
        $cancel.on("click",function (e) {
            e.preventDefault();
            $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
            $bf = 0;
        });

            $send.on("click",function (e) {
                e.preventDefault();
                $send.css({"z-index":-1});
                $loading.css({"z-index":1});
                var $formData = new FormData($("#thread")[0]);
                $.ajax({
                    url: "/yyqGS/public/form/new_thread.php",
                    data: $formData,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function (d) {

                        var $data = d.split(",");
                        if ($data[0] === '' && $data[1] === '' && $data[2] === '' && $data[5] !== '') {
                            $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
                            $bf = 0;
                            location.href = '/yyqGS/public/thread.php?id=' + $data[3] + '&country=' + $data[4] + '&tid=' + $data[5];
                        }
                        if ($data[0] !== '') {
                            $(".note").html($data[0] + "<br>");
                        }
                        else {
                            $(".note").html('');
                        }
                        if ($data[1] !== '') {
                            $(".note").html($data[1] + "<br>");
                        }
                        else {
                            $(".note").html('');
                        }
                        if ($data[2] !== '') {
                            $(".note").html($data[2]);
                        }
                        else {
                            $(".note").html('');
                        }
                    },
                    complete:function () {
                        $send.css({"z-index":-1});
                        $loading.ss({"z-index":1});
                    }

                });
            });

            $loading.on("click",function (e) {
                e.preventDefault();
            });




    });



    $("#gb_button").on("click",function () {
        $.get("/yyqGS/public/form/get_url.php",function (d) {
            var $data = d.split(",");
            location.href = "/yyqGS/public/home.php?id="+$data[0];
        })
    });

    var $theme = $("#theme");
    var $content = $("#content");
    var $formWidth = $("#thread").width();
    $theme.css({width:$formWidth});
    $content.css({width:$formWidth});

    var $contentHeight = $("#thread").height() -$(".note").height() - $("#themeT").height()-$theme.height()-$("#contentT").height()-60;
    $content.css({height:$contentHeight});

    $(window).on("resize",function () {
        $tb_width = $("#toolbar").width();
        $b_left = $tb_width/2-$button.width()/2;
        $button.css({left:$b_left});
        $("#gb_button").css({left:$b_left});
        $pi.css({left:$b_left});


        $theme = $("#theme");
        $content = $("#content");
        $formWidth = $("#thread").width();
        $theme.css({width:$formWidth});
        $content.css({width:$formWidth});

        $contentHeight = $("#thread").height()-$(".note").height() - $("#themeT").height()-$theme.height()-$("#contentT").height()-60;
        $content.css({height:$contentHeight});
    });

    
    var $thread_image = $(".thread_image");
    $thread_image.each(function (index) {
        var $ti_flag = 1;
        $(this).on("click",function (e) {
            e.stopPropagation();
            if($ti_flag===1)
            {
                $("#show_image").css({"z-index":"2","background": "no-repeat center white url(" + $(this).attr("src") +")"});
                $ti_flag = -$ti_flag;
            }
        });
        $("#show_image").on("click",function () {
            if($ti_flag===-1) {
                $("#show_image").css({"z-index": "-1", "background-image": ""});
                $ti_flag = -$ti_flag;
            }
        })
    });

    var $threads = $("#threads");
    $threads.on("scroll",function () {
        if($threads.scrollTop()>=0 && $threads.scrollTop()<=1000){
            var $image_y = 50+$threads.scrollTop()/2;
            $threads.css("background-position","50% "+$image_y+"%");
        }
    });

    var $single_thread = $(".single_thread");
    $single_thread.each(function () {
        $(this).on("click",function () {
            location.href = $(this).children(".thread_title").children("a").attr("href");
        })
    })

});