@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor"
                            href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label class="ralway_font">User's</label>
                    </h3>
                </div>
                <div style="float:right;">
                    <a href="{{ url('/Admin/Add_User') }}" class="btnn"><i class="fa fa-plus"
                            style="padding-right: 10px;" aria-hidden="true"></i>ADD User</a>
                </div>
            </div>
        </div>
<img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
<div class="margin_left_right">
    <table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Sr</th>
                <th>User Name</th>
                <th>EmailId</th>
                <th>Roles</th>
                <th>Reporting Managers</th>
                <th>Primary  Reporting Manager</th>
                <th>Employee Id</th>
                <th>Employee Type</th>
                <th>Employee Shift</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- <tbody>
            <tr>
                <td>1</td>
                <td>Hr</td>
                <td class="grey_font"><a href="{{ url('/Superadmin/Edit_Module') }}">Assign</a></td>
                <td class="grey_font"><a href="{{ url('/Superadmin/Add_Role') }}"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a>
                    <a href=""><img src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
        </tbody> --}}
    </table>
</div></div></div>
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
    url : path + '/show_alluser_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'username', name: 'username' },
        { data: 'emailId', name: 'emailId' },
        { data: 'master_roleId', name: 'master_roleId' },
        { data: 'REPORTING_MANGERS', name: 'REPORTING_MANGERS' },
        { data: 'PRIMARY_MANGER', name: 'PRIMARY_MANGER' },
        { data: 'EMPLOYEE_ID', name: 'EMPLOYEE_ID' },
        { data: 'EMPLOYE_TYPE', name: 'EMPLOYE_TYPE' },
        { data: 'SHIFT_ID', name: 'SHIFT_ID' },
        // { data: 'moduleLink', name: 'moduleLink' },
      //  {{-- { data: 'assgin', name: 'assgin' }, --}}
        { data: 'action', name: 'action' }


    ]
});
   /* $('#example').DataTable({
        language: {
        searchPlaceholder: "Search records",
        search: "<i class='fa fa-search' aria-hidden='true'></i>",
        paginate: {
      next: '<span class="typcn typcn-arrow-right-outline"></span>', // or '→'
      previous: '<span class="typcn typcn-arrow-left-outline"></span>' // or '←'
    }
      }
   });*/
   function deleteUser(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisUser/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('User Deleted Sucessfuly');
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
