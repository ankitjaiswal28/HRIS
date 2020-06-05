<div class="message_patch">


    <div class="message_header">
        <div class="media">
            <div class="media-left media_margin_top_bottom">
                <img src="https://via.placeholder.com/150" alt="" class="media-object" style="width: 40px;">
            </div>
            <div class="media-body media_margin_top_22">
                @foreach($user_header as $user_header_name)
                <h4 class="name" style="float: left;font-weight: 900;" id="dyanmicName">
                    {{ $user_header_name->username}}</h4>
                @endforeach
                <a id="flip" class="three_dots" style="float: right;"><i class="fa fa-ellipsis-v"
                        aria-hidden="true"></i></a>
                <div id="myDIV" style="display: none;">
                    <div class="media-left">
                        <div style="float: left;margin-left: 6px;margin-top: 10px;">
                            <h3 style="float: left;font-weight: 800;">{{ $user_header_name->username}}</h3>
                            <p>{{ $user_header_name->emailId}}</p>
                        </div>
                        <img src="https://via.placeholder.com/150" alt="" class="media-object chat_profile">
                    </div>
                    <div class="detail-changes">
                        {{-- <input type="text" placeholder="Search in Conversation"> --}}
                        <div class="detail-change">
                            Change Color
                            <div class="colors">
                                <div class="color blue selected" data-color="blue"></div>
                                <div class="color purple" data-color="purple"></div>
                                <div class="color green" data-color="green"></div>
                                <div class="color orange" data-color="orange"></div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-photos" style="margin-top: 0px;">
                        <div class="detail-photo-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-image">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <path d="M21 15l-5-5L5 21" /></svg>
                            Shared photos
                        </div>
                        <div class="detail-photo-grid">
                            @foreach($messages as $message)

                            <?php if ($message->type == 'image') { ?>
                            <img src="<?php echo str_replace(" ","+",$message->message) ?>" />
                            <?php } ?>
                            @endforeach
                        </div>
                        <div class="view-more">View More</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="message-wrapper" id="main_msg_screen">

        <ul class="messages">
            <?php $session_userid = session()->get('userid');?>
            @foreach($messages as $message)
            <?php
                $var_msg = $message->from_id;
                $time = date('h:i A', strtotime($message->created_at));
            if ($var_msg == $session_userid) {
                ?>
            <li class="message clearfix">

                <?php if ($message->type == 'text') {
                        ?>
                <div class="sent">
                    <p>{{ $message->message}}</p>
                    <p class="date"><?php echo $time?></p>
                </div>
                <?php
                        # code...
                    }else if ($message->type == 'image') {
                        ?>
                <div class="sent sender_imgg">
                    <a onclick="openpoup('<?php echo str_replace(' ','+',$message->message) ?>')">
                        <img  src="<?php echo str_replace(" ","+",$message->message) ?>" style="height: 200px;"
                            id="img_pop"></a>
                    <p class="date image_rcvd_date"><?php echo $time?></p>
                </div>
                <?php } ?>
            </li>
            <?php
            }else {
                ?>
            <li class="message clearfix">

                <?php if ($message->type == 'text') { ?>
                <div class="received">
                    <p>{{ $message->message}}</p>
                    <p class="date recvd_date"><?php echo $time?></p>
                </div>
                <?php } else if ($message->type == 'image') {?>
                <div class="received sender_imgg">
                    <a onclick="openpoup('<?php echo str_replace(' ','+',$message->message) ?>')">
                        <img  src="<?php echo str_replace(" ","+",$message->message) ?>" style="height: 200px;"
                            id="img_pop"></a>

                    <p class="date recvd_date image_rcvd_date"><?php echo $time?></p>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
            @endforeach
        </ul>
    </div>
    <div id="image_show_div" class="image_show_div">
        <div style="text-align: center;">
            <img src="" id="encoded_img" class="image_attach_size">
        </div>
        <div style="text-align: center;">
            <button style="width: 30%;" onclick="send_img_to_database()">Send</button></div>
    </div>

    <div style="display: flex;">
        <div class="input-text" style="width: -webkit-fill-available;width: 100%;">
            <div class="container full-width">
                <div class="row justify-content-center">
                    <p class="lead emoji-picker-container" style="display:flex;margin-bottom: 0px;">
                        <input type="text" data-emoji-input="unicode" id="messge_input" class="form-control"
                            placeholder="Type a message" data-emojiable="true" class="submit">
                        <span class="image_uploadspan" style="position: relative;right: 35px;top: 5px;">
                            <label for="file-input">
                                <i class="fa fa-picture-o" aria-hidden="true"
                                    style="cursor: pointer;color: #737373;"></i>
                            </label>
                            <input id="file-input" type="file" onchange="encodeImageFileAsURL(this)" />
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal" style="z-index: 2000;">
    <div class="modal-content">
        <div>
            <a class="" href="#" style="color: black;font-size: 25px;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            <a class="close" href="#" style="color: black;"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <img src="" id="myImg" alt="" style="align-self: center;height: calc(100vh - 80px);">
    </div>
</div>
<script>
    function openpoup(imgsrc) {
        var imagesrc = imgsrc;
        document.getElementById("myImg").src = imagesrc;
        var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    }

</script>
<script type="text/javascript">
    $(function() {
     var images = ['doodle1.jpg','doodle2.jpg','doodle3.jpg','doodle4.jpg','doodle5.jpg','doodle6.jpg','doodle10.jpg','doodle11.jpg','doodle12.png','doodle13.png','doodle14.png','doodle15.png','doodle16.png','doodle17.png','doodle18.png','doodle19.png','doodle20.jpg','doodle21.jpg','doodle22.jpg','doodle23.jpg','doodle24.jpg','doodle25.jpg','doodle26.jpg','doodle27.jpg','doodle28.jpg','doodle29.jpg','doodle30.jpg'];
     $('#main_msg_screen').css({'background': 'url(../asset/images/doodle/' + images[Math.floor(Math.random() * images.length)] + ')'});
    });
</script>
<script>
    function newTabImage() {
    var image = new Image();
    image.src = $('#idimage').attr('src');

    var w = window.open("",'_blank');
    w.document.write(image.outerHTML);
    w.document.close();
}
</script>
<script>
    $(document).ready(function(){
        $("#flip").click(function(){
        $("#myDIV").slideToggle("fast");
      });
     });
</script>
<script>
    $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'http://onesignal.github.io/emoji-picker/lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
      });
</script>
<script>
    const colors = document.querySelectorAll('.color');

colors.forEach(color => {
  color.addEventListener('click', e => {
    colors.forEach(c => c.classList.remove('selected'));
    const theme = color.getAttribute('data-color');
    document.body.setAttribute('data-theme', theme);
    color.classList.add('selected');
  });
});
</script>
