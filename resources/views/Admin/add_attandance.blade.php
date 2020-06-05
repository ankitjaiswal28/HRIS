@extends('Layout.app')
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        width: 300px !important;
        height: 35px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: -215px !important;
    }
    .select2-container--open .select2-dropdown--below {
        width: 300px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height:33px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px !important;
    }
</style>
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor"
                            href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline"
                                aria-hidden="true"></i></a> | <label class="ralway_font">Module's</label>
                    </h3>
                </div>
                <div style="position: absolute;width: 300px;right: 0;margin-right: 15px;bottom: 10px;">
                    <select class="js-select2">
                        <option value="">Select</option>
                        <option>Select A</option>
                        <option>Select B</option>
                        <option>Select C</option>
                        <option>Select D</option>
                      </select>
                </div>
            </div>
        </div>
        <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
        <div class="margin_left_right">
            <table id="client-table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Module Name</th>
                        <th>Action</th>
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
$(document).ready(function() {

  $(".js-select2").select2();

  $(".js-select2-multi").select2();

  $(".large").select2({
    dropdownCssClass: "big-drop",
  });

});
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
