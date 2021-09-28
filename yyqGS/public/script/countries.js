$(document).ready(function(){
    // var $tb_width = $("#toolbar").width();
    var $button = $("#dialog_button");
    // var $b_left = $tb_width/2-$button.width()/2;
    // $button.css({left:$b_left});
    // $("#gb_button").css({left:$b_left});
    var $pi = $(".profile_image");
    // $pi.css({left:$b_left});


    /*
        Redirect to the user page.
     */


    function hasAttr(obj,name) {
        var attr = obj.attr(name);

        // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
        if (typeof attr !== typeof undefined && attr !== false) {
            // Element has this attribute
            return true;
        }
        else{
            return false;
        }
    }

    // if(hasAttr($pi,"disabled")){
    //     $pi.css({"cursor":"normal"});
    // }
    // else{
    //     $pi.css({"cursor":"pointer"});
    // }

    $pi.on("click",function () {

        console.log(hasAttr($pi,"disabled"));

        if(!hasAttr($pi,"disabled")){
            $.ajax({
                url:"./form/get_url.php",
                success:function (d) {
                    var $data = d.split(",");
                    location.href = "./personal_center.php?id=" +$data[0];
                }
            });
        }

    });




    /*
        Disable buttons while dealing with some other requests, such as ajax call.
     */

    var $bf = 0;
    var $cancel = $("#cancel");
    var $send = $("#send");
    // var $loading = $("#loading");
    $button.on("click",function (e) {
        e.preventDefault();
        if($bf===0) {
            // $("#new_thread").css({transform:"translateY(-115%)",transition:"transform 1s ease-in-out"});

            $(".cbtn_button").each(function (i) {
                if(i===0){
                    $(this).css({"opacity":"0.6","cursor":"not-allowed"});
                }
                $(this).attr("disabled","true");
            });
            TweenLite.fromTo($("#new_thread"),1,{top:'100%'},{top:'0',display:"block",ease:Bounce.easeOut});

            $bf=1;
        }
        else{

            // $(".cbtn button").each(function (i) {
            //     $(this).removeAttr("disabled");
            // });
            // TweenLite.fromTo($("#new_thread"),1,{top:'0'},{top:'100%',display:"none",ease:Bounce.easeOut});
            //
            // // $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
            // $bf = 0;
        }
        $cancel.on("click",function (e) {
            e.preventDefault();
            // $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
            // $bf = 0;

            $(".cbtn_button").each(function (i) {
                if(i===0){
                    $(this).css({"opacity":"1","cursor":"pointer"});
                }
                $(this).removeAttr("disabled");
            });
            TweenLite.fromTo($("#new_thread"),1,{top:'0'},{top:'100%',display:"none",ease:Bounce.easeOut});

            // $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
            $bf = 0;
        });

            $send.on("click",function (e) {
                e.preventDefault();

                $(".launchBtn").each(function (i) {
                    // alert(1);
                    $(this).attr("disabled","true");
                });

                // $send.css({"z-index":-1});
                // $loading.css({"z-index":1});
                var $formData = new FormData($("#thread")[0]);
                $.ajax({
                    url: "./form/new_thread.php",
                    // url: "/yyqGS/public/form/ttt.php",

                    data: $formData,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function (d) {

                        // console.log(d);

                        var $data = d.split(",");
                        if ($data[0] === '' && $data[1] === '' && $data[2] === '' && $data[5] !== '') {
                            $("#new_thread").css({transform:"translateY(100%)",transition:"transform 1s ease-in-out"});
                            $bf = 0;
                            location.href = './thread.php?id=' + $data[3] + '&country=' + $data[4] + '&tid=' + $data[5];
                        }



                        // if ($data[0] !== '') {
                        //     $(".note").html($data[0] + "<br>");
                        // }
                        // else {
                        //     $(".note").html('');
                        // }
                        // if ($data[1] !== '') {
                        //     $(".note").html($data[1] + "<br>");
                        // }
                        // else {
                        //     $(".note").html('');
                        // }
                        // if ($data[2] !== '') {
                        //     $(".note").html($data[2]);
                        // }
                        // else {
                        //     $(".note").html('');
                        // }
                    },
                    complete:function () {
                        // $send.css({"z-index":-1});
                        // $loading.ss({"z-index":1});

                        $(".launchBtn").each(function (i) {
                            $(this).removeAttr("disabled");
                        });
                    }

                });
            });

            // $loading.on("click",function (e) {
            //     e.preventDefault();
            // });




    });



    $("#gb_button").on("click",function () {

        $(".cbtn_button").each(function (i) {
            $(this).attr("disabled","true");
        });

        $.get("./form/get_url.php",function (d) {
            var $data = d.split(",");
            location.href = "./home.php?id="+$data[0];
        }).always(function () {
            // setTimeout(function () {
            //     $(".cbtn_button").each(function (i) {
            //         $(this).removeAttr("disabled");
            //     });
            // },1000);
        })
    });


    $("#lo_button").on("click",function () {
        // alert('1');

        $(".cbtn_button").each(function (i) {
            $(this).attr("disabled","true");
        });

        $.ajax({
            url:"./form/log_out.php",
            method:"GET",
            success:function () {
                // location.href = "./index.php";
            },
            complete:function () {
                location.href = "./index.php";
            }
        });

    });




    /*
        Show the images of news or threads by clicking.
     */

    var $theme = $("#theme");
    var $content = $("#content");
    var $formWidth = $("#thread").width();
    $theme.css({width:$formWidth});
    $content.css({width:$formWidth});

    var $contentHeight = $("#thread").height() -$(".note").height() - $("#themeT").height()-$theme.height()-$("#contentT").height()-60;
    $content.css({height:$contentHeight});

    // $(window).on("resize",function () {
    //     $tb_width = $("#toolbar").width();
    //     $b_left = $tb_width/2-$button.width()/2;
    //     $button.css({left:$b_left});
    //     $("#gb_button").css({left:$b_left});
    //     $pi.css({left:$b_left});
    //
    //
    //     $theme = $("#theme");
    //     $content = $("#content");
    //     $formWidth = $("#thread").width();
    //     $theme.css({width:$formWidth});
    //     $content.css({width:$formWidth});
    //
    //     $contentHeight = $("#thread").height()-$(".note").height() - $("#themeT").height()-$theme.height()-$("#contentT").height()-60;
    //     $content.css({height:$contentHeight});
    // });

    
    var $thread_image = $(".thread_image");
    $thread_image.each(function (index) {



        $(this).on("click",function () {

            var show_image = $("#show_image");
            if(!show_image.hasClass("clicked")){
                show_image.addClass("clicked");

                show_image.css({"z-index":"2","background": "no-repeat center white"});
                $("#thread_image").attr("src",$(this).attr("src"));

            }


        });

        $("#show_image").on("click",function () {

            if($("#show_image").hasClass("clicked")){

                $("#show_image").removeClass("clicked");

                $("#show_image").css({"z-index": "-1"});

                }
        })




        //
        // var $ti_flag = 1;
        // $(this).on("click",function (e) {
        //     e.stopPropagation();
        //     if($ti_flag===1)
        //     {
        //         $("#show_image").css({"z-index":"2","background": "no-repeat center white url(" + $(this).attr("src") +")"});
        //         $ti_flag = -$ti_flag;
        //     }
        // });
        // $("#show_image").on("click",function () {
        //     if($ti_flag===-1) {
        //         $("#show_image").css({"z-index": "-1", "background-image": ""});
        //         $ti_flag = -$ti_flag;
        //     }
        // })
    });

    // var $threads = $(".threads");
    // $threads.on("scroll",function () {
    //     if($threads.scrollTop()>=0 && $threads.scrollTop()<=1000){
    //         var $image_y = 50+$threads.scrollTop()/2;
    //         $threads.css("background-position","50% "+$image_y+"%");
    //     }
    // });

    // var $single_thread = $(".single_thread");
    // $single_thread.each(function () {
    //     $(this).on("click",function () {
    //         location.href = $(this).children(".thread_title").children("a").attr("href");
    //     })
    // })

});