@extends('Layout.app')
@section('content')

<style>
    /*font Variables*/
    /*Color Variables*/

    /* @import url("https://fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,700,900"); */
    .multi_step_form {
        /* background: #f6f9fb; */
        display: block;
        overflow: hidden;
    }

    .float_left {
        float: left;
        margin-left: 50px;
    }

    .float_right {
        float: right;
        margin-right: 50px;
    }

    .multi_step_form #msform {
        text-align: center;
        position: relative;
        padding-top: 10px;
        min-height: 625px;
        max-width: 90%;
        margin: 10px auto;
        background: #f8f9fd;
        z-index: 1;
        -webkit-box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.1), -5px -5px 10px #fff;
        -moz-box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.1), -5px -5px 10px #fff;
        box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.1), -5px -5px 10px #fff;
        border-radius: 10px;
    }

    .multi_step_form #msform .tittle {
        text-align: center;
        padding-bottom: 55px;
    }

    .multi_step_form #msform .tittle h2 {
        /* font: 500 24px/35px "Roboto", sans-serif; */
        color: #3f4553;
        padding-bottom: 5px;
    }

    .multi_step_form #msform .tittle p {
        /* font: 400 16px/28px "Roboto", sans-serif; */
        color: #5f6771;
    }

    .multi_step_form #msform fieldset {
        border: 0;
        padding: 0px 40px 0;
        position: relative;
        width: 100%;
        left: 0;
        right: 0;
    }

    .multi_step_form #msform fieldset:not(:first-of-type) {
        display: none;
    }

    .multi_step_form #msform fieldset h3 {
        /* font: 500 18px/35px "Roboto", sans-serif; */
        color: #3f4553;
    }

    .multi_step_form #msform fieldset h6 {
        /* font: 400 15px/28px "Roboto", sans-serif; */
        color: #5f6771;
        padding-bottom: 30px;
    }

    .multi_step_form #msform fieldset .intl-tel-input {
        display: block;
        background: transparent;
        border: 0;
        box-shadow: none;
        outline: none;
    }

    .multi_step_form #msform fieldset .intl-tel-input .flag-container .selected-flag {
        padding: 0 20px;
        background: transparent;
        border: 0;
        box-shadow: none;
        outline: none;
        width: 65px;
    }

    .multi_step_form #msform fieldset .intl-tel-input .flag-container .selected-flag .iti-arrow {
        border: 0;
    }

    .multi_step_form #msform fieldset .intl-tel-input .flag-container .selected-flag .iti-arrow:after {
        content: "\f000";
        position: absolute;
        top: 0;
        right: 0;
        font: normal normal normal 24px/7px FontAwesome;
        color: #5f6771;
    }

    .multi_step_form #msform fieldset #phone {
        padding-left: 80px;
    }

    .multi_step_form #msform fieldset .form-group {
        padding: 0 10px;
    }

    .multi_step_form #msform fieldset .fg_2,
    .multi_step_form #msform fieldset .fg_3 {
        padding-top: 10px;
        display: block;
        overflow: hidden;
    }

    .multi_step_form #msform fieldset .fg_3 {
        padding-bottom: 70px;
    }

    .multi_step_form #msform fieldset .form-control,
    .multi_step_form #msform fieldset .product_select {
        border-radius: 3px;
        border: 1px solid #d8e1e7;
        padding: 0 20px;
        height: auto;
        /* font: 400 15px/48px "Roboto", sans-serif; */
        color: #5f6771;
        box-shadow: none;
        outline: none;
        width: 100%;
    }

    .multi_step_form #msform fieldset .form-control.placeholder,
    .multi_step_form #msform fieldset .product_select.placeholder {
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .form-control:-moz-placeholder,
    .multi_step_form #msform fieldset .product_select:-moz-placeholder {
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .form-control::-moz-placeholder,
    .multi_step_form #msform fieldset .product_select::-moz-placeholder {
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .form-control::-webkit-input-placeholder,
    .multi_step_form #msform fieldset .product_select::-webkit-input-placeholder {
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .form-control:hover,
    .multi_step_form #msform fieldset .form-control:focus,
    .multi_step_form #msform fieldset .product_select:hover,
    .multi_step_form #msform fieldset .product_select:focus {
        border-color: #142850;
    }

    .multi_step_form #msform fieldset .form-control:focus.placeholder,
    .multi_step_form #msform fieldset .product_select:focus.placeholder {
        color: transparent;
    }

    .multi_step_form #msform fieldset .form-control:focus:-moz-placeholder,
    .multi_step_form #msform fieldset .product_select:focus:-moz-placeholder {
        color: transparent;
    }

    .multi_step_form #msform fieldset .form-control:focus::-moz-placeholder,
    .multi_step_form #msform fieldset .product_select:focus::-moz-placeholder {
        color: transparent;
    }

    .multi_step_form #msform fieldset .form-control:focus::-webkit-input-placeholder,
    .multi_step_form #msform fieldset .product_select:focus::-webkit-input-placeholder {
        color: transparent;
    }

    .multi_step_form #msform fieldset .product_select:after {
        display: none;
    }

    .multi_step_form #msform fieldset .product_select:before {
        content: "\f35f";
        position: absolute;
        top: 0;
        right: 20px;
        font: normal normal normal 24px/48px Ionicons;
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .product_select .list {
        width: 100%;
    }

    .multi_step_form #msform fieldset .done_text {
        padding-top: 40px;
    }

    .multi_step_form #msform fieldset .done_text .don_icon {
        height: 36px;
        width: 36px;
        line-height: 36px;
        font-size: 22px;
        margin-bottom: 10px;
        background: #142850;
        display: inline-block;
        border-radius: 50%;
        color: #ffffff;
        text-align: center;
    }

    .multi_step_form #msform fieldset .done_text h6 {
        line-height: 23px;
    }

    .multi_step_form #msform fieldset .code_group {
        margin-bottom: 60px;
    }

    .multi_step_form #msform fieldset .code_group .form-control {
        border: 0;
        border-bottom: 1px solid #a1a7ac;
        border-radius: 0;
        display: inline-block;
        width: 30px;
        font-size: 30px;
        color: #5f6771;
        padding: 0;
        margin-right: 7px;
        text-align: center;
        line-height: 1;
    }

    .multi_step_form #msform fieldset .passport {
        margin-top: -10px;
        padding-bottom: 30px;
        position: relative;
    }

    .multi_step_form #msform fieldset .passport .don_icon {
        height: 36px;
        width: 36px;
        line-height: 36px;
        font-size: 22px;
        position: absolute;
        top: 4px;
        right: 0;
        background: #142850;
        display: inline-block;
        border-radius: 50%;
        color: #ffffff;
        text-align: center;
    }

    .multi_step_form #msform fieldset .passport h4 {
        /* font: 500 15px/23px "Roboto", sans-serif; */
        color: #5f6771;
        padding: 0;
    }

    .multi_step_form #msform fieldset .input-group {
        padding-bottom: 40px;
    }

    .multi_step_form #msform fieldset .input-group .custom-file {
        width: 100%;
        height: auto;
    }

    .multi_step_form #msform fieldset .input-group .custom-file .custom-file-label {
        width: 168px;
        border-radius: 5px;
        cursor: pointer;
        /* font: 700 14px/40px "Roboto", sans-serif; */
        border: 1px solid #99a2a8;
        text-align: center;
        transition: all 300ms linear 0s;
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .input-group .custom-file .custom-file-label i {
        font-size: 20px;
        padding-right: 10px;
    }

    .multi_step_form #msform fieldset .input-group .custom-file .custom-file-label:hover,
    .multi_step_form #msform fieldset .input-group .custom-file .custom-file-label:focus {
        background: #142850;
        border-color: #142850;
        color: #fff;
    }

    .multi_step_form #msform fieldset .input-group .custom-file input {
        display: none;
    }

    .multi_step_form #msform fieldset .file_added {
        text-align: left;
        padding-left: 190px;
        padding-bottom: 60px;
    }

    .multi_step_form #msform fieldset .file_added li {
        /* font: 400 15px/28px "Roboto", sans-serif; */
        color: #5f6771;
    }

    .multi_step_form #msform fieldset .file_added li a {
        color: #142850;
        font-weight: 500;
        display: inline-block;
        position: relative;
        padding-left: 15px;
    }

    .multi_step_form #msform fieldset .file_added li a i {
        font-size: 22px;
        padding-right: 8px;
        position: absolute;
        left: 0;
        transform: rotate(20deg);
    }

    .multi_step_form #msform #progressbar {
        /* margin-bottom: 30px; */
        overflow: hidden;
    }

    .multi_step_form #msform #progressbar li {
        list-style-type: none;
        color: #99a2a8;
        font-size: 15px;
        width: calc(100%/4);
        float: left;
        position: relative;
        /* font: 500 13px/1 "Roboto", sans-serif; */
    }

    .multi_step_form #msform #progressbar li:nth-child(2):before {
        content: "\f000";
    }

    .multi_step_form #msform #progressbar li:nth-child(3):before {
        content: "\f000";
    }
    .multi_step_form #msform #progressbar li:nth-child(4):before {
        content: "\f000";
    }

    .multi_step_form #msform #progressbar li:before {
        content: "\f000";
        font: normal normal normal 30px/50px FontAwesome;
        width: 50px;
        height: 50px;
        line-height: 50px;
        display: block;
        background: #eaf0f4;
        border-radius: 50%;
        margin: 0 auto 10px auto;
    }

    .multi_step_form #msform #progressbar li:after {
        content: '';
        width: 100%;
        height: 10px;
        background: #eaf0f4;
        position: absolute;
        left: -50%;
        top: 21px;
        z-index: -1;
    }

    .multi_step_form #msform #progressbar li:last-child:after {
        /* width: 150%; */
    }

    .multi_step_form #msform #progressbar li.active {
        color: #142850;
    }

    .multi_step_form #msform #progressbar li.active:before {
        background: #142850;
        color: white;
    }
    .multi_step_form #msform #progressbar li:nth-child(1).active:after {
        background: #f8f9fd;
    }

    .multi_step_form #msform #progressbar li.active:after {
        background: #142850;
        color: white;
    }

    .multi_step_form #msform .action-button {
        padding-top: 5px !important;
    padding-bottom: 5px !important;
        background: #142850;
        color: white;
        border: 0 none;
        border-radius: 5px;
        cursor: pointer;
        min-width: 130px;
        /* font: 700 14px/40px "Roboto", sans-serif; */
        border: 1px solid #142850;
        margin: 0 5px;
        text-transform: uppercase;
        display: inline-block;
    }

    .multi_step_form #msform .action-button:hover,
    .multi_step_form #msform .action-button:focus {
        background: #405867;
        border-color: #405867;
    }

    .multi_step_form #msform .previous_button {
        background: transparent;
        color: #99a2a8;
        border-color: #99a2a8;
    }

    .multi_step_form #msform .previous_button:hover,
    .multi_step_form #msform .previous_button:focus {
        background: #405867;
        border-color: #405867;
        color: #fff;
    }

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
    .custom-file-label {
    text-align: left !important;
    }
    .lebel_left_grey {
        color: grey;
    float: left;
    }
