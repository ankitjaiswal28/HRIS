@extends('layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor" href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label class="ralway_font">Project's</label>
                    </h3>
                </div>
                <div style="float:right;">
                    <a href="{{ url('project/create') }}" class="btnn"><i class="fa fa-plus" style="padding-right: 10px;" aria-hidden="true"></i>ADD PROJECT</a>
                </div>
            </div>
        </div>

        <div class="margin_left_right">
            <table id="client-table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Project Name</th>
                        <th>Project Description</th>
                        <th>Project Target Hours</th>
                        <th>Project Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>

<script>
    function deleteDepartments(id, event) {
        event.preventDefault(); // prevent form submit

        $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deleted_project/' + id,
                type: 'get',
                success: function(data) {
                    console.log('Data', data);
                    // return;
                    var response = data.trim();
                    if (response == 'Done') {
                        alert('Project Deleted Succesfully.');
                    } else {
                        alert('Something Went Wrong');
                    }
                    location.reload();
                },
                complete: function() {
                    $('#loading-image').hide();
                }
            });
            //  alert(id);
        } else {
            alert("You Cancel The Request");
            txt = "You pressed Cancel!";
        }
    }
</script>

<script>
   $(function() {
        var path = {!! json_encode(url('/')) !!};
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#client-table').DataTable({
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
    url : path + '/show_all_data',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {data:'PROJECT_NAME' , name:'PROJECT_NAME'},
        {data:'PROJECT_DESCRIPTION' , name:'PROJECT_DESCRIPTION'},
        {data:'PROJECT_TARGET_HR' , name:'PROJECT_TARGET_HR'},
        {data:'PROJECT_COST' , name:'PROJECT_COST'},
        { data: 'action', name: 'action' }
        ]
});
});

</script>

@endsection
