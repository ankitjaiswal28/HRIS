@extends('Layout.app')
@section('content')

<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">Edit User<?php print_r($details);?></span><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="flip-card-3D-wrapper" style="width: 35% !important;">
    <div class="columns">
        <div class="inner-column" id="flip-card">
            <div class="flip-card-front" style="padding-top: 10px;">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Edit User</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import"
                                    style="width: 20px;margin-right: 0px;"></button>
                        </div>
                    </div>
                    <div class="padding_20" style="padding: 0px 35px;">
                        <form action="#" name="client_form" id="client_form" class="form_class" data-parsley-validate autocomplete="off">
                            <div class="row">
                                <div class=" col-sm-12 col-xs-12 col-md-12">
                                    <div class="">
                                    <select class="js-example-basic-multiple" name="roles[]" multiple="multiple" id="roles" data-parsley-trigger="change" required="required">
                                    <?php
                                     $length = count($roles);
                                     $assinroles = explode(",", $details['master_roleId']);
                                     // array($details['master_roleId']);
                                     print_r($assinroles);
                                    for($i = 0 ; $i < $length; $i ++) {
                                        ?>
                                        <option value={{$roles[$i]->MASTER_ROLE_ID}} <?php if (in_array($roles[$i]->MASTER_ROLE_ID, $assinroles))
                                        {
                                            echo 'selected';
                                        }
                                        ?>
                                        ><?php echo $roles[$i]->MASTER_ROLE_NAME?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="colll-3 input-effect">
                                        <input class="effect-16" type="text" placeholder="" style="clear:both" id="username" name="username" data-parsley-trigger="blur" required="" value ={{$details['username']}}>
                                        <label>User Name</label>
                                        <span class="focus-border" ></span>

                                    </div>
                                    <div class="">
                                    <select class="js-example-basic-multiple" name="reportingmanger[]" multiple="multiple" id="reportingmanger">
                                    <?php
                                     $length = count($users);
                                     $assinmanagers = explode(",", $details['REPORTING_MANGERS']);
                                     // array($details['REPORTING_MANGERS']);
                                    for($j = 0 ; $j < $length; $j++) {
                                        ?>
                                        <option value={{$users[$j]->userId}}
                                        <?php if (in_array($users[$j]->userId, $assinmanagers))
                                        {
                                            echo 'selected';
                                        }
                                        ?>
                                        ><?php echo $users[$j]->username?></option>

                                        <?php
                                    }
                                    ?>
                                    </select>
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="colll-3 input-effect">
                                    <input type="email" class="effect-16"  id="email" placeholder="" style="clear:both" name="email"  autocomplete="off"  data-parsley-type="email"  data-parsley-trigger="blur" required="" value= {{$details['emailId']}} >
                                        <label>User Email</label>
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="colll-3 input-effect">
                                    <input type="password" class="effect-16" id="pwd"placeholder="" style="clear:both" name="pwd" autocomplete="new-password" data-parsley-trigger="blur" required="" value= {{$details['passwords']}}>
                                        {{-- <input class="effect-16" type="password" placeholder="" style="clear:both" name="pwn"  autocomplete="new-password"> --}}
                                        <label>Password</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                            <div style="margin: 15px 0px;">
                            <button type="button" name="submit_id" id="btn_id"  class="btnn" style="border: none;">Submit</button>
                            <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
                                {{-- <button type="submit" class="btnn" style="border: none;">Submit</button> --}}
                                {{-- <a href="/Superadmin/my_account" class="btnn">My Account</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flip-card-back">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Import Client</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-front" data-tooltip="Entry Form" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/edit-pencil.svg" alt="Import"
                                    style="width: 20px;margin-right: 0px;"></button>
                        </div>
                    </div>
                    <br>
                    <div style="text-align: -webkit-center;">
                        <form action="#">
                            <h4>Choose Csv file</h4>
                            <div class="input-file-container">
                                <input class="input-file" id="my-file" type="file">
                                <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
                            </div>
                            <p class="file-return"></p>
                            <br>
                            <div style="margin: 15px 0px;">
                                <button type="submit" class="btnn" style="border: none;">Submit</button>
                                {{-- <a href="/Superadmin/my_account" class="btnn">My Account</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div >

            </div> --}}
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
<script>
 $(document).ready(function() {
     $('.js-example-basic-multiple').select2();
     $("#roles").select2({
    placeholder: "Roles",
    allowClear: true
});
$("#reportingmanger").select2({
    placeholder: "Reporting Mangers",
    allowClear: true
})

     $('#loading-image').bind('ajaxStart', function() {
         $(this).show();
	}).bind('ajaxStop', function() {
		$(this).hide();
	});
    $('input').parsley();
    $('#btn_id').click(function(event) {
        event.preventDefault();
        // Validate all input fields.
        var isValid = true;
        $('input').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        // console.log('Welcome' + isValid);
       //  $("#roles").val();
       // console.log('roles' + $("#roles").val());
        // return
        if (isValid) {
            $('#loading-image').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/createUser',
                type: 'POST',
                data: {
                    roles: $("#roles").val(),
                    username: $('#username').val(),
                    reportingmanger: $('#reportingmanger').val(),
                    email: $('#email').val(),
                    pwd: $('#pwd').val(),
                    },
                    success: function(data) {
                        console.log('Data', data);
                         // return;
                         var response = data.trim();
                         if(response == 'Erorr'){
                             alert('Something Went Wrong')
                         } else if(response == 'Already') {
                              alert('Email ID Already Exits');
                              $('#email').val('');
                         } else {
                             alert('User Craeted Sucessfuly');
                             // window.location.href = 'SuperAdmin/superadmindahboard';
                             var url = '{{ route("Admin/User") }}';
                             window.location.href = url;
                             //window.location.href ='Superadmin/client'
                         }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
      }
    })
 });
</script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
<script>
    document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");

button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
fileInput.addEventListener( "change", function( event ) {
    the_return.innerHTML = this.value;
});
</script>
<script>
 $(window).load(function(){
        var inputs = document.getElementsByTagName('input'),
        empty = 0;

    for (var i = 1, len = inputs.length - 1; i < len; i++) {
        empty += !inputs[i].value;
        var tag = inputs[i];
        if(inputs[i].value != '') {
            var id = $(tag).attr('id');
            $('#' + id).addClass("has-content");
        } else {
            var id = $(tag).attr('id');
            $('#' + id).removeClass("has-content");
        }
    }
	});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function(event) {

document.getElementById('flip-card-btn-turn-to-back').style.visibility = 'visible';
document.getElementById('flip-card-btn-turn-to-front').style.visibility = 'visible';

document.getElementById('flip-card-btn-turn-to-back').onclick = function() {
document.getElementById('flip-card').classList.toggle('do-flip');
};

document.getElementById('flip-card-btn-turn-to-front').onclick = function() {
document.getElementById('flip-card').classList.toggle('do-flip');
};

});
</script>
@endsection
