@extends('Layout.app')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@next/dist/tailwind.css"> --}}
<style>
    input:checked+label {
        background-color: LightSeaGreen;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .dropdoen_height {
        height: calc(2.5rem + 2px);
        border: 1px solid #cecece !important;
        padding: 8px !important;
    }
</style>
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/Superadmin/User') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="
        font-size: 18px;">All Employee</span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="flip-card-3D-wrapper" style="width: 100% !important;">
    <div class="columns">
        <div class="inner-column" id="flip-card">
            <div class="flip-card-front" style="padding-top: 10px;margin-bottom: 15px;">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Add User</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import"
                                    style="width: 20px;"></button>
                        </div>
                    </div>
                    <div class="padding_20" style="padding: 0px 35px;">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <h4 class="h4_middle_line"><span>BASIC INFORMATION</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 col-md-4">
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
                                    <form>
                                        <label class="avatars">
                                            <input type="radio" name="avatar" value="/asset/images/Avatar/user.png" />
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
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect" style="    margin: 16px 0%;
                                        ">
                                            <input class="effect-16" type="text" placeholder="" style="clear:both">
                                            <label>Date Of Birth</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="inline-flex"
                                            style="inline-size: max-content;position: relative;top: 16px;">
                                            <input class="hidden" type="radio" id="male" value="male" name="gender"
                                                style="display: none;" checked />
                                            <label
                                                class="bg-gray-300  text-gray-800 font-semibold  cursor-pointer rounded-l"
                                                for="male" style="padding: 7px 15px;">Male</label>
                                            <input class="hidden" type="radio" id="female" value="female" name="gender"
                                                style="display: none;" />
                                            <label class="bg-gray-300  text-gray-800 font-semibold  cursor-pointer"
                                                for="female" style="padding: 7px 15px;">Female</label>
                                            <input class="hidden" type="radio" id="non-binary" value="non-binary"
                                                name="gender" style="display: none;" />
                                            <label
                                                class="bg-gray-300  text-gray-800 font-semibold cursor-pointer rounded-r"
                                                for="non-binary" style="padding: 7px 15px;">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 col-md-8">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="first_name" placeholder=""
                                                style="clear:both">
                                            <label>First Name</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="lastname" placeholder=""
                                                style="clear:both">
                                            <label>Last Name</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="nickname" placeholder=""
                                                style="clear:both">
                                            <label>Nick Name</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            {{-- <div class="form-group"> --}}
                                            <select class="form-control dropdoen_height" id="sel1">
                                                <option>Marital Status</option>
                                                <option>Marital Status</option>
                                                <option>Marital Status</option>
                                                <option>Marital Status</option>

                                            </select>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="primary_emailid" placeholder=""
                                                style="clear:both">
                                            <label>Primary Email id</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="work_emailid" placeholder=""
                                                style="clear:both">
                                            <label>Work Email id</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="contact_no" placeholder=""
                                                style="clear:both">
                                            <label>Contact No</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-6">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="tel_no" placeholder=""
                                                style="clear:both">
                                            <label>Tel No</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <h4 class="h4_middle_line"><span>RESIDENCE INFORMATION</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="street" placeholder=""
                                                style="clear:both">
                                            <label>Street</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="city" placeholder=""
                                                style="clear:both">
                                            <label>City</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="state" placeholder=""
                                                style="clear:both">
                                            <label>State</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="zip_code" placeholder=""
                                                style="clear:both">
                                            <label>Zip-Code</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="country" placeholder=""
                                                style="clear:both">
                                            <label>Country</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="nationality" placeholder=""
                                                style="clear:both">
                                            <label>Nationality</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <h4 class="h4_middle_line"><span>WORK INFORMATION</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="department" placeholder=""
                                                style="clear:both">
                                            <label>Department</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="expirence" placeholder=""
                                                style="clear:both">
                                            <label>Experience</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="reporting_to" placeholder=""
                                                style="clear:both">
                                            <label>Reporting To</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="source_hire" placeholder=""
                                                style="clear:both">
                                            <label>Source of hire</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="location" placeholder=""
                                                style="clear:both">
                                            <label>Location</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="title" placeholder=""
                                                style="clear:both">
                                            <label>Title</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="employee_status" placeholder=""
                                                style="clear:both">
                                            <label>Employee status</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-md-4">
                                        <div class="colll-3 input-effect">
                                            <input class="effect-16" type="text" id="work_phone" placeholder=""
                                                style="clear:both">
                                            <label>Work phone</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 15px 0px;">
                            <button type="submit" class="btnn" id="submit_form" style="border: none;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flip-card-back" style="left: -15px;">
                <div class="">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="left_border font_grey" style="float: left;">Import Role</h1>
                        </div>
                        <div class="col-md-2">
                            <button id="flip-card-btn-turn-to-front" data-tooltip="Entry Form" class="box circle"><img
                                    src="/asset/css/zondicons/zondicons/edit-pencil.svg" alt="Import"
                                    style="width: 20px;"></button>
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
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
{{-- <script src="/asset/js/jquery.min.js"></script> --}}
<script>
    $(document).ready(function(){
    $("#submit_form").click(function() {
        var role_icon = $("#role_icon")[0].files[0].name;
      var role_avatar = $('input[name="avatar"]:checked').val();
      var fname = $("#first_name").val();
      var lname = $("#lastname").val();
      var nickname = $("#nickname").val();
      var marital_status = $("#marital_status").val();
      var primary_emailid = $("#primary_emailid").val();
      var work_emailid = $("#work_emailid").val();
      var contact_no = $("#contact_no").val();
      var tel_no = $("#tel_no").val();

      var street = $("#street").val();
      var city = $("#city").val();
      var state = $("#state").val();
      var zip_code = $("#zip_code").val();
      var country = $("#country").val();
      var nationality = $("#nationality").val();

      var department = $("#department").val();
      var expirence = $("#expirence").val();
      var reporting_to = $("#reporting_to").val();
      var source_hire = $("#source_hire").val();
      var location = $("#location").val();
      var title = $("#title").val();
      var employee_status = $("#employee_status").val();
      var work_phone = $("#work_phone").val();

      var datastring = 'fname='+fname+'&lname='+lname+'&nickname='+nickname+'&marital_status='+marital_status+'&primary_emailid='+primary_emailid+'&work_emailid='+work_emailid+'&contact_no='+contact_no+'&tel_no='+tel_no+'&street='+street+'&city='+city+'&state='+state+'&zip_code='+zip_code+'&country='+country+'&nationality='+nationality+'&department='+department+'&expirence='+expirence+'&reporting_to='+reporting_to+'&source_hire='+source_hire+'&location='+location+'&title='+title
      +'&employee_status='+employee_status+'&work_phone='+work_phone;

      $.ajax({
          type:"POST",
          url: "/Add_User_Submit",
          data: datastring,
          cache: false,
          success:function(result){
              alert(result);
          }
      });

      console.log("role_icon :",role_icon);
      console.log("role_avatar :",role_avatar);
      console.log("First_name :",fname);
      console.log("Last_name :",lname);
      console.log("nickname :",nickname);
      console.log("marital_status :",marital_status);
      console.log("primary_emailid :",primary_emailid);
      console.log("work_emailid :",work_emailid);
      console.log("contact_no :",contact_no);
      console.log("tel_no :",tel_no);
      console.log("street :",street);
      console.log("city :",city);
      console.log("state :",state);
      console.log("zip_code :",zip_code);
      console.log("country :",country);
      console.log("nationality :",nationality);
      console.log("department :",department);
      console.log("expirence :",expirence);
      console.log("reporting_to :",reporting_to);
      console.log("source_hire :",source_hire);
      console.log("location :",location);
      console.log("title :",title);
      console.log("employee_status :",employee_status);
      console.log("work_phone :",work_phone);
    });
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
