    @extends('Layout.app')
    @section('content')

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
                        <div class="form-group">

                            <label class="col-md-12 control-label" for="passwordinput">Old Password</label>
                            <div class="col-md-12">
                                <input id="old_password" name="old_password" type="password" placeholder="" class="form-control input-md" >
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-12 control-label" for="passwordinput">Password <span id="popover-password-top" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span></label>
                            <div class="col-md-12">
                                <input id="password" name="password" type="password" placeholder="" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
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
                                <input id="confirm-password" name="confirm-password" type="password" placeholder="" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <button id="sign-up" name="singlebutton" class="btn btn-primary btn-block">Create an Account</button>
                            </div>
                        </div>
                    </fieldset>
                </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
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
            $('#password').keyup(function() {
                var password = $('#password').val();
                if (checkStrength(password) == false) {
                    $('#sign-up').attr('disabled', true);
                }
            });
            $('#confirm-password').blur(function() {
                if ($('#password').val() !== $('#confirm-password').val()) {
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
    </script>
    @endsection
