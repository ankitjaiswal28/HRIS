@extends('Layout.app')
@section('content')
<div class="main_card">
    <div style="padding:10px" class="neuphormic_shadow"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">All Employee</span><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="main_card">
    <div style="padding:10px" class="neuphormic_shadow">
        <div class="profile_div">
            <div class="row">
                <div class="col-md-2">
                    <div class="edit_hris_prfile" style=" text-align: center">
                        <img src="/asset/images/profile.png" style="position: relative;top: 6px;">
                    </div>
                </div>
                <div class="col-md-10">
                    <div style="float:right">
                        <a class="a_btn danger_btn" style="border: 0;margin-right: 10px;"><img
                                src="/asset/css/zondicons/zondicons/trash.svg" class="edit_icon"
                                style="-webkit-filter: invert(1);"> Delete</a>
                        <a href="/Superadmin/Add_Userr" class="btnn a_btn" style="border: 0;"><img
                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                style="-webkit-filter: invert(1);" alt=""> Edit Profile</a></div>
                    <h1><span style="font-weight:bolder">Abhishek</span> <span>Jaiswar</span></h1>
                    <div style="float:right">
                        <div id="social"><a class="facebookBtn smGlobalBtn" href="#"></a>
                            <a class="twitterBtn smGlobalBtn" href="#"></a>
                            <a class="googleplusBtn smGlobalBtn" href="#"></a>
                            <a class="linkedinBtn smGlobalBtn" href="#"></a>
                            <a class="pinterestBtn smGlobalBtn" href="#"></a>
                            <a class="tumblrBtn smGlobalBtn" href="#"></a>
                            <a class="rssBtn smGlobalBtn" href="#"></a>
                        </div>

                    </div>
                    <h5 class="grey">Web Designer</h5>
                    <h5 class="grey">Jaiswarabhishek2@gmail.com</h5>

                    <h5 class="grey">9778425239</h5>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row no_left_margin ">
        <div class="col-md-6 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3_title"><span class="bold_text abut_font">General Information</span></h3>
                        <hr class="border_red">
                        <div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 20px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">First Name</h6>
                            <h5 class="">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Last Name</h6>
                            <h5 class="">Jaiswar</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">EmployeeID</h6>
                            <h5 class="">1</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Gender</h6>
                            <h5 class="">Male</h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Nick Name</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">AGE</h6>
                            <h5 class="">22</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Profile</h6>
                            <h5 class="">Web Developer</h5>

                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Contact No</h6>
                            <h5 class="">9789493843</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Tel No</h6>
                            <h5 class="">9789493843</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Primary Email ID</h6>
                            <h5 class="">jaiswarabhishek2@gmail.com
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Birth Date</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Marital status</h6>
                            <h5 class="">Single</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Work Email ID</h6>
                            <h5 class="">abhishek.jaiswar@hridayamsoft.com
                            </h5>
                        </div>
                    </div>
                </div>
                <hr class="center_line">
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Added By</h6>
                            <h5 class="">Admin</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Added time</h6>
                            <h5 class="">20-Mar-2020 07:47 PM</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3_title"><span class="bold_text abut_font">Residence Information</span></h3>
                        <hr class="border_red">
                        <div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 20px 30px 0px;">
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Street</h6>
                            <h5 class="">902,Jai Hanuman Society,Tembi-Pada</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">City</h6>
                            <h5 class="">Mumbai</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">State</h6>
                            <h5 class="">Maharashtra</h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Zip-Code</h6>
                            <h5 class="">400078</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Country</h6>
                            <h5 class="">India</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h6 class="grey margin_bottm_0">Nationality</h6>
                            <h5 class="">Indian</h5>

                        </div>
                    </div>
                </div>

            </div>
            <div class="second_card neuphormic_shadow" style="margin-top: 15px;margin-bottom: 15px;">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3_title"><span class="bold_text abut_font">Work Information</span></h3>
                        <hr class="border_red">
                        <div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 20px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Department</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Experience</h6>
                            <h5 class="">1.5 Yrs</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Reporting To</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Source of hire</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px 0px;">
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Location</h6>
                            <h5 class="">Mumbai</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Title</h6>
                            <h5 class="">Web Developer</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Employee status</h6>
                            <h5 class="">Active</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h6 class="grey margin_bottm_0">Work phone</h6>
                            <h5 class="">-</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
