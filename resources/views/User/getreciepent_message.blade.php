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
            $image_msg =str_replace(" ","+",$message->message);
            ?>
            <div class="sent sender_imgg">
        <img src="<?php echo $image_msg ?>" style="height: 200px;">
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
        <?php }else if ($message->type == 'image') {
        $image_msg =str_replace(" ","+",$message->message); ?>
        <div class="received sender_imgg">
        <img src="<?php echo $image_msg ?>" style="height: 200px;">
        <p class="date recvd_date image_rcvd_date"><?php echo $time?></p>
        </div>
        <?php } ?>
</li>
<?php } ?>
@endforeach

