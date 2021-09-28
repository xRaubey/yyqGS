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


    // $(".new").each(function (i) {
    //     $(this).on("click",function () {
    //         // $("#loading_page").css({"z-index":"20"});
    //         $.ajax({
    //             type:"GET",
    //             url:"/yyqGS/public/form/get_url.php",
    //             success:function (d) {
    //                 var $data = d.split(",");
    //                 $.ajax({
    //
    //                     url:"/yyqGS/public/form/notification_new.php?id="+$data[0],
    //                     data:{index:i},
    //                     type:"POST",
    //                     success:function () {
    //
    //                         $(this).removeClass("new");
    //                         $(this).addClass("bg-light");
    //
    //                     },
    //                     complete:function () {
    //
    //                         // $("#loading_page").css({"z-index":"-1"});
    //                     }
    //                 })
    //             }
    //         });
    //     })
    // });


    // $(".note_container").each(function (i) {
    //
    //     $(this).on("click",function () {
    //
    //     if($(this).hasClass("new")) {
    //
    //         console.log((".$info."[i]));
    //
    //
    //         $.ajax({
    //
    //             url: "./form/notification_new.php",
    //             data: {index: i, id: ".$sid."},
    //             type: "POST",
    //             success: function () {
    //
    //                 $(this).removeClass("new");
    //                 $(this).addClass("bg-light");
    //
    //             },
    //             complete: function () {
    //
    //             }
    //         })
    //     }
    //
    //
    //     else{
    //
    //         console.log("not new");
    //
    //         }
    //
    //     });
    //
    // });

    // $(".likes").each(function (i) {
    //
    //     $(this).on("click",function () {
    //
    //         $.ajax({
    //             url:"./form/goto_likes.php",
    //             data:{id:$sid},
    //             success:function (d) {
    //                 var likes_data = JSON.parse(d)[i];
    //                 location.href = "./thread.php?id=" +$sid+ "&country=" +likes_data.country+ "&tid="+likes_data.tid;
    //             }
    //         });
    //
    //     })
    // });

    // $(".go").each(function (i) {
    //     $(this).on("click",function () {
    //         $.get( "/yyqGS/public/form/get_url.php",function (d) {
    //             var $data = d.split(",");
    //             $.post("/yyqGS/public/form/goto.php?id="+$data[0],{index:i},function (d) {
    //                 var $data = d.split(",");
    //                 if($data[3]==='1'){
    //                     location.href = "/yyqGS/public/thread.php?id=" +$data[0]+ "&country=" +$data[1]+ "&tid="+$data[2];
    //                 }
    //                 else{
    //                     location.href = "/yyqGS/public/thread.php?id=" +$data[0]+ "&country=" +$data[1]+ "&tid="+$data[2]+"&page="+$data[3];
    //                 }
    //             });
    //         })
    //     })
    // });


    // $(".go").each(function (i) {
    //     $(this).on("click",function () {
    //
    //         var go_info = info[i];
    //
    //         if(go_infopage===1 || go_info.page==='1'){
    //             location.href = "/yyqGS/public/thread.php?id=" +$sid+ "&country=" +go_info.country+ "&tid="+go_info.tid;
    //         }
    //         else{
    //             location.href = "/yyqGS/public/thread.php?id=" +$sid+ "&country=" +$info[i].country+ "&tid="+$info[i].tid+"&page="+$info[i].page;
    //         }
    //
    //     })
    // });



    var $new_count = $(".new").length;
    $.post("./form/newClassCount.php",{length:$new_count},function (d) {

    });


    // $("#gb_button").on("click",function () {
    //     $.get("/yyqGS/public/form/get_url.php",function (d) {
    //         var $data = d.split(",");
    //         location.href = "/yyqGS/public/home.php?id="+$data[0];
    //     })
    // });

    // $(".note_container").each(function () {
    //     $(this).on("click",function () {
    //         $(this).removeClass("new");
    //         $(this).addClass("bg-light");
    //     })
    // });


    $(".profile_image2").on("click",function () {

        location.href = "./change_profile_picture.php";
    });




});