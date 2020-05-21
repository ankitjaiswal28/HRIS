@extends('layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor"
                            href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label class="ralway_font">Project's</label>
                    </h3>
                </div>
                <div style="float:right;">
                    <a href="{{ url('project/create') }}" class="btnn"><i class="fa fa-plus"
                            style="padding-right: 10px;" aria-hidden="true"></i>ADD PROJECT</a>
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
</div></div></div>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
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
<script>
    function deleteFunction(id,event) {
        alert("dvdffs");

		event.preventDefault(); // prevent form submit

		swal({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: true
		});
		/*function(isConfirm){
			if (isConfirm) {

				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				var base_url = {!! json_encode(url('/')) !!};
				$.ajax({
					url: base_url+'/user/delete/'+id,
					type: 'post',
					data:{
					      id:id,_token:CSRF_TOKEN,
						 },
					success:function(data)
					{
						swal("User Deleted " , "info");
						$('#table_id').DataTable().ajax.reload();
					}
				});
				}
			}*/
	}
</script>
@endsection
