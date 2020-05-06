@extends('Layout.app')
@section('content')
<style>
    @import "https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,400";


    body {
        background: #efefef;
        color: #333;
        font-family: "Raleway";
        height: 100%;
    }

    body h1 {
        text-align: center;
        color: #142850;
        font-weight: 300;
        padding: 40px 0 20px 0;
        margin: 0;
    }

    .tabs {
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
        position: relative;
        /* background: white; */
        padding: 25px;
        width: 90%;
        border-radius: 10px;
        min-width: 240px;
    }

    .tabs input[name="tab-control"] {
        display: none;
    }

    .tabs .content section h2,
    .tabs .ull .lii label {
        font-family: "Montserrat";
        font-weight: bold;
        font-size: 18px;
        color: #142850;
    }

    .tabs .ull {
        list-style-type: none;
        padding-left: 0;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
        margin-bottom: 10px;
        -webkit-box-pack: justify;
        justify-content: space-between;
        -webkit-box-align: end;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .tabs .ull .lii {
        box-sizing: border-box;
        -webkit-box-flex: 1;
        flex: 1;
        width: 25%;
        padding: 0 10px;
        text-align: center;
    }

    .tabs .ull .lii label {
        padding: 10px;
        border-radius: 25px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        color: #929daf;
        padding: 5px auto;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        cursor: pointer;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .tabs .ull .lii label br {
        display: none;
    }

    .tabs .ull .lii label svg {
        position: relative;
        fill: #929daf;
        height: 1.2em;
        vertical-align: bottom;
        margin-right: 0.2em;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        top: -3px;
    }

    .tabs .ull .lii label:hover,
    .tabs .ull .lii label:focus,
    .tabs .ull .lii label:active {
        outline: 0;
        color: #bec5cf;
    }

    .tabs .ull .lii label:hover svg,
    .tabs .ull .lii label:focus svg,
    .tabs .ull .lii label:active svg {
        fill: #bec5cf;
    }

    .tabs .slider {
        position: relative;
        width: 25%;
        -webkit-transition: all 0.33s cubic-bezier(0.38, 0.8, 0.32, 1.07);
        transition: all 0.33s cubic-bezier(0.38, 0.8, 0.32, 1.07);
    }

    .tabs .slider .indicator {
        position: relative;
        width: 50px;
        max-width: 100%;
        margin: 0 auto;
        height: 4px;
        background: #142850;
        border-radius: 1px;
    }

    .tabs .content {
        margin-top: 5px;
    }

    .tabs .content section {
        display: none;
        -webkit-animation-name: content;
        animation-name: content;
        -webkit-animation-direction: normal;
        animation-direction: normal;
        -webkit-animation-duration: 0.3s;
        animation-duration: 0.3s;
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
        -webkit-animation-iteration-count: 1;
        animation-iteration-count: 1;
        line-height: 1.4;
    }

    .tabs .content section h2 {
        color: #142850;
        display: none;
    }

    .tabs .content section h2::after {
        content: "";
        position: relative;
        display: block;
        width: 30px;
        height: 3px;
        background: #142850;
        margin-top: 5px;
        left: 1px;
    }

    .tabs input[name="tab-control"]:nth-of-type(1):checked~.ull>.lii:nth-child(1)>label {
        background: #142850;
        cursor: default;
        color: white;
        padding: 10px;
        border-radius: 25px;
    }

    .tabs input[name="tab-control"]:nth-of-type(1):checked~.ull>.lii:nth-child(1)>label svg {
        fill: white;
    }

    .tabs input[name="tab-control"]:nth-of-type(1):checked~.ull>.lii:nth-child(1)>label .counts {
        float: right;
        background: #f8f9fd;
        padding: 1px 10px;
        color: #142850;
        border-radius: 25px;
    }



    @media (max-width: 600px) {
        .tabs input[name="tab-control"]:nth-of-type(1):checked~.ull>.lii:nth-child(1)>label {
            background: rgba(0, 0, 0, 0.08);
        }
    }

    .tabs input[name="tab-control"]:nth-of-type(1):checked~.slider {
        -webkit-transform: translateX(0%);
        transform: translateX(0%);
    }

    .tabs input[name="tab-control"]:nth-of-type(1):checked~.content>section:nth-child(1) {
        display: block;
    }

    .tabs input[name="tab-control"]:nth-of-type(2):checked~.ull>.lii:nth-child(2)>label {
        background: #142850;
        cursor: default;
        color: white;
        padding: 10px;
        border-radius: 25px;
    }

    .tabs input[name="tab-control"]:nth-of-type(2):checked~.ull>.lii:nth-child(2)>label svg {
        fill: white;
    }

    .tabs input[name="tab-control"]:nth-of-type(2):checked~.ull>.lii:nth-child(2)>label .counts {
        float: right;
        background: #f8f9fd;
        padding: 1px 10px;
        color: #142850;
        border-radius: 25px;
    }

    @media (max-width: 600px) {
        .tabs input[name="tab-control"]:nth-of-type(2):checked~.ull>.lii:nth-child(2)>label {
            background: rgba(0, 0, 0, 0.08);
        }
    }

    .tabs input[name="tab-control"]:nth-of-type(2):checked~.slider {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
    }

    .tabs input[name="tab-control"]:nth-of-type(2):checked~.content>section:nth-child(2) {
        display: block;
    }

    @-webkit-keyframes content {
        from {
            opacity: 0;
            -webkit-transform: translateY(5%);
            transform: translateY(5%);
        }

        to {
            opacity: 1;
            -webkit-transform: translateY(0%);
            transform: translateY(0%);
        }
    }

    @keyframes content {
        from {
            opacity: 0;
            -webkit-transform: translateY(5%);
            transform: translateY(5%);
        }

        to {
            opacity: 1;
            -webkit-transform: translateY(0%);
            transform: translateY(0%);
        }
    }

    @media (max-width: 1000px) {
        .tabs .ull .lii label {
            white-space: initial;
        }

        .tabs .ull .lii label br {
            display: initial;
        }

        .tabs .ull .lii label svg {
            height: 1.5em;
        }
    }

    @media (max-width: 600px) {
        .tabs .ull .lii label {
            padding: 5px;
            border-radius: 5px;
        }

        .tabs .ull .lii label span {
            display: none;
        }

        .tabs .slider {
            display: none;
        }

        .tabs .content {
            margin-top: 20px;
        }

        .tabs .content section h2 {
            display: block;
        }
    }

    .counts {
        float: right;
        background: #929daf;
        padding: 1px 10px;
        color: #f8f9fd;
        border-radius: 25px;
    }
</style>
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="font-size: 18px;">All Employee</span></a><i class="fa fa-close"
            aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>

<div class="tabs neuphormic_shadow">

    <input type="radio" id="tab1" name="tab-control" checked>
    <input type="radio" id="tab2" name="tab-control">
    <ul style="width: 50%;" class="ull">
        <li title="Leave Requests" class="lii"><label for="tab1" role="button"><svg viewBox="0 0 24 24">
                    <path
                        d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z" />
                </svg><span>Leave Requests</span>
                <?php

                if ($request_count != '0') {
                    ?><span class="counts"><?php echo $request_count?></span><?php
                }else{
                    ?>
                <span></span><?php
                }?></label></li>
        <li title="Leave Types" class="lii"><label for="tab2" role="button"><svg viewBox="0 0 24 24">
                    <path
                        d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                </svg><span>Leave Types</span></label></li>
    </ul>
    <div class="slider">
        <div class="indicator"></div>
    </div>
    <div class="content">
        <section>

            <table id="pending_request" class="table table-hover table_scroll" style="width:100%">
                <h2>Leave Requests</h2>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th>Employee Name</th>
                        <th>On Date</th>
                        <th>Leave Type</th>
                        <th>Starting Date</th>
                        <th>Total Day</th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
            </table>
        </section>
        <section>
            <a id="apply_leave_type" class="btnn a_btn"
                style="top: 30px;border: 0;position: absolute;right: 30px;border-radius: 25px;"><img
                    src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                    style="-webkit-filter: invert(1);" alt="">Add Leave Type</a>
            <h2>Leave Requests</h2>
            <table id="leave_type" class="table table-hover table_scroll" style="width:100%">
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th>Leave Type</th>
                        <th>Day's Alloted</th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
            </table>
        </section>
    </div>
</div>

{{-- ///////////////////////////////     ADD LEAVE TYPE     ///////////////////////////////////// --}}
<div id="popup-wrapper" class="popup-container">
    <div class="popup-content" style="width: 30%;">
        <div class="flip-card-3D-wrapper" style="width: 100% !important;left: 0px;">
            <div class="">
                <span id="close">&times;</span>
                <h2>Add Leave Type</h2>
                {{-- <form action="/Superadmin/Show_client"> --}}
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 col-md-12">
                        <div class="colll-3 input-effect">
                            <input class="effect-16" type="text" placeholder="" style="clear:both" id="leave_type_name">
                            <label>Leave Type Name</label>
                            <span class="focus-border" style="top: 37px !important;"></span>
                        </div>
                        <div class="colll-3 input-effect">
                            <input class="effect-16" type="text" placeholder="" style="clear:both" id="allote_day"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <label>Allote Day</label>
                            <span class="focus-border" style="top: 37px !important;"></span>
                        </div>
                    </div>
                    <button type="submit" class="btnn" id="submit_form" style="border: none;float:right">Submit</button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
{{-- ////////////////////////////////          EDIT POPUP          ////////////////////////////// --}}
<div id="edit_popup-wrapper" class="popup-container">
    <div class="popup-content" style="width: 30%;">
        <div class="flip-card-3D-wrapper" style="width: 100% !important;left: 0px;">
            <div class="">
                <span id="edit_close">&times;</span>
                <h2>Add Leave Type</h2>
                {{-- <form action="/Superadmin/Show_client"> --}}
                {{-- @if(!empty($data)) --}}
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 col-md-12">
                        <div class="colll-3 input-effect">
                            <input type="hidden" name="" id="leave_type_id">
                            <input class="effect-16" type="text" placeholder="" style="clear:both"
                                id="edit_leave_type_name">
                            <label>Leave Type Name</label>
                            <span class="focus-border" style="top: 37px !important;"></span>
                        </div>
                        <div class="colll-3 input-effect">
                            <input class="effect-16" type="text" placeholder="" style="clear:both" id="edit_allote_day"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <label>Allote Day</label>
                            <span class="focus-border" style="top: 37px !important;"></span>
                        </div>
                    </div>
                    <button type="submit" class="btnn" id="edit_submit_form"
                        style="border: none;float:right">Submit</button>
                </div>
                {{-- @endif --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>

{{-- ///////////////////////          Approve request POPUP          /////////////////////// --}}
<div id="approve_popup-wrapper" class="popup-container">
    <div class="popup-content" style="width: 40%;">
        <div class="flip-card-3D-wrapper" style="width: 100% !important;left: 0px;">
            <div class="">
                <span id="approve_close" style="right: -8px !important;top: -19px !important;">&times;</span>
                <h2>Leave Request</h2>
                <br>
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> Type</h6>
                            <label style="font-size: 25px;" id="leave_type_approve"></label>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> On Date</h6>
                            <label style="font-size: 25px;" id="on_date_approve"></label>
                            {{-- <h6 style="float: right;" id="on_date_approve">2020-04-29</h6> --}}
                        </div>
                        <br><br><br>
                        <div class="col-md-12 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> Employee
                                Name</h6>
                            <label style="font-size: 25px;" id="user_name_approve"></label>
                        </div>
                        <br><br><br>
                        <div class="col-md-6 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> Start leave
                                date</h6>
                            <label style="font-size: 25px;" id="start_leave_date_approve"></label>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> end leave date
                            </h6>
                            <label style="font-size: 25px;" id="end_leave_date_approve">Planned Leave</label>
                        </div>
                        <br><br><br>
                        <div class="col-md-12 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font"
                                style="font-size: 13px;background: #1eff5859;padding: 0px 10px;border-radius: 10px;margin-bottom: 0px;">
                                Number of working days selected : <label style="font-size: 20px;margin-left: 5px;"
                                    id="count_of_day"></label>
                            </h6>
                        </div>
                        <br><br><br>
                        <div class="col-md-12 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <h6 class="uppercase ralway_font margin_bottom_0 grey" style="font-size: 13px;"><i
                                    class="fa fa-circle" style="font-size: 10px;" aria-hidden="true"></i> Reason</h6>
                            <label style="word-break: break-all;font-size: 17px;" id="reason_for_leave"></label>
                        </div>
                        <br><br>
                        <div class="col-md-12 col-sm-12 col-xs-12 padding_left_0 padding_right_0">
                            <input type="hidden" name="" id="user_id_approve">
                            <button type="submit" class="btnn" id="aprove_submit_form"
                                style="border: none;float:right">Confirm Leave</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ////////////////////////////////////////// ///////////////////////////////////////////////// --}}
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/jquery_213.min.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#submit_form").click(function(){
          var leave_type_name = $('#leave_type_name').val();
          var allote_day = $('#allote_day').val();
          var dataString = 'leave_type_name='+ leave_type_name + '&allote_day='+ allote_day;
          console.log("dataString :",dataString);
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/insert_leave_manage',
                type: 'POST',
                data: dataString,
                    success: function(data) {
                        console.log('Data', data)
                         var response = data.trim();
                         if(response == 'Already'){
                             alert('Existing Data')
                         } else {
                            popup.classList.remove('show');
                            $(".colll-3 input").val("");
                            //  alert('Added');
                            //  var url = '{{ route("/Leave_manage") }}';
                            //  window.location.href = url;
                         }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
        });


        $("#edit_submit_form").click(function(){
          var edit_leave_type_name = $('#edit_leave_type_name').val();
          var edit_allote_day = $('#edit_allote_day').val();
          var leave_type_id =  $('#leave_type_id').val();
          var dataString = 'edit_leave_type_name='+ edit_leave_type_name + '&edit_allote_day='+ edit_allote_day + '&leave_type_id='+ leave_type_id;
        //   console.log("dataString :",dataString);
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/update_leave_manage_code',
                type: 'POST',
                data: dataString,
                    success: function(result) {
                        console.log('Data', result)
                        //  var response = result.trim();
                        var url = '{{ route("/Leave_manage") }}';
                             window.location.href = url;
                    }
            })
        });



        $("#aprove_submit_form").click(function(){
          var user_id_approve = $('#user_id_approve').val();
          var leave_status = "Approved"
          var dataString = 'user_id_approve='+ user_id_approve + '&leave_status='+ leave_status;
        //   console.log("dataString :",dataString);
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/approve_leave_with_user_id',
                type: 'POST',
                data: dataString,
                    success: function(result) {
                        console.log('Data', result)
                        //  var response = result.trim();
                        var url = '{{ route("/Leave_manage") }}';
                             window.location.href = url;
                    }
            })
        });

    });
</script>
<script>
    $(window).load(function(){
		// $(".colll-3 input").val("");
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
    //////////////////////////          edit leave type popup      / ////////////////////////
var popup = document.getElementById('popup-wrapper');
var btn = document.getElementById("apply_leave_type");
var span = document.getElementById("close");
btn.onclick = function() {
    popup.classList.add('show');
}
span.onclick = function() {
    popup.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == popup) {
        popup.classList.remove('show');
    }
}

////////////////////////////       Approve leave request popup       ///////////////////////

var approve_popup = document.getElementById('approve_popup-wrapper');
var approve_btn = document.getElementById("approve_leave_request");
var approve_span = document.getElementById("approve_close");
approve_btn.onclick = function() {
    approve_popup.classList.add('show');
}
approve_span.onclick = function() {
    approve_popup.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == approve_popup) {
        approve_popup.classList.remove('show');
    }
}

//////////////////////////////        Edit Popup          //////////////////////////////////
var edit_popup = document.getElementById('edit_popup-wrapper');
var edit_btn = document.getElementById("editapplyleavetype");
var edit_span = document.getElementById("edit_close");
edit_btn.onclick = function() {
    edit_popup.classList.add('show');
}
edit_span.onclick = function() {
    edit_popup.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == edit_popup) {
        edit_popup.classList.remove('show');
    }
}
</script>
<script>
    function editapplyleavetype(id) {
        let autoid = id;
        var edit_popup = document.getElementById('edit_popup-wrapper');
var edit_btn = document.getElementById("editapplyleavetype");
var edit_span = document.getElementById("edit_close");
        edit_span.onclick = function() {
        edit_popup.classList.remove('show');}
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                url: '/update_leave_manage_data',
                type: 'POST',
                data: 'autoid='+ autoid,
                    success: function(data) {
                        console.log("dataaa",data[0]['LEAVE_TYPE_NAME']);
                        edit_popup.classList.add('show');
                        $('#edit_leave_type_name').val(data[0]['LEAVE_TYPE_NAME']);
                        $('#edit_allote_day').val(data[0]['ALLOTED_DAYS']);
                        $('#leave_type_id').val(data[0]['LEAVE_TYPE_ID']);
                    }
            })

    }

    function approveleaverequest(id) {
        let autoid = id;
        // alert(autoid);
        approve_span.onclick = function() {
        approve_popup.classList.remove('show');}
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                url: '/approve_leave_manage_data',
                type: 'POST',
                data: 'autoid='+ autoid,
                    success: function(data) {
                        console.log("dataaa",data);
                        approve_popup.classList.add('show');

                        $('#user_id_approve').val(data[0]['LEAVE_ID']);
                        $('#leave_type_approve').text(data[0]['LEAVE_TYPE']);
                        $('#reason_for_leave').text(data[0]['LEAVE_REASON']);
                        $('#count_of_day').text(data[0]['LEAVE_DAYS']);
                        $('#user_name_approve').text(data[0]['USER_NAME']);

                        //////////////////      on date   //////////////////
                        var ondate_withday = data[0]['CURRENT_DATE'];
                        const monthName = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const d = new Date(ondate_withday);
                        var month_name = monthName[d.getMonth()];
                        let day = String(d.getDate()).padStart(2, '0');
                        let year = d.getFullYear();
                        var days_name = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                        var dayName = days_name[new Date(ondate_withday).getDay()];
                        var Start_datewithday = day +'-'+ month_name +'-'+ year +','+ dayName;
                        $('#on_date_approve').text(Start_datewithday);
                        /////////////////      start_leave_date_approve   //////////////////
                        var start_leave_date_approve = data[0]['START_LEAVE_DATE'];
                        const s_monthName = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const s_d = new Date(start_leave_date_approve);
                        var month_name = s_monthName[s_d.getMonth()];
                        let s_day = String(s_d.getDate()).padStart(2, '0');
                        let s_year = s_d.getFullYear();
                        var s_days_name = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                        var s_dayName = s_days_name[new Date(start_leave_date_approve).getDay()];
                        var Start_datewithday = s_day +'-'+ month_name +'-'+ s_year +','+ s_dayName;
                        $('#start_leave_date_approve').text(Start_datewithday);
                        /////////////////      end_leave_date_approve   //////////////////
                        var end_leave_date_approve = data[0]['END_LEAVE_DATE'];
                        const e_monthName = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const e_d = new Date(end_leave_date_approve);
                        var month_name = e_monthName[e_d.getMonth()];
                        let e_day = String(e_d.getDate()).padStart(2, '0');
                        let e_year = e_d.getFullYear();
                        var e_days_name = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                        var e_dayName = e_days_name[new Date(end_leave_date_approve).getDay()];
                        var Start_datewithday = e_day +'-'+ month_name +'-'+ e_year +','+ e_dayName;
                        $('#end_leave_date_approve').text(Start_datewithday);
                    }
            })

    }
