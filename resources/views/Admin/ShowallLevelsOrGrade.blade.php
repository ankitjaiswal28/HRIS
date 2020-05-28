@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
<?php
$getDatais = $message;
?>
<div id="main">
    <div class="main_card">
        <div class="neuphormic_shadow fst_card">
            <div class="fst_card_cntnt">
                <h3 class="h3_header_prt" style=""><a class="white_anchor" href="{{ url('/Admin/dashboard') }}"><i
                            class="typcn typcn-home-outline" aria-hidden="true"></i></a> | <label
                        class="ralway_font">{{$getDatais}}'s</label>
                </h3>
            </div>
        <?php
        if($getDatais == 'Grade') {
        ?>
        <div style="float:right;">
            <a href="{{ url('/Admin/Grade') }}" class="btnn"><i class="fa fa-plus"
                    style="padding-right: 10px;" aria-hidden="true"></i>ADD Grade</a>
        </div>
    </div>
</div>
        {{-- <div class="absolute_add_btn" style=""><a href="{{ url('/Admin/admindahboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/Admin/Grade') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div> --}}
        <?php
        } else {
            ?>
            <div style="float:right;">
                <a href="{{ url('/Admin/Levels') }}" class="btnn"><i class="fa fa-plus"
                        style="padding-right: 10px;" aria-hidden="true"></i>ADD LEVEL</a>
            </div>
        </div>
    </div>
            {{-- <div class="absolute_add_btn" style=""><a href="{{ url('/Admin/admindahboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/Admin/Levels') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div> --}}
            <?php
        }
        ?>
    </div>
</div>

<img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
<?php
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
</div>
</div>
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
    url : path + '/show_grade_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'GRADE_NAME', name: 'GRADE_NAME' },
         { data: 'GRADE_DESCRIPTION', name: 'GRADE_DESCRIPTION' },
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
    url : path + '/show_levels_datatbl',
    type : 'post',
    data : {_token: CSRF_TOKEN},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'LEVEL_NAME', name: 'LEVEL_NAME' },
         { data: 'LEVEL_DESCRIPTION', name: 'LEVEL_DESCRIPTION' },
        { data: 'action', name: 'action' }


    ]
})
}

   function deleteLeveles(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisLevel/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Level Deleted Sucessfuly');
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

function deleteGrade(id,event) {
    event.preventDefault(); // prevent form submit

    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Grade!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deletethisGrade/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Grade Deleted Sucessfuly');
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
