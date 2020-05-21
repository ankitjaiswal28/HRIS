@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor"
                            href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label class="ralway_font">Module's</label>
                    </h3>
                </div>
                <div style="float:right;">
                    <a href="{{ url('/SuperAdmin/Module') }}" class="btnn"><i class="fa fa-plus"
                            style="padding-right: 10px;" aria-hidden="true"></i>ADD Module</a>
                </div>
            </div>
        </div>
        {{-- <div>
            <div class="row botom_nav">
                <div style="padding:8px 35px;">
                    <div>
                        <h3 style="margin-bottom: 0px;color:white"><a class="white_anchor"
                                href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline"
            aria-hidden="true"></i></a> | <label class="ralway_font">Module's</label>
        </h3>
    </div>
</div>
<div class="absolute_add_btn" style=""><a href="{{ url('/Superadmin/dashboard') }}"><i
            class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
        href="{{ url('/SuperAdmin/Module') }}"><i class="fa fa-plus fafa_add_circle_right" aria-hidden="true"></i></a>
</div>
</div>
</div> --}}
{{-- <br> --}}
<img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
<div class="margin_left_right">
    <table id="client-table" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Module Name</th>
                {{-- <th>Module Link</th> --}}
                {{-- <th>Assgin Module</th> --}}
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
    url : path + '/show_admin_module_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'moduleName', name: 'moduleName' },
        // { data: 'moduleLink', name: 'moduleLink' },
        // { data: 'assgin', name: 'assgin' },
        { data: 'action', name: 'action' }


    ]
});
});
</script>
<script>
    function deleteModule(id,event) {
    event.preventDefault(); // prevent form submit
    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deleteAdminModule/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        // return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Module Deleted Sucessfuly');
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