</script>
<script>
    var path = {!! json_encode(url('/')) !!};
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#pending_request').DataTable({
        language: {
        searchPlaceholder: "Search records",
        search: "<i class='fa fa-search' aria-hidden='true'></i>",
        paginate: {
        next: '<span class="typcn typcn-arrow-right-outline"></span>', // or '→'
        previous: '<span class="typcn typcn-arrow-left-outline"></span>' // or '←'
    }
      },
      processing: true,
    serverSide: true,
    searchable: true,
    ajax : {
    url : path + '/show_pending_leave_request',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'USER_NAME', name: 'USER_NAME' },
        { data: 'CURRENT_DATE', name: 'CURRENT_DATE' },
        { data: 'LEAVE_TYPE', name: 'LEAVE_TYPE' },
        { data: 'START_DATEWITHDAY', name: 'START_DATEWITHDAY' },
        { data: 'LEAVE_DAYS', name: 'LEAVE_DAYS' },
        // { data: 'LEAVE_REASON', name: 'LEAVE_REASON' },
        { data: 'action', name: 'action' }
    ]
   });
///////////////////////////////////////////////////////////////////////////////////
   $('#leave_type').DataTable({
        language: {
        searchPlaceholder: "Search records",
        search: "<i class='fa fa-search' aria-hidden='true'></i>",
        paginate: {
        next: '<span class="typcn typcn-arrow-right-outline"></span>', // or '→'
        previous: '<span class="typcn typcn-arrow-left-outline"></span>' // or '←'
    }
      },
      processing: true,
    serverSide: true,
    searchable: true,
    ajax : {
    url : path + '/show_leave_type',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'LEAVE_TYPE_NAME', name: 'LEAVE_TYPE_NAME' },
        { data: 'ALLOTED_DAYS', name: 'ALLOTED_DAYS' },
        { data: 'action', name: 'action' }
    ]
   });
</script>

@endsection