</style>
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="font-size: 18px;">All Employee</span></a><i class="fa fa-close"
            aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<section class="multi_step_form ">
    <form id="msform">
        <ul id="progressbar" style="padding-left: 0px;margin-bottom: 0px;">
            <li class="active">Personal Details</li>
            <li>Academic & Experience Details</li>
            <li>Dependant Details</li>
            <li>Documents</li>
        </ul>
        <fieldset>
            <div class="row">
                <div class="col-sm-6 col-xs-12 col-md-4">
                    <div class="container">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(/asset/images/Avatar/user.png);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="avatars">
                        {{-- <form> --}}
                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user.png" alt="" />
                        </label>

                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-1.png" alt="" />
                        </label>

                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-2.png" alt="" />
                        </label>

                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-3.png" alt="" />
                        </label>

                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-4.png" alt="" />
                        </label>

                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-5.png" alt="" />
                        </label>
                        <label class="avatars">
                            <input type="radio" name="avatar" />
                            <img src="/asset/images/Avatar/user-6.png" alt="" />
                        </label>
                        {{-- </form> --}}
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
                            <div id="avatars">
                                <label style="padding-right: 25px;margin-top: 20px;">Gender</label>
                                <label class="avatars">
                                    <input type="radio" name="avatar" />
                                    <img src="/asset/images/Avatar/user-30.png" alt="" />
                                </label>

                                <label class="avatars">
                                    <input type="radio" name="avatar" />
                                    <img src="/asset/images/Avatar/user-29.png" alt="" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="first_name" placeholder="" style="clear:both">
                                <label>First Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="lastname" placeholder="" style="clear:both">
                                <label>Last Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="primary_emailid" placeholder=""
                                    style="clear:both">
                                <label>Email id</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control dropdoen_height" id="sel1" style="margin-top: 20px;">
                                        <option>Marital Status</option>
                                        <option>Marital Status</option>
                                        <option>Marital Status</option>
                                        <option>Marital Status</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="colll-3 input-effect">
                                        <input class="effect-16" type="text" id="lastname" placeholder=""
                                            style="clear:both">
                                        <label>Blood Group</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="contact_no" placeholder="" style="clear:both">
                                <label>Contact No</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="tel_no" placeholder="" style="clear:both">
                                <label>Tel No</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="contact_no" placeholder="" style="clear:both">
                                <label>Emergency Contact Person Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="tel_no" placeholder="" style="clear:both">
                                <label>Emergency Contact Person Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <h4 class="h4_middle_line" style="margin-bottom: 0px;"><span>RESIDENCE INFORMATION</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="street" placeholder="" style="clear:both">
                                <label>Street</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="city" placeholder="" style="clear:both">
                                <label>City</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="state" placeholder="" style="clear:both">
                                <label>State</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="zip_code" placeholder="" style="clear:both">
                                <label>Zip-Code</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="country" placeholder="" style="clear:both">
                                <label>Country</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Nationality</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="next action-button float_right">Continue</button>
        </fieldset>
        <fieldset>
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <h4 class="h4_middle_line" style="margin-bottom: 0px;"><span>Academic & Experience Details</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <select class="form-control dropdoen_height" id="sel1" style="margin-top: 20px;">
                                <option value="" selected="selected" disabled="disabled">-- Select Education Qualification --</option>
                                <option value="No formal education">No formal education</option>
                                <option value="Primary education">Primary education</option>
                                <option value="Secondary education">Secondary education or high school</option>
                                <option value="GED">GED</option>
                                <option value="Vocational qualification">Vocational qualification</option>
                                <option value="Bachelor's degree">Bachelor's degree</option>
                                <option value="Master's degree">Master's degree</option>
                                <option value="Doctorate or higher">Doctorate or higher</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Total Experience in Years</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Last Position Held</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Previous Employer Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Last Position Experience in years</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Last Increment Received Date</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Skills</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <h4 class="h4_middle_line" style="margin-bottom: 0px;"><span>DOCUMENTS INFORMATION</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Pan Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Aadhar Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Passport Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>UAN Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>EPF Number</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="action-button previous previous_button float_left">Back</button>
            <button type="button" class="next action-button float_right">Continue</button>
        </fieldset>
        <fieldset>
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <h4 class="h4_middle_line" style="margin-bottom: 0px;"><span>Dependant Details</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Mother's Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Mother's DOB</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Father's Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Father's DOB</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Spouse's Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Spouse's DOB</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Child's Name</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-4">
                            <div class="colll-3 input-effect">
                                <input class="effect-16" type="text" id="nationality" placeholder="" style="clear:both">
                                <label>Child's DOB</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="action-button previous previous_button float_left">Back</button>
            <button type="button" class="next action-button float_right">Continue</button>
        </fieldset>
        <fieldset>
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <h4 class="h4_middle_line" style="margin-bottom: 0px;"><span>upload documents</span></h4>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 20px;">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                           <label for="" class="lebel_left_grey">Choose PAN</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Aadhar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Address Proof if permanent and present address are different</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Passport</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Education Certificates</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Relieving Letters</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose Resume</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4">
                        <div class="colll-3 input-effect">
                            <label for="" class="lebel_left_grey">Choose PF Form</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="action-button previous previous_button float_left">Back</button>
            <a href="#" class="action-button float_right">Finish</a>
        </fieldset>
    </form>
