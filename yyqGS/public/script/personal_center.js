$(window).on("load",function () {
    var $notification = $("#notification");
    var $likes = $("#likes");
    var $pc = $("#person_content");
    var $lc = $("#like_content");

    var $bbb_width = $("#bottom_bar").width()/2-4;
    var $b_height = $notification.height();

    $notification.css({width:$bbb_width+"px","line-height":$b_height+"px"});
    $likes.css({width:$bbb_width+"px","line-height":$b_height+"px"});

    $(window).on("resize",function () {
        var $bbb_width = $("#bottom_bar").width()/2-4;
        var $b_height = $notification.height();

        $notification.css({width:$bbb_width+"px","line-height":$b_height+"px"});
        $likes.css({width:$bbb_width+"px","line-height":$b_height+"px"});
    });

    $notification.on("click",function () {
        $pc.css({left:"60px",opacity:"1",transition:"all .7s ease-in-out"});
        $pc.css("z-index","1");
        $lc.css({left:"calc(100% - 60px)",opacity:"0",transition:"all .7s ease-in-out"});
        $lc.css("z-index","-1");
    });

    $likes.on("click",function () {
        $lc.css({left:"60px",opacity:"1",transition:"all .7s ease-in-out"});
        $lc.css("z-index","1");
        $pc.css({left:"calc(-100% + 180px)",opacity:"0",transition:"all .7s ease-in-out"});
        $pc.css("z-index","-1");
    });


    $(".new").each(function (i) {
        $(this).on("click",function () {
            $("#loading_page").css({"z-index":"20"});
            $.ajax({
                type:"GET",
                url:"/yyqGS/public/form/get_url.php",
                success:function (d) {
                    var $data = d.split(",");
                    $.ajax({

                        url:"/yyqGS/public/form/notification_new.php?id="+$data[0],
                        data:{index:i},
                        type:"POST",
                        success:function () {
                            location.reload();
                        },
                        complete:function () {

                            $("#loading_page").css({"z-index":"-1"});
                        }
                    })
                }
            });
        })
    });

    $(".likes_container").each(function (i) {

        $(this).on("click",function () {
            $.get( "/yyqGS/public/form/get_url.php",function (d) {
                var $data = d.split(",");
                $.post("/yyqGS/public/form/goto_likes.php?id="+$data[0],{index:i},function (d) {
                    var $data = d.split(",");

                        location.href = "/yyqGS/public/thread.php?id=" +$data[0]+ "&country=" +$data[1]+ "&tid="+$data[2];

                });
            })
        })
    });

    $(".go").each(function (i) {
        $(this).on("click",function () {
            $.get( "/yyqGS/public/form/get_url.php",function (d) {
                var $data = d.split(",");
                $.post("/yyqGS/public/form/goto.php?id="+$data[0],{index:i},function (d) {
                    var $data = d.split(",");
                    if($data[3]==='1'){
                        location.href = "/yyqGS/public/thread.php?id=" +$data[0]+ "&country=" +$data[1]+ "&tid="+$data[2];
                    }
                    else{
                        location.href = "/yyqGS/public/thread.php?id=" +$data[0]+ "&country=" +$data[1]+ "&tid="+$data[2]+"&page="+$data[3];
                    }
                });
            })
        })
    });

    var $new_count = $(".new").length;
    $.post("/yyqGS/public/form/newClassCount.php",{length:$new_count},function (d) {

    });


    $("#gb").on("click",function () {
        $.get("/yyqGS/public/form/get_url.php",function (d) {
            var $data = d.split(",");
            location.href = "/yyqGS/public/home.php?id="+$data[0];
        })
    });

    $(".profile_image2").on("click",function () {

        location.href = "/yyqGS/public/change_profile_picture.php";
    });


});