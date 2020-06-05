@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">All Employee</span></a><i class="fa fa-close" aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
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
                                <select class="form-control" id="PROJECT_ID"
                                    style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option>--SELECT--</option>
                                    @foreach ($projectlist as $projectlists)
                                    <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                            <div class="form-group">
                                <label for="leavetype" class="grey">ACTIVITY TYPE</label>
                                <select class="form-control" id="ACTIVITY_TYPE" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option>--SELECT--</option>
                                    @foreach ($activitytype as $activitytypes)
                                    <option value="{{ $activitytypes->ACTIVITY_ID }}">{{ $activitytypes->ACTIVITY_TYPE }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <label for="" class="grey">SELECT DATE</label>
                                    <label for="datepicker" style="width: 100%;margin-bottom: 30px;">
                                        <input type="text" class="effect-16" id="datepicker" autocomplete="off" style="width: 100%;">
                                    </label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="datepicker" style="width: 100%;" class="grey">START TIME
                                                <input type="text" class="form-control" id="InitialTime" style="font-size: 20px;
                                                                    border-bottom: 1px solid #cecece !important;
                                                                ">
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="datepicker" style="width: 100%;" class="grey">END TIME
                                                <input type="text" class="form-control" id="EndTime" style="font-size: 20px;
                                                                    border-bottom: 1px solid #cecece !important;
                                                                ">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <label for="reason" class="grey"
                                        style="margin-top: 5px;margin-bottom: 5px;">DESCRIPTION</label>
                                    <textarea class="form-control" rows="2" id="DESCRIPTION"
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
                <table id="timesheet-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>SR.No</th>
                            <th>PROJECT NAME</th>
                            <th>ACTIVITY TYPE</th>
                            <th>START TIME</th>
                            <th>STOP TIME</th>
                            <th>DATE</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
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
                <h2>UPDATE TIMESHEET</h2>
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                    <div class="form-group">
                        <input type="hidden" id="TIMESHEET_ID">
                        <label for="leavetype" class="grey">PROJECT NAME</label>
                        <select class="form-control" id="UP_PROJECT_ID"
                            style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;   padding: 5px !important;">

                            <option>--SELECT--</option>
                            @foreach ($projectlist as $projectlists)
                            <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                    <div class="form-group">
                        <label for="leavetype" class="grey">ACTIVITY TYPE</label>
                        <select class="form-control" id="UP_ACTIVITY_TYPE" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                            <option>--SELECT--</option>
                            @foreach ($activitytype as $activitytypes)
                            <option value="{{ $activitytypes->ACTIVITY_ID }}">{{ $activitytypes->ACTIVITY_TYPE }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <label for="" class="grey">SELECT DATE</label>
                            <label for="datepicker" style="width: 100%;margin-bottom: 30px;">
                                <input type="text" class="effect-16" id="UP_datepicker" autocomplete="off" style="width: 100%;">
                            </label>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="datepicker" style="width: 100%;" class="grey">START TIME
                                        <input type="text" class="form-control" id="UP_InitialTime" style="font-size: 20px;
                                                            border-bottom: 1px solid #cecece !important;
                                                        ">
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="datepicker" style="width: 100%;" class="grey">END TIME
                                        <input type="text" class="form-control" id="UP_EndTime" style="font-size: 20px;
                                                            border-bottom: 1px solid #cecece !important;
                                                        ">
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" style="margin-bottom: 8px;">
                            <label for="reason" class="grey"
                                style="margin-top: 5px;margin-bottom: 5px;">DESCRIPTION</label>
                            <textarea class="form-control" rows="2" id="UP_DESCRIPTION"
                                style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
                        </div>
                        <button type="submit" class="btnn" id="submit_update"
                            style="float: right;border: none;width: 150px;">Submit</button>
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
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script src="/asset/js/Jquery_ui_1_12_1.min.js"></script>
<script src="/asset/js/Timedropper.js"></script>

<script type="text/javascript">
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    }).datepicker("setDate", new Date());
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast"
        });
    });

    $("#InitialTime").timeDropper({
        format: 'H:mm A',
        meridians: false,
        setCurrentTime: false,
    });

    $("#EndTime").timeDropper({
        format: 'H:mm A',
        meridians: false,
        setCurrentTime: false,
    });

    $(document).ready(function() {
        $("#datepicker-submit-button").click(function() {
            var GetDate = $('#datepicker').val();
            console.log("Selected Date:", GetDate);

            var GetInitialTime = $('#InitialTime').val();
            console.log("Initial Time:", GetInitialTime);

            var GetEndTime = $('#EndTime').val();
            console.log("End Time:", GetEndTime);

            var starttime = GetInitialTime.split(' ')[0];
            var Stime = starttime + ':00';
            var endtime = GetEndTime.split(' ')[0];
            var Etime = endtime + ':00';
            console.log("Stime:", Stime);
            console.log("Etime:", Etime);

            if (Stime > Etime)
                alert("Time 1 is later than time 2");
            else
                alert("Time 2 is later than time 1");

        });
    });
</script>

<script type="text/javascript">
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $("#UP_datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    }).datepicker("setDate", new Date());
    $(function() {
        $("#UP_datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast"
        });
    });

    $("#UP_InitialTime").timeDropper({
        format: 'H:mm A',
        meridians: false,
        setCurrentTime: false,
    });

    $("#UP_EndTime").timeDropper({
        format: 'H:mm A',
        meridians: false,
        setCurrentTime: false,
    });

    $(document).ready(function() {
        $("#datepicker-submit-button").click(function() {
            var GetDate = $('#UP_datepicker').val();
            console.log("Selected Date:", GetDate);

            var GetInitialTime = $('#UP_InitialTime').val();
            console.log("Initial Time:", GetInitialTime);

            var GetEndTime = $('#UP_EndTime').val();
            console.log("End Time:", GetEndTime);

            var starttime = GetInitialTime.split(' ')[0];
            var Stime = starttime + ':00';
            var endtime = GetEndTime.split(' ')[0];
            var Etime = endtime + ':00';
            console.log("Stime:", Stime);
            console.log("Etime:", Etime);

            if (Stime > Etime)
                alert("Time 1 is later than time 2");
            else
                alert("Time 2 is later than time 1");

        });
    });
</script>

<script>
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


    ////////////////////////////////////////////////////////////////////////////////////////

    function editapplyleavetype(id) {
        let autoid = id;
        // alert(autoid);
        var edit_popup = document.getElementById('edit_popup-wrapper');
        var edit_btn = document.getElementById("editapplyleavetype");
        var edit_span = document.getElementById("edit_close");
        edit_span.onclick = function() {
            edit_popup.classList.remove('show');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/timesheet_get_data',
            type: 'POST',
            data: 'autoid=' + autoid,
            success: function(data) {
                console.log("dataaa", data);
                edit_popup.classList.add('show');
                $('#TIMESHEET_ID').val(data[0]['TIMESHEET_ID']);
                $('#UP_PROJECT_ID').val(data[0]['PROJECT_ID']);
                $('#UP_ACTIVITY_TYPE').val(data[0]['ACTIVITY_ID']);
                $('#UP_datepicker').val(data[0]['TIMESHEET_DATE']);
                $('#UP_InitialTime').val(data[0]['START_TIME']);
                $('#UP_EndTime').val(data[0]['STOP_TIME']);
                $('#UP_DESCRIPTION').val(data[0]['DESCRIPTION']);
            }
        })

    }
