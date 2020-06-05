@extends('Layout.app')
@section('content')
<link rel="stylesheet" href="/asset/css/Calender.css">
<div class="new-wrapper">
<div id="main">
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="
        font-size: 18px;">All Employee</span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="container-fluid">
    <div class="row no_left_margin">
        <div class="col-md-8 col-sm-8 col-xs-8 nopadding no_padding_left">
            <div class="neuphormic_shadow" style="padding:10px 0px">
                <div class="flip-card-3D-wrapper" style="width: 100% !important;">
                    <div>
                        <h2>Apply Leave</h2>

                        <label for="leavetype" class="grey">LEAVE TYPE</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <select class="form-control" id="leavetype"
                                    style="height: calc(3.25rem + 2px);border: 1px solid #cecece !important;padding: 15px !important;">
                                    <option>Planned Leave</option>
                                    <option>Unplanned Leave</option>
                                    <option>Maternity Leave</option>
                                </select>
                            </div>
                            <div id="datepicker">
                                <div id="datepicker-container">
                                    <div class="datepicker-header">
                                        <button class="datepicker-button-change" id="datepicker-previous-button" style="
                                        margin-left: 15px;
                                    "><span
                                            style="position: relative;font-size: 25px;">
                                                <</span> </button> <div id="datepicker-indicator">
                                    </div>
                                    <button class="datepicker-button-change" id="datepicker-next-button" style="margin-right:15px;"><span
                                        style="position: relative;font-size: 25px;">></span></button>
                                </div>
                                <ul id="datepicker-week-title"></ul>
                                <div id="datepicker-body"></div>

                                <button id="datepicker-clear-button">Clear</button>
                            </div>
                        </div>
                        <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="datepicker-footer" style="min-height: 20px;" id='datestart'>
                                    <span id="datepicker-selected-text"
                                        style="font-size: 15px;font-weight: bold;top: 5px;"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="datepicker-End-footer" id='dateend'>
                                    <span id="datepicker-End-text"
                                        style="font-size: 15px;font-weight: bold;top: 5px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="
                                word-break: break-all;margin-bottom: 10px;">
                                <div
                                    style="color: white;padding: 15px !important;border-radius: 4px;background: #72758a;">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6" style="    border-right: 1px solid;">
                                            <span style="font-size: 18px;">12</span> out of <span
                                                style="font-size: 18px;">21</span>
                                            Used.
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span style="font-size: 18px;">10</span> days remaining.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 5px 15px;">

                            <?php
                            $leave_count = count($all_leave_type);
                            for($i = 0 ; $i < $leave_count; $i++) {
                                ?>
                            <div class="col-md-6 col-sm-6 col-xs-6"
                                style="word-break: break-all;padding-top: 0px;text-align: center;padding-left: 0px;">
                                <div
                                    style="padding: 10px;border: 1px solid #cecece;border-radius: 5px;margin-bottom: 15px;">
                                    <h5 class="margin_bottom-0"><?php echo $all_leave_type[$i]->LEAVE_TYPE_NAME;?> Leave
                                    </h5>
                                    <?php
                                    $color_leave = "";
                                    $leave_typee =  $all_leave_type[$i]->LEAVE_TYPE_NAME;
                                                if ($leave_typee == 'Planned') {
                                                   $color_leave = "planned_leave_text_color";

                                                } elseif ($leave_typee == 'Unplanned') {
                                                    $color_leave = "Unplanned_leave_text_color";
                                                } elseif ($leave_typee == 'Maternity') {
                                                    $color_leave = "Maternity_leave_text_color";
                                                }
                                    ?>
                                    <h1 class="margin_bottom-0 <?php echo $color_leave?>"><?php
                                    $string  = $all_leave_type[$i]->LEAVE_TYPE_NAME;
                                    $pieces = explode(" ", $string);
                                    $str="";
                                    foreach($pieces as $piece)
                                    {
                                        $str.=$piece[0];
                                    }
                                    echo $str;?>L</h1>
                                    <h6 class="margin_bottom-0">Total Leave -
                                        <?php echo $all_leave_type[$i]->ALLOTED_DAYS;?></h6>
                                    <h6 class="margin_bottom-0">Available Leave - 0</h6>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-right: 30px;padding-left: 30px;">
                    <div class="form-group" style="margin-bottom: 8px;">
                        <label for="reason" class="grey" style="margin-top: 10px;">REASON</label>
                        <textarea class="form-control" rows="2" id="reason"
                            style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
                    </div>
                    <button type="submit" class="btnn" id="submit_form"
                        style="float: right;border: none;width: 150px;">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 nopadding no_padding_left">
        <div class="neuphormic_shadow" style="padding: 15px;padding-right: 0 !important">
            <div class="flip-card-3D-wrapper" style="width: 100% !important;max-width: 100% !important;">
                <div class="container-fluid" style="padding: 0;word-break: break-all;border-radius:5px;">
                    <div class="leave_show_container">
                        <h2>Applied Leave Details</h2>
                        <div class="scrollbar" id="style-1" style="height: 560px !important;">
                            <div class="force-overflow">
                                <?php
                                $length = count($leave_details);
                                for($i = 0 ; $i < $length; $i++) {
                                    ?>
                                <div style="padding: 5px 0px;">
                                    <div style="border-bottom: 1px solid #cecece;">
                                        <?php
                                                $leave_typee =  $leave_details[$i]->LEAVE_TYPE;
                                                if ($leave_typee == 'Planned Leave') {
                                                   $color_leave = "planned_leave_color";

                                                } elseif ($leave_typee == 'Unplanned Leave') {
                                                    $color_leave = "Unplanned_leave_color";
                                                } elseif ($leave_typee == 'Maternity Leave') {
                                                    $color_leave = "Maternity_leave_color";
                                                }?>
                                        <span class="margin_bottom-0 <?php echo $color_leave?>"
                                            style="padding: 0px 5px;font-size: 20px;"><?php echo $leave_details[$i]->LEAVE_TYPE;?></span>
                                        <p class="leave_p_tag" style="margin-bottom: 5px;">
                                            <?php echo $leave_details[$i]->LEAVE_REASON;?></p>
                                        <div class="row" style="margin-left: 0px;margin-right: 0px;margin-bottom: 5px;">
                                            <div class="col-md-6 col-sm-6 col-xs-6" style="float:left">
                                                <div class="left_date grey_color">
                                                    <?php echo $leave_details[$i]->START_DATEWITHDAY;?> |
                                                    <?php echo $leave_details[$i]->LEAVE_DAYS;?> Day's
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <?php
                                                $leave_statuss =  $leave_details[$i]->LEAVE_STATUS;
                                                if ($leave_statuss == 'Pending') {
                                                    ?>
                                                <div class="leave_btn_card pending_color">
                                                    <?php echo $leave_statuss;?>
                                                </div>
                                                <?php
                                                } elseif ($leave_statuss == 'Approved') {
                                                    ?>
                                                <div class="leave_btn_card approved_color">
                                                    <?php echo $leave_statuss;?>
                                                </div>
                                                <?php
                                                } elseif ($leave_statuss == 'Cancelled') {
                                                    ?>
                                                <div class="leave_btn_card cancelled_color">
                                                    <?php echo $leave_statuss;?>
                                                </div>
                                                <?php
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div></div>
</div>
{{-- //////////////////////////         Calender datepicker  Script      ////////////////////////////// --}}
<script src="/asset/js/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> --}}
<script src="/asset/js/calender.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#submit_form").click(function(){
          var leave_type = $('#leavetype :selected').text();
          var reason = $('#reason').val();
          var start_leave_date = startdate;
          var end_leave_date = enddate;
          var user_id = "10";
          var username = "Abhishek";
          let today_date = new Date().toISOString().slice(0, 10);
          var leave_status = "Pending";
///////////////////////    get diff between 2 dates    /////////////////
        const timeDiff  = (new Date(enddate)) - (new Date(startdate));
        const daydiff      = timeDiff / (1000 * 60 * 60 * 24);
        var days = daydiff + 1;
/////////////////////     get date with day formate    ///////////////////
        const monthName = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const d = new Date(startdate);
        var month_name = monthName[d.getMonth()];
        let day = String(d.getDate()).padStart(2, '0');
        let year = d.getFullYear();
        var days_name = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        var dayName = days_name[new Date(startdate).getDay()];
        var Start_datewithday = day +'-'+ month_name +'-'+ year +','+ dayName;
        console.log("date",d);
        ///////////////////////////////////////////////////////////////
          var dataString = 'leave_type='+ leave_type + '&reason='+ reason + '&start_leave_date='+ start_leave_date + '&end_leave_date='+ end_leave_date+ '&user_id='+ user_id + '&username='+ username + '&today_date='+ today_date + '&leave_status='+ leave_status + '&days='+ days + '&Start_datewithday='+ Start_datewithday;
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/insert_applyleave',
                type: 'POST',
                data: dataString,
                    success: function(data) {
                        // console.log('Data', data)
                         var response = data.trim();
                         if(response == 'Already'){
                             alert('Leave Applied Already')
                         } else {
                             alert('Leave Applied');
                             // window.location.href = 'SuperAdmin/superadmindahboard';
                             var url = '{{ route("/applyleave") }}';
                             window.location.href = url;
                             //window.location.href ='Superadmin/client'
                         }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
        });
    });
</script>
@endsection
