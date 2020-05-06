@extends('Layout.app')
@section('content')
<style>

</style>
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/Superadmin/role') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="
        font-size: 18px;">All Role</span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="flip-card-3D-wrapper" style="width: 35% !important;">
    <div class="columns">
        <div class="inner-column" id="flip-card">
            <div class="flip-card-front" style="padding-top: 10px;">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Edit Role</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import"
                                    style="width: 20px;margin-right: 0px;"></button>
                        </div>
                    </div>
                    <div class="padding_20" style="padding: 0px 35px;">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <div class="container">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="role_icon" accept=".png, .jpg, .jpeg" />
                                            <label for="role_icon"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url(/asset/images/Avatar/user.png);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="avatars">
                                    <form action="#" name="addRole_form" id="addRole_form" class="form_class" data-parsley-validate autocomplete="off">
                                    <input type="hidden" name="roleId" id="roleId" value={{$Details->MASTER_ROLE_ID}} />
                                        <label style="">Select Icon</label>
                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user.png"  />
                                            <img src="/asset/images/Avatar/user.png" alt="" />
                                        </label>

                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-1.png" />
                                            <img src="/asset/images/Avatar/user-1.png" alt="" />
                                        </label>

                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-2.png" />
                                            <img src="/asset/images/Avatar/user-2.png" alt="" />
                                        </label>

                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-3.png" />
                                            <img src="/asset/images/Avatar/user-3.png" alt="" />
                                        </label>

                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-4.png" />
                                            <img src="/asset/images/Avatar/user-4.png" alt="" />
                                        </label>

                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-5.png" />
                                            <img src="/asset/images/Avatar/user-5.png" alt="" />
                                        </label>
                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user-6.png" />
                                            <img src="/asset/images/Avatar/user-6.png" alt="" />
                                        </label>
                                    </form>

                                </div>
                            </div>
                            <div class=" col-sm-12 col-xs-12 col-md-12">
                                <div class="colll-3 input-effect">
                                    <input class="effect-16" type="text" placeholder="" style="clear:both"
                                        id="role_name" data-parsley-trigger="blur" required="" value = "<?php echo $Details->MASTER_ROLE_NAME;?>" />
                                    <label>Role Name</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 15px 0px;">
                            <button type="button" class="btnn" id="submit_form" style="border: none;">Submit</button><img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
                            {{-- <a href="/Superadmin/my_account" class="btnn">My Account</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="flip-card-back">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Import Role</h1>
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
    $(document).ready(function(){
        $('#loading-image').bind('ajaxStart', function() {
         $(this).show();
	}).bind('ajaxStop', function() {
		$(this).hide();
	});
        $('input').parsley();
        $("#submit_form").click(function() {
            event.preventDefault();
            var role_icon = $("#role_icon")[0].files[0];
            let roleIconImages = '';
            if(role_icon != undefined) {

                var path = "/asset/images/UploadsIcons/";
                roleIconImages = path + $("#role_icon")[0].files[0].name;
            } else {
                 roleIconImages = $('input[name="avatar"]:checked').val();
            }

        var isValid = true;
        $('input').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        if (isValid) {
            var role_name = $("#role_name").val();
            var roleId = $("#roleId").val();
            $('#loading-image').show();
           //  var formData = new FormData($("#addRole_form")[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/updateRoleName',
                type: 'POST',
                //  data: formData,
                 // processData: false,
     //   contentType: false,
               data: {
                    role_name: role_name,
                    roleIconImages: roleIconImages,
                    roleId: roleId,
                    },
                    success: function(data) {
                        console.log('Data', data)
                         // return;
                         var response = data.trim();
                         if(response == 'Done') {
                             alert('Role Updated Sucessfuly');
                             var url = '{{ route("Admin/role") }}';
                             window.location.href = url;
                         } else if(response == 'Already') {
                             alert('Role Already  Exits');
                             $("#role_name").val('');
                        } else {
                             alert('Something Went Wrong');
                             // window.location.href = 'SuperAdmin/superadmindahboard';

                             //window.location.href ='Superadmin/client'
                         }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
        }
        });
    });
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
function downloadBackgroundImage(element) {

  // get the backgroundImage of the passed DOM element
  const backgroundImage = element.style.backgroundImage;

  // sanitize the backgroundImage style value by removing url(..)
  // to get a value suitable for the href attribute below
  const imageURL = backgroundImage.slice(4, -1).replace(/"/g, "");

  // extract image filename for download attribute
  const imageFilename = imageURL.slice(imageURL.lastIndexOf("/") + 1);

  // create a temporary anchor element and set the href attribute
  // and add it to our DOM
  var a = document.createElement("a");
  a.setAttribute("href", imageURL);
  a.setAttribute("download", imageFilename);

  document.body.appendChild(a);

  // invoke the click behavior to trigger download
  a.click();

  // housekeeping - remove the temporary anchor element
  a.remove();
}

$("#role_icon").change(function() {
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
        var id = "<?php echo $Details->ICON_NAME;?>"
        //alert(id);
        $('input[name="avatar"]:checked').val(id);
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
