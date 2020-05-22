@extends('Layout.app')
@section('content')
<link rel="stylesheet" href="/asset/css/Calender.css">
<div class="main_card">
    {{-- <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/') }}"><i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">All Employee</span></a><i class="fa fa-close" aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i></div> --}}
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
                                <select class="form-control" id="PROJECT_ID" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option>--SELECT--</option>
                                    @foreach ($projectlist as $projectlists)
                                    <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option>

                                    {{-- <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option> --}}
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

                                    {{-- <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option> --}}
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <div class="form-group" style="margin-bottom: 8px;">
                                        <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">SELECT DATE</label>
                                        <input class="effect-16" type="date" id="TIMESHEET_DATE" placeholder="" style="clear:both">
                                    </div>
                                    {{-- <div id="datepicker"> --}}
                                    {{-- <button id="datepicker-button">Open Datepicker</button> --}}
                                    {{-- <div id="datepicker-container"> --}}
                                    {{-- <div class="datepicker-header">
                                                <button class="datepicker-button-change" id="datepicker-previous-button"><span style="position: absolute;font-size: 40px;    font-weight: bold; top: 0 !important;right: auto !important;color: #aaaaaa;float: right !important;">
                                                        <</span> </button> <div id="datepicker-indicator">
                                            </div>
                                            <button class="datepicker-button-change" id="datepicker-next-button"><span style="position: absolute;font-size: 40px;    font-weight: bold; top: 0 !important;right: auto !important;color: #aaaaaa;float: right !important;">></span></button>
                                        </div> --}}
                                    <ul id="datepicker-week-title"></ul>
                                    <div id="datepicker-body"></div>

                                    <button id="datepicker-clear-button">Clear</button>
                                    {{-- <div>
                                          <button id="datepicker-submit-button">Submit</button>
                                        </div> --}}
                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>

                            </div>
                            <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                                {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="datepicker-footer" style="min-height: 20px;" id='datestart'>
                                        <span id="datepicker-selected-text" style="font-size: 15px;font-weight: bold;top: 5px;"></span>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="datepicker-End-footer" id='dateend'>
                                    <span id="datepicker-End-text" style="font-size: 15px;font-weight: bold;top: 5px;"></span>
                                </div>
                            </div> --}}

                            </div>
                        </div>

                        <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">START TIME</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <select class="form-control" id="START_HR" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <select class="form-control" id="START_MIN" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>

                        </div>
                        <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">STOP TIME</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <select class="form-control" id="STOP_HR" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <select class="form-control" id="STOP_MIN" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">DESCRIPTION</label>
                                    <textarea class="form-control" rows="2" id="DESCRIPTION" style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
                                </div>
                                <button type="submit" class="btnn" id="submit_form" style="float: right;border: none;width: 150px;">Submit</button>
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
                            {{-- <th>DECRIPTION</th> --}}
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
                        <select class="form-control" id="UP_PROJECT_ID" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;   padding: 5px !important;">

                            <option>--SELECT--</option>
                            @foreach ($projectlist as $projectlists)
                            <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option>

                            {{-- <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option> --}}
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

                            {{-- <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option> --}}
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">SELECT DATE</label>
                                <input class="effect-16" type="date" id="UP_TIMESHEET_DATE" placeholder="" style="clear:both">
                            </div>


                        </div>

                    </div>

                </div>

                <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" style="margin-bottom: 8px;">
                            <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">START TIME</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control" id="UP_START_HR" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                            <option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control" id="UP_START_MIN" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                            <option value="00">00</option>
                            <option value="05">05</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                            <option value="55">55</option>
                        </select>
                    </div>

                </div>
                <div class="row" style="position: relative;width: -webkit-fill-available;top: 5px;left: 5px;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" style="margin-bottom: 8px;">
                            <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">STOP TIME</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control" id="UP_STOP_HR" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                            <option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control" id="UP_STOP_MIN" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">

                            <option value="00">00</option>
                            <option value="05">05</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                            <option value="55">55</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" style="margin-bottom: 8px;">
                            <label for="reason" class="grey" style="margin-top: 5px;margin-bottom: 5px;">DESCRIPTION</label>
                            <textarea class="form-control" rows="2" id="UP_DESCRIPTION" style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
                        </div>
                        <button type="submit" class="btnn" id="submit_update" style="float: right;border: none;width: 150px;">Submit</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- //////////////////////////         Calender datepicker  Script      ////////////////////////////// --}}
<script src="/asset/js/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> --}}
{{-- <script src="/asset/js/calender.js"></script> --}}
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
{{-- <script>
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
</script> --}}
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
        edit_popup.classList.remove('show');}
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                url: '/timesheet_get_data',
                type: 'POST',
                data: 'autoid='+ autoid,
                    success: function(data) {
                        console.log("dataaa",data);
                        edit_popup.classList.add('show');
                         $('#TIMESHEET_ID').val(data[0]['TIMESHEET_ID']);
                            $('#UP_PROJECT_ID').val(data[0]['PROJECT_ID']);
                            $('#UP_ACTIVITY_TYPE').val(data[0]['ACTIVITY_ID']);
                            $('#UP_TIMESHEET_DATE').val(data[0]['TIMESHEET_DATE']);
                            $('#UP_START_HR').val(data[0]['START_HR']);
                            $('#UP_START_MIN').val(data[0]['START_MIN']);
                            $('#UP_STOP_HR').val(data[0]['STOP_HR']);
                            $('#UP_STOP_MIN').val(data[0]['STOP_MIN']);
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
            var TIMESHEET_DATE = $("#TIMESHEET_DATE").val();
            var START_HR = $("#START_HR").val();
            var START_MIN = $("#START_MIN").val();
            var STOP_HR = $("#STOP_HR").val();
            var STOP_MIN = $("#STOP_MIN").val();
            var DESCRIPTION = $("#DESCRIPTION").val();


            $.ajax({

                type: 'POST',
                url: "{{URL::to('timesheet/createdata')}}",
                cache: false,
                data: {
                    'PROJECT_ID': PROJECT_ID,
                    'ACTIVITY_TYPE' : ACTIVITY_TYPE,
                    'TIMESHEET_DATE': TIMESHEET_DATE,
                    'START_HR': START_HR,
                    'START_MIN': START_MIN,
                    'STOP_HR': STOP_HR,
                    'STOP_MIN': STOP_MIN,
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

<script>
     $(document).ready(function() {
        $("#submit_update").click(function(e) {
            e.preventDefault();

            var TIMESHEET_ID = $("#TIMESHEET_ID").val();
            var PROJECT_ID = $("#UP_PROJECT_ID").val();
            var ACTIVITY_TYPE = $("#UP_ACTIVITY_TYPE").val();
            var TIMESHEET_DATE = $("#UP_TIMESHEET_DATE").val();
            var START_HR = $("#UP_START_HR").val();
            var START_MIN = $("#UP_START_MIN").val();
            var STOP_HR = $("#UP_STOP_HR").val();
            var STOP_MIN = $("#UP_STOP_MIN").val();
            var DESCRIPTION = $("#UP_DESCRIPTION").val();
            // alert(TIMESHEET_ID);

            $.ajax({

                    type: 'POST',
                    url: "{{URL::to('/update_timesheet')}}",
                    cache: false,
                    data: {
                        'TIMESHEET_ID': TIMESHEET_ID,
                        'UP_PROJECT_ID': PROJECT_ID,
                        'UP_ACTIVITY_TYPE': ACTIVITY_TYPE,
                        'UP_TIMESHEET_DATE': TIMESHEET_DATE,
                        'UP_START_HR': START_HR,
                        'UP_START_MIN': START_MIN,
                        'UP_STOP_HR': STOP_HR,
                        'UP_STOP_MIN': STOP_MIN,
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

@endsection

