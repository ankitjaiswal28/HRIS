@extends('Layout.app')
@section('changepassword')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<style>
    .hide {
    display: none!important;
}
    .centered {
        padding: 20px;
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }
    .form-control {
        border-bottom: 1px solid black !important;
        border-radius: 0px !important;
    }
</style>
<div class="container">
    <div class="row">
            <section class="col-md-4 centered neuphormic_shadow">
                <fieldset>
                    <h2  for="Change Password" style="text-align: center;font-weight: 900;text-transform: uppercase;"> Change Password</h2>
                    <form action="#" name="client_form" id="client_form" class="form_class" data-parsley-validate autocomplete="off"  data-parsley-trigger="keyup">
                    <div class="form-group">

                        <label class="col-md-12 control-label" for="passwordinput">Old Password</label>
                        <div class="col-md-12">
                            <input id="oldPassword" name="oldPassword" type="password" placeholder="" class="form-control input-md" data-parsley-trigger="blur" required="" data-parsley-required >
                        </div>
                         <span class="" id="validatemessage"></span>
                    </div>
                    <div class="form-group">

                        <label class="col-md-12 control-label" for="passwordinput">Password <span id="popover-password-top" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span></label>
                        <div class="col-md-12">
                            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true" data-parsley-trigger="blur" required="" data-parsley-required >
                            <div id="popover-password">
                                <p>Password Strength: <span id="result"> </span></p>
                                <div class="progress">
                                    <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
                                    <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
                                    <li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 Special Character (!@#$%^&*).</li>
                                    <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="passwordinput">Password Confirmation <span id="popover-cpassword" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Password don't match</span></label>
                        <div class="col-md-12">
                            <input id="pwd" name="pwd" type="password" placeholder="" class="form-control input-md" data-parsley-trigger="blur" required=""  data-parsley-equalto="#password" data-parsley-required >
                        </div>
                    </div>
                    </form>
                    <!-- Button -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="submit_id" name="submit_id" class="btn btn-primary btn-block">Update a Password </button>
                            <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">

                        </div>
                    </div>
                </fieldset>
            </section>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var Password = "<?php echo $Password;?>";
    $(document).ready(function() {
        $('#email').blur(function() {
            var email = $('#email').val();
            if (IsEmail(email) == false) {
                $('#sign-up').attr('disabled', true);
                $('#popover-email').removeClass('hide');
            } else {
                $('#popover-email').addClass('hide');
            }
        });
        $("#oldPassword").keyup(function(){
            // validatemessage
            if($(this).val() == Password) {
                console.log($(this).val());
                $("#validatemessage").text('');
                // $("#validatemessage").css("background-color", "red");
            } else {
              console.log($(this).val());
              $("#validatemessage").text('Old PassWord Does Not match');
            }
            });
        $('#password').keyup(function() {
            var password = $('#password').val();
            if (checkStrength(password) == false) {
                $('#sign-up').attr('disabled', true);
            }
        });
        $('#pwd').blur(function() {
            if ($('#password').val() !== $('#pwd').val()) {
                $('#popover-cpassword').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cpassword').addClass('hide');
            }
        });
        $('#contact-number').blur(function() {
            if ($('#contact-number').val().length != 10) {
                $('#popover-cnumber').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cnumber').addClass('hide');
                $('#sign-up').attr('disabled', false);
            }
        });
        $('#sign-up').hover(function() {
            if ($('#sign-up').prop('disabled')) {
                $('#sign-up').popover({
                    html: true,
                    trigger: 'hover',
                    placement: 'below',
                    offset: 20,
                    content: function() {
                        return $('#sign-up-popover').html();
                    }
                });
            }
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function checkStrength(password) {
            var strength = 0;


            //If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                $('.low-upper-case').addClass('text-success');
                $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');


            } else {
                $('.low-upper-case').removeClass('text-success');
                $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                strength += 1;
                $('.one-number').addClass('text-success');
                $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-number').removeClass('text-success');
                $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has one special character, increase strength value.
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                strength += 1;
                $('.one-special-char').addClass('text-success');
                $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-special-char').removeClass('text-success');
                $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.length > 7) {
                strength += 1;
                $('.eight-character').addClass('text-success');
                $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.eight-character').removeClass('text-success');
                $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }




            // If value is less than 2

            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('progress-bar-danger');

                $('#result').addClass('text-danger').text('Very Week');
                $('#password-strength').css('width', '10%');
            } else if (strength == 2) {
                $('#result').addClass('good');
                $('#password-strength').removeClass('progress-bar-danger');
                $('#password-strength').addClass('progress-bar-warning');
                $('#result').addClass('text-warning').text('Week')
                $('#password-strength').css('width', '60%');
                return 'Week'
            } else if (strength == 4) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('progress-bar-warning');
                $('#password-strength').addClass('progress-bar-success');
                $('#result').addClass('text-success').text('Strength');
                $('#password-strength').css('width', '100%');

                return 'Strong'
            }

        }

    });
    $('#submit_id').click(function(event) {
        event.preventDefault();
        // $('#loading-image').show();
        // Validate all input fields.
        var isValid = true;
        $('#client_form').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        if (isValid) {
            $('#loading-image').show();
            /* console.log('Old Passords' , $('#oldPassword').val());
            console.log('New Passords' , $('#password').val());
            console.log('Confirm Passords' , $('#pwd').val());
            return;*/
            if($('#oldPassword').val() != Password) {
                // console.log($(this).val());
              $("#validatemessage").text('Old PassWord Does Not match');
              alert('Old PassWord Does Not Match');
              $('#oldPassword').val('')
                // $("#validatemessage").css("background-color", "red");
            } else {
                // console.log($(this).val());
                $("#validatemessage").text('');
                var url = window.location.pathname;
                var id = url.substring(url.lastIndexOf('/') + 1);
               //console.log('Id' + window.location.href);
                // return;
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
               });
               $.ajax({
                   url : '/updatePassword/' + id,
                   type: 'POST',
                   data: {
                       newPassword: $('#password').val(),
                        oldPassword: $('#oldPassword').val(),
                   },
                   success: function(data) {
                       console.log('Data', data)
                       // return;
                       if(data == 'Not Match') {
                           alert('Old Password DoesNot Match');
                           $('#oldPassword').val('');
                       } else if(data == 'Done') {
                           alert('Password Updated succefuly');
                           var url = '{{ route("/login") }}';
                             window.location.href = url;
                       } else {
                           alert('Somthing Went Wrong')
                       }
                   },
                   complete: function() {
						$('#loading-image').hide();
					}
               });
            }
            return;
      }
    });
</script>
@endsection
