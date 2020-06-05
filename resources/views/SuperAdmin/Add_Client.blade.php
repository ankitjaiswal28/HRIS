@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow" style="padding:10px"><i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">All Employee</span><i class="fa fa-close" aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
        </div>
        <div class="flip-card-3D-wrapper" style="width: 35% !important;">
            <div class="columns">
                <div class="inner-column" id="flip-card">
                    <div class="flip-card-front" style="padding-top: 10px;">
                        <div class="">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="left_border font_grey" style="float: left;">Add Client</h1>
                                </div>
                                <div class="col-md-2">
                                    <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import" style="width: 20px;margin-right: 0px;"></button>
                                </div>
                            </div>
                            <div class="padding_20" style="padding: 0px 35px;">
                                <form action="#" name="client_form" id="client_form" class="form_class" data-parsley-validate autocomplete="off">
                                    <div class="row">
                                        <div class=" col-sm-12 col-xs-12 col-md-12">
                                            <div class="colll-3 input-effect">
                                                <input type="text" class="effect-16" id="companyname" name="companyname" autocomplete="off" placeholder="" style="clear:both" data-parsley-trigger="blur" required="" data-parsley-errors-container=".erroscompanyname">
                                                <label>Company Name</label>
                                                <span class="erroscompanyname"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input class="effect-16" type="text" placeholder="" style="clear:both" id="adminname" name="adminname" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorsadminname">
                                                <label>Admin Name</label>
                                                <span class="errorsadminname"></span>

                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="text" class="effect-16" id="mobileno" name="mobileno" autocomplete="off" placeholder="" style="clear:both" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorsmobileno">
                                                <label>Admin Contact No</label>
                                                <span class="errorsmobileno"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="email" class="effect-16" id="email" placeholder="" style="clear:both" name="email" autocomplete="off" data-parsley-type="email" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorsemail">
                                                <label>Admin Email</label>
                                                <span class="errorsemail"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="text" class="effect-16" id="prefix" placeholder="" style="clear:both" name="prefix" autocomplete="off" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorsprefix">
                                                <label>Client Prefix</label>
                                                <span class="errorsprefix"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="password" class="effect-16" id="pwd" placeholder="" style="clear:both" name="pwd" autocomplete="new-password" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorspassword">
                                                <label>Password</label>
                                                <span class="errorspassword"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="text" class="effect-16" id="empcode" placeholder="" style="clear:both" name="empcode" data-parsley-trigger="blur" required="" data-parsley-errors-container=".errorscode">
                                                <label>Employe Code Format</label>
                                                <span class="errorscode"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 15px 0px;">
                                        <button type="button" name="submit_id" id="btn_id" class="btnn" style="border: none;">Submit</button>
                                        <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
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
                                    <button id="flip-card-btn-turn-to-front" data-tooltip="Entry Form" class="box circle"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg" alt="Import" style="width: 20px;margin-right: 0px;"></button>
                                </div>
                            </div>
                            <br>
                            <div style="text-align: -webkit-center;">
                                <form action="#">
                                    <h4>Choose Csv file</h4>
                                    <div class="input-file-container">
                                        <input class="input-file" id="my-file" type="file">
                                        <label tabindex="0" for="my-file" class="input-file-trigger">Select a
                                            file...</label>
                                    </div>
                                    <p class="file-return"></p>
                                    <br>
                                    <div style="margin: 15px 0px;">
                                        <button type="submit" class="btnn" style="border: none;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
<script>
    $(document).ready(function() {
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
            $('input').each(function() {
                if ($(this).parsley().validate() !== true) isValid = false;
            });
            if (isValid) {
                $('#loading-image').show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/createclient',
                    type: 'POST',
                    data: {
                        companyname: $('#companyname').val(),
                        adminname: $('#adminname').val(),
                        mobileno: $('#mobileno').val(),
                        email: $('#email').val(),
                        prefix: $('#prefix').val(),
                        pwd: $('#pwd').val(),
                        empcode: $('#empcode').val(),
                    },
                    success: function(data) {
                        console.log('Data', data);
                        // return;
                        var response = data.trim();
                        if (response == 'Error') {
                            alert('Something Went Wrong')
                        } else if (response == 'Email ID Already Exits') {
                            alert('Email ID Already Exits');
                            $('#email').val('');
                        } else if (response == 'PreFix Already Exits') {
                            alert('PreFix Already Exits');
                            $('#prefix').val('');
                        } else if (response == 'Database Already Exits') {
                            alert('Database Already Exits');
                            $('#prefix').val('');
                        } else {
                            alert('Admin Craeted Sucessfuly');
                            // window.location.href = 'SuperAdmin/superadmindahboard';
                            var url = '{{ route("SuperAdmin/Show_client") }}';
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
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
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

    var fileInput = document.querySelector(".input-file"),
        button = document.querySelector(".input-file-trigger"),
        the_return = document.querySelector(".file-return");

    button.addEventListener("keydown", function(event) {
        if (event.keyCode == 13 || event.keyCode == 32) {
            fileInput.focus();
        }
    });
    button.addEventListener("click", function(event) {
        fileInput.focus();
        return false;
    });
    fileInput.addEventListener("change", function(event) {
        the_return.innerHTML = this.value;
    });
</script>
<script>
    $(window).load(function() {
        $(".colll-3 input").val("");

        $(".input-effect input").focusout(function() {
            if ($(this).val() != "") {
                $(this).addClass("has-content");
            } else {
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
