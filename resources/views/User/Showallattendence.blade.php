@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor" href="{{ url('/User/dashboard') }}"><i
                                class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label
                            class="ralway_font">Attendence's</label>
                    </h3>
                </div>
                {{-- <div style="float:right;">
                    <a href="{{ url('/Admin/addShifts') }}" class="btnn"><i class="fa fa-plus"
                            style="padding-right: 10px;" aria-hidden="true"></i>ADD SHIFTS</a>
                </div> --}}
            </div>
        </div>
        <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
        <div class="margin_left_right">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Assigned Client</th>
                        <th>Shift</th>
                        <th>In Time Date</th>
                        <th>In Time</th>
                        <th>Out Time Date</th>
                        <th>Out Time</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
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
    url : path + '/show_allatendence_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'assgin_user_toclient', name: 'assgin_user_toclient' },
        { data: 'shift', name: 'shift' },
        { data: 'in_Date', name: 'in_Date' },
        { data: 'in_time', name: 'in_time' },
        { data: 'out_Date', name: 'out_Date' },
        { data: 'out_time', name: 'out_time' },
        // { data: 'action', name: 'action' }


    ]
});
   function deleteShifts(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Shifts!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisShifts/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Shift Deleted Sucessfuly');
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
