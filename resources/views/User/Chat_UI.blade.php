@extends('Layout.app')
@section('content')
<link rel="stylesheet" href="https://onesignal.github.io/emoji-picker/lib/css/emoji.css">

<style>

</style>
<div class="new-wrapper">
    <div id="main">
        <div class="container-fluid" style="margin-top: 10px;">
            <div class="row">
                <div class="col-md-4" style="padding-right: 0px;">
                    <div class="user-wrapper">
                        <div class="users user_header">

                            <div class="form-group has-feedback has-search" style="border-radius: 20px;background: #dedede;margin-bottom: 0px;">
                                <i class="fa fa-search" aria-hidden="true" style="position: absolute;color: #949494;top: 20px;padding-left: 10px;"></i>
                                <input type="text" class="form-control" placeholder="Search" style="margin-top: 0px;padding-left: 35px !important;">
                              </div>
                        </div>
                        <ul class="users" >
                            <?php
                            $session_userid = session()->get('userid');
                            $getallDeatils_count = count($getallDeatils);
                            for($i = 0 ; $i < $getallDeatils_count; $i++) {
                                $FUll_NAME =  $getallDeatils[$i]->username;
                                $EMAIL_ID =  $getallDeatils[$i]->emailId;
                                $user_id =  $getallDeatils[$i]->userId;
                            ?>
                            <li class="user" id="<?php echo $user_id;?>">

                                <span class="pending">1</span>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name"><?php echo $FUll_NAME?></p>
                                        <p class="email"><?php echo $EMAIL_ID ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8" id="messages" style="padding-left: 10px;padding-right: 10px;">
                    <div class="message_patch">
                        <div class="message_header">
                            <div class="media">
                                <div class="media-left media_margin_top_bottom">
                                    <img src="https://via.placeholder.com/150" alt="" class="media-object" style="width: 40px;">
                                </div>
                                <div class="media-body media_margin_top_22">
                                    <h4 class="name" style="float: left;font-weight: 900;" id="dyanmicName">
                                        </h4>
                                </div>
                            </div>
                        </div>
                        <div class="message-wrapper" id="main_msg_screen" style="height: auto !important;">
                            <ul class="messages">
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 200px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 300px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 100px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 400px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 400px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 200px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 600px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 400px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 200px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 800px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="received" style="height: 35px;width: 400px;">
                                        <p></p>
                                        <p class="date recvd_date"></p>
                                    </div>
                                </li>
                                <li class="message clearfix">
                                    <div class="sent" style="height: 35px;width: 200px;">
                                        <p></p>
                                        <p class="date"></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




{{-- /////////////////////     right side setting popup    /////////////////// --}}
{{-- /////////////////////        END OF POPUP           ///////////////////// --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script src="/asset/js/emoji_picker/config.js"></script>
<script src="/asset/js/emoji_picker/emoji-picker.js"></script>
<script src="/asset/js/emoji_picker/jquery.emojiarea.js"></script>
<script src="/asset/js/emoji_picker/util.js"></script>
{{-- <script src="https://js.pusher.com/6.0/pusher.min.js"></script> --}}

<script>
    //     function myFunction() {
//   var x = document.getElementById("myDIV");
//   if (x.style.display === "none") {
//     x.style.display = "block";
//   } else {
//     x.style.display = "none";
//   }
// }

var receiver_id = '';
    var my_id = '<?php echo $session_userid;?>';
    var fullname = '<?php echo $FUll_NAME?>';
$(document).ready(function(){
  $("#flip").click(function(){
    $("#myDIV").slideToggle("fast");

    // alert(my_id);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  });

  $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            // alert(receiver_id);
            // getmeassage(receiver_id);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $.ajax({
                    type: "post",
                    url: "/User/seenmsg/" + receiver_id, // need to create this post route
                    data: receiver_id,
                    cache: false,
                    success: function (data) {
                        // console.log(data);


                        getmeassage(receiver_id);

                        // alert(data)
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {

                    }
                })


            setInterval(function(){
        // console.log('Hiiii');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            //// alert(receiver_id);
            $.ajax({
                type: "get",
                url: "getreciepent_message/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                 $('.messages').append(data);
                    //  scrollToBottomFunc();
                },complete: function() {
                //    scrollToBottomFunc();
                }
            });
}, 1000);
   });
});
</script>


<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {

            document.getElementById("image_show_div").style.display = 'block';
            document.getElementById("encoded_img").src = reader.result;
            // console.log('RESULT', reader.result)
        }
        reader.readAsDataURL(file);
    }

    function send_img_to_database() {
       var image_content = document.getElementById('encoded_img').getAttribute('src');
    //    console.log('src_name =',receiver_id);
    var type = 'image';
       var datastr = "receiver_id=" + receiver_id + "&message=" + image_content +"&type=" + type;
                $.ajax({
                    type: "post",
                    url: "/User/sendmessage", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        getmeassage(receiver_id);
            },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {

                    }
                })
    }
</script>
<script>
    $("div.new-wrapper").keyup(function(e){
       var message = $(e.target).text();
       var type = 'text';
       if (e.keyCode == 13 && message != '' && receiver_id != '') {
        $(e.target).text('');
        var datastr = "receiver_id=" + receiver_id + "&message=" + message +"&type=" + type;
                $.ajax({
                    type: "post",
                    url: "/User/sendmessage", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        getmeassage(receiver_id);
            },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {

                    }
                })
            }
    })
function getmeassage(receiver_id) {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            //// alert(receiver_id);
            $.ajax({
                type: "get",
                url: "getmessage/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                },complete: function() {
                   scrollToBottomFunc();
                }
            });
}
function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }

</script>

@endsection