</script>
<script>
    $(document).ready(function() {
        $("#submit_form").click(function(e) {
            e.preventDefault();

            var PROJECT_ID = $("#PROJECT_ID").val();
            var ACTIVITY_TYPE = $("#ACTIVITY_TYPE").val();
            var TIMESHEET_DATE = $("#datepicker").val();
            var START_TIME = $("#InitialTime").val();
            // var START_MIN = $("#START_MIN").val();
            var STOP_TIME = $("#EndTime").val();
            // var STOP_MIN = $("#STOP_MIN").val();
            var DESCRIPTION = $("#DESCRIPTION").val();
            console.log("Date" + STOP_TIME);
            //   return;
            $.ajax({

                type: 'POST',
                url: "{{URL::to('timesheet/createdata')}}",
                cache: false,
                data: {
                    'PROJECT_ID': PROJECT_ID,
                    'ACTIVITY_TYPE': ACTIVITY_TYPE,
                    'datepicker': TIMESHEET_DATE,
                    'InitialTime': START_TIME,
                    // 'START_MIN': START_MIN,
                    'EndTime': STOP_TIME,
                    // 'STOP_MIN': STOP_MIN,
                    'DESCRIPTION': DESCRIPTION,
                    '_token': "{{csrf_token()}}"

                },
                success: function(data) {
                    console.log('Data', data)
                    //  return;
                    var response = data.trim();
                    if (response == 'Done') {
                        alert('Timesheet Created Successfully.')
                        var url = '{{ route("timesheet/showdata") }}';
                        window.location.href = url;
                    } else if (response == 'Already') {
                        alert('Project Name Already Exits');
                        //   $('#PROJECT_NAME').val('');
                    } else {
                        alert('Something Went Wrong')
                    }
                }
            });

        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#submit_update").click(function(e) {
            e.preventDefault();

            var TIMESHEET_ID = $("#TIMESHEET_ID").val();
            var PROJECT_ID = $("#UP_PROJECT_ID").val();
            var ACTIVITY_TYPE = $("#UP_ACTIVITY_TYPE").val();
            var TIMESHEET_DATE = $("#UP_datepicker").val();
            var START_TIME = $("#UP_InitialTime").val();
            var STOP_TIME = $("#UP_EndTime").val();
            var DESCRIPTION = $("#UP_DESCRIPTION").val();
            console.log("Date" + TIMESHEET_DATE);
            //  return;
            $.ajax({

                type: 'POST',
                url: "{{URL::to('/update_timesheet')}}",
                cache: false,
                data: {
                    'TIMESHEET_ID': TIMESHEET_ID,
                    'UP_PROJECT_ID': PROJECT_ID,
                    'UP_ACTIVITY_TYPE': ACTIVITY_TYPE,
                    'UP_datepicker': TIMESHEET_DATE,
                    'UP_InitialTime': START_TIME,
                    'UP_EndTime': STOP_TIME,
                    'UP_DESCRIPTION': DESCRIPTION,
                    '_token': "{{csrf_token()}}"

                },
                success: function(data) {
                    console.log('Data', data)
                    //  return;
                    var response = data.trim();
                    if (response == 'Done') {
                        alert('Timesheet Updated Successfully.')
                        var url = '{{ route("timesheet/showdata") }}';
                        window.location.href = url;
                    } else if (response == 'Already') {
                        alert('Project Name Already Exits');
                        //   $('#PROJECT_NAME').val('');
                    } else {
                        alert('Something Went Wrong')
                    }
                }
            });
        });
    });
</script>
<script>
    $(function() {
         var path = {!! json_encode(url('/')) !!};
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

     $('#timesheet-table').DataTable({
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
     url : path + '/show_all_timesheet',
     type : 'post',
     data : {_token: CSRF_TOKEN},
     },
     columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
         {data:'PROJECT_NAME' , name:'PROJECT_NAME'},
         {data:'ACTIVITY_TYPE' , name:'ACTIVITY_TYPE'},
         {data:'START_TIME' , name:'START_TIME'},
         {data:'STOP_TIME' , name:'STOP_TIME'},
         {data:'TIMESHEET_DATE' , name:'TIMESHEET_DATE'},
        //  {data:'DESCRIPTION' , name:'DESCRIPTION'},
         { data: 'action', name: 'action' }
         ]
 });
 });

</script>
@endsection
