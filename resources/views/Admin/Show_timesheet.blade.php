@extends('Layout.app')
@section('content')
<link rel="stylesheet" href="/asset/css/Calender.css">
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i
                class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span
                class="bold_text" style="
        font-size: 18px;">All Employee</span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="container-fluid">
    <div class="row no_left_margin">
        <div class="col-md-3 col-sm-3 col-xs-3 nopadding no_padding_left">
            <div class="neuphormic_shadow">
                <div class="flip-card-3D-wrapper" style="padding: 10px;width: 100% !important;left: 0px;">
                    <div class="">
                        <h2>Time-Sheet</h2>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                            <div class="form-group">
                                <label for="leavetype" class="grey">PROJECT NAME</label>
                                <select class="form-control" id="leavetype"
                                    style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">
                                    <option>Casual Leave</option>
                                    <option>Sick Leave</option>
                                    <option>Maternity Leave</option>
                                    <option>Half Pay Leave</option>
                                    <option>Study Leave</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <div id="datepicker">
                                        {{-- <button id="datepicker-button">Open Datepicker</button> --}}
                                        <div id="datepicker-container">
                                            <div class="datepicker-header">
                                                <button class="datepicker-button-change"
                                                    id="datepicker-previous-button"><span style="position: absolute;font-size: 40px;    font-weight: bold;
                                  top: 0 !important;right: auto !important;color: #aaaaaa;float: right !important;">
                                                        <</span> </button> <div id="datepicker-indicator">
                                            </div>
                                            <button class="datepicker-button-change" id="datepicker-next-button"><span
                                                    style="position: absolute;font-size: 40px;    font-weight: bold;
                                  top: 0 !important;right: auto !important;color: #aaaaaa;float: right !important;">></span></button>
                                        </div>
                                        <ul id="datepicker-week-title"></ul>
                                        <div id="datepicker-body"></div>

                                        <button id="datepicker-clear-button">Clear</button>
                                        {{-- <div>
                                          <button id="datepicker-submit-button">Submit</button>
                                        </div> --}}
                                    </div>
                                </div>
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

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="reason" class="grey"
                                style="margin-top: 5px;margin-bottom: 5px;">REASON</label>
                                <textarea class="form-control" rows="2" id="reason"
                                    style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
                            </div>
                            <button type="submit" class="btnn" id="submit_form"
                                style="float: right;border: none;width: 150px;">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-9 nopadding no_padding_left">
        <div class="neuphormic_shadow" style="padding-top: 15px;">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Admin Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Prefix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Core Team Solution</td>
                        <td class="grey_font">XYZ</td>
                        <td class="grey_font">coretram@cts.com</td>
                        <td class="grey_font">9999999999</td>
                        <td class="grey_font">CTS</td>
                        <td class="grey_font"><a href=""><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                                    style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                            <a href=""><img src="/asset/css/zondicons/zondicons/close.svg"
                                    style="width: 15px;    filter: invert(0.5);" alt=""></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
{{-- //////////////////////////         Calender datepicker  Script      ////////////////////////////// --}}
<script src="/asset/js/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> --}}
<script src="/asset/js/calender.js"></script>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script>
    $('#example').DataTable({
        language: {
        searchPlaceholder: "Search records",
        search: "<i class='fa fa-search' aria-hidden='true'></i>",
        paginate: {
      next: '<span class="typcn typcn-arrow-right-outline"></span>', // or '→'
      previous: '<span class="typcn typcn-arrow-left-outline"></span>' // or '←'
    }
      }
   });
</script>
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
          var dataString = 'leave_type='+ leave_type + '&reason='+ reason + '&start_leave_date='+ start_leave_date + '&end_leave_date='+ end_leave_date+ '&user_id='+ user_id + '&username='+ username + '&today_date='+ today_date + '&leave_status='+ leave_status;

          console.log("dataString :",dataString);

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
                        console.log('Data', data)
                         var response = data.trim();
                        //  if(response == 'Error'){
                        //      alert('Something Went Wrong')
                        //  } else if(response == 'Email ID Already Exits') {
                        //       alert('Email ID Already Exits');
                        //       $('#email').val('');
                        //  }else if(response == 'PreFix Already Exits') {
                        //      alert('PreFix Already Exits');
                        //      $('#prefix').val('');
                        //  } else {
                        //      alert('Admin Craeted Sucessfuly');
                        //      // window.location.href = 'SuperAdmin/superadmindahboard';
                        //      var url = '{{ route("SuperAdmin/Show_client") }}';
                        //      window.location.href = url;
                        //      //window.location.href ='Superadmin/client'
                        //  }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
        });
    });
</script>
@endsection
