@extends('Layout.app')
@section('content')
<?php
$getDatais = $message;
?>
<div>
    <div class="row" style="position: relative;background: #142850 ;width: 100%;margin-right: 0px;margin-left: 0px;">
        <div style="padding:8px 35px;">
            <div>
                <h3 style="margin-bottom: 0px;color:white"><a class="white_anchor" href="{{ url('/Admin/admindahboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a>{{$getDatais}}'s</h3>
            </div>
        </div>
        <div class="absolute_add_btn" style=""><a href="{{ url('/Admin/admindahboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/Admin/Add_Departments') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div>
    </div>
</div>
<br>
<img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
<?php
print($getDatais);
if($getDatais == 'Grade') {
    ?>
<div class="margin_left_right">
    <table id="example2" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Grade Name</th>
                <th>Grade  Descryption</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<?php
} else {
    ?>
<div class="margin_left_right">
    <table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Level Name</th>
                <th>Level Discription</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<?php
}
?>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script>
var getType = "<?php echo $getDatais;?>"
if(getType == 'Grade') {
    var path = {!! json_encode(url('/')) !!};
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#example2').DataTable({
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
    url : path + '/show_alldepartment_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'DEPARTMENT_NAME', name: 'DEPARTMENT_NAME' },
         { data: 'DEPARTMENT_NAME', name: 'DEPARTMENT_NAME' },
        { data: 'action', name: 'action' }


    ]
});
    // alert('Grede System')
} else {
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
    url : path + '/show_alldepartment_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'DEPARTMENT_NAME', name: 'DEPARTMENT_NAME' },
         { data: 'DEPARTMENT_NAME', name: 'DEPARTMENT_NAME' },
        { data: 'action', name: 'action' }


    ]
})
}

   function deleteDepartments(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisDepartment/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Department Deleted Sucessfuly');
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
