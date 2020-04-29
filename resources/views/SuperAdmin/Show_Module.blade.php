@extends('Layout.app')
@section('content')
<div>
    <div class="row" style="position: relative;background: #142850 ;width: 100%;margin-right: 0px;margin-left: 0px;">
        <div style="padding:8px 35px;">
            <div>
                <h3 style="margin-bottom: 0px;color:white"><a class="white_anchor" href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> |
                    Client's</h3>
            </div>
        </div>
        <div class="absolute_add_btn" style=""><a href="{{ url('/Superadmin/dashboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/SuperAdmin/Module') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div>
    </div>
</div>
<br>
<div class="margin_left_right">
    <table id="client-table" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Module Name</th>
                <th>Module Link</th>
                {{-- <th>Assgin Module</th> --}}
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

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
    url : path + '/show_module_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'moduleName', name: 'moduleName' },
        { data: 'moduleLink', name: 'moduleLink' },
        // { data: 'assgin', name: 'assgin' },
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