</section>

<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/jquery_213.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script>
    ///   for upload file
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
    (function($) {
        "use strict";
        //* Form js
        function verificationForm() {
            //jQuery time
            var current_fs, next_fs, previous_fs; //fieldsets
            var left, opacity, scale; //fieldset properties which we will animate
            var animating; //flag to prevent quick multi-click glitches

            $(".next").click(function() {
                if (animating) return false;
                animating = true;

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50) + "%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'transform': 'scale(' + scale + ')',
                            'position': 'absolute'
                        });
                        next_fs.css({
                            'left': left,
                            'opacity': opacity
                        });
                    },
                    duration: 800,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            });

            $(".previous").click(function() {
                if (animating) return false;
                animating = true;

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //de-activate current step on progressbar
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale previous_fs from 80% to 100%
                        scale = 0.8 + (1 - now) * 0.2;
                        //2. take current_fs to the right(50%) - from 0%
                        left = ((1 - now) * 50) + "%";
                        //3. increase opacity of previous_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'left': left
                        });
                        previous_fs.css({
                            'transform': 'scale(' + scale + ')',
                            'opacity': opacity
                        });
                    },
                    duration: 800,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            });

            $(".submit").click(function() {
                return false;
            })
        };
        /*Function Calls*/
        verificationForm();
    })(jQuery);
</script>
@endsection
