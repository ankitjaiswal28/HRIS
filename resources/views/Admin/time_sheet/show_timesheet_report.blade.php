@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor" href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label class="ralway_font">Time-Sheet</label>
                    </h3>
                </div>
                <div style="float:right;">
                    <a href="{{ url('timesheet/showreport') }}" class="btnn"><i class="fa fa-plus" style="padding-right: 10px;" aria-hidden="true"></i>EXPORT</a>
                </div>
            </div>
        </div>
        <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
        <div class="margin_left_right">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>SR.No</th>
                        <th>Employee Name</th>
                        <th>Project Name</th>
                        <th>Action Type</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Hours</th>
                        <th>Total Min</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/jquery_213.min.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script>
    var path = {!! json_encode(url('/')) !!};
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$('#example').DataTable({
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
    url : path + '/show_all_tsdata',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'username', name: 'username' },
        { data: 'PROJECT_NAME', name: 'PROJECT_NAME' },
        { data:'ACTIVITY_TYPE' , name:'ACTIVITY_TYPE' },
        { data:'TIMESHEET_DATE' , name:'TIMESHEET_DATE' },
        { data:'START_TIME' , name:'START_TIME' },
        { data:'STOP_TIME' , name:'STOP_TIME' },
        { data:'TOTAL_HR' , name:'TOTAL_HR' },
        { data:'TOTAL_MIN' , name:'TOTAL_MIN' },


    ]
});
</script>
@endsection
