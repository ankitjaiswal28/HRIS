@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/Superadmin/role') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="
        font-size: 18px;">Add Leveles</span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="flip-card-3D-wrapper" style="width: 45% !important;">
    <div class="columns">
        <div class="inner-column" id="flip-card">
            <div class="flip-card-front" style="padding-top: 10px;">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Add Leveles</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import"
                                    style="width: 20px;margin-right: 0px;"></button>
                        </div>
                    </div>
                    <div class="padding_20" style="padding: 0px 35px;">
                        <div class="row">
                            <div class=" col-sm-12 col-xs-12 col-md-12">
                                <div class="colll-3 input-effect">
                                    <input class="effect-16" type="text" placeholder="" style="clear:both"
                                        id="level_name" data-parsley-trigger="blur" required="" data-parsley-errors-container=".erroslevels">
                                    <label>Levele Name</label>
                                    <span class="erroslevels"></span>
                                </div>
                                <div class="colll-3 input-effect">
                                    <input class="effect-16" type="text" placeholder="" style="clear:both"
                                        id="description" data-parsley-trigger="blur" required="" data-parsley-errors-container=".erroslevelsdescryption">
                                    <label>Level Desricption</label>
                                    <span class="erroslevelsdescryption"></span>
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
        var isValid = true;
        $('input').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        if (isValid) {

            var description = $("#description").val();
            var level_name = $("#level_name").val();
            // var role_avatar = $('input[name="avatar"]:checked').val();
            $('#loading-image').show();
           //  var formData = new FormData($("#addRole_form")[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/craeteLeveles',
                type: 'POST',
               data: {
                    level_name: level_name,
                    description: description,
                    // logo: role_icon,
                    },
                    success: function(data) {
                        console.log('Data', data)
                         //return;
                         var response = data.trim();
                         if(response == 'Done') {
                             alert('Leveles Added Sucessfuly');
                             var url = '{{ route("Admin/LevelsorGrade") }}';
                             window.location.href = url;
                         } else if(response == 'Already') {
                             alert('Leveles Already  Exits');
                             $("#level_name").val('');
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
		$(".colll-3 input").val("");

		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("has-content");
			}else{
				$(this).removeClass("has-content");
			}
		})
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
