@extends('Layout.app')
@section('content')
<div>
    <div class="row" style="position: relative;background: #142850 ;width: 100%;margin-right: 0px;margin-left: 0px;">
        <div style="padding:8px 35px;">
            <div>
                <h3 style="margin-bottom: 0px;color:white"><a class="white_anchor" href="{{ url('/Admin/admindahboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | Desigantions's</h3>
            </div>
        </div>
        <div class="absolute_add_btn" style=""><a href="{{ url('/Admin/admindahboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/Admin/Add_Designations') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div>
    </div>
</div>
<br>
<img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
<div class="margin_left_right">
    <table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Designation  Name</th>
                <th>Designation Details</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<script src="/asset/js/jquery.js"></script>
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
    url : path + '/show_alldesignation_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'DESGINATION_NAME', name: 'DESGINATION_NAME' },
        { data: 'DESGINATION_DESCRIPTION', name: 'DESGINATION_DESCRIPTION' },
        { data: 'action', name: 'action' }


    ]
});
   function deleteDesignation(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisDesignation/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Designation Deleted Sucessfuly');
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
@endsection
