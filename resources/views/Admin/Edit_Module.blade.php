@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/Superadmin/role') }}"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">Add Module<?php print_r($AssinedUser); ?></span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="container-fluid">
    <div class="row no_left_margin ">
    <input type="hidden" name="roleId" id="roleId" value="{{$id}}">
    {{-- <input type="hidden" name="clientId" id="clientId" value="{{$getDetails['id']}}"> --}}
    <?php
    $AllID = [];
    $length = count($getDetails);
    for($i = 0 ; $i < $length; $i++) {
        $AllID[] = $getDetails[$i]->moduleId;
        ?>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;"><?php echo $getDetails[$i]->moduleName;?></h5>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="moduleId" id = "<?php echo $getDetails[$i]->moduleId;?>" value ={{$getDetails[$i]->moduleId}}>
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    $AssginModuleId = $AssinedUser;
    $getmoduleIds = implode(",",$AllID);
    ?>
    </div>
    <div style="position: relative;width: auto;margin: 0 auto;">
            <button type="button" class="btnn" id="submit_form" style="border: none;width: 150px;">Submit</button>
             <img src="../../asset/images/pageloader.gif" id="loading-image" style=" display:none;width: 40px;">
        </div>
</div></div></div>
<script src="/asset/js/jquery.min.js"></script>
<script>
var getmoduleIds = "<?php print_r($getmoduleIds);?>";
var AssinedUser = "<?php echo $AssginModuleId;?>" ;
if(AssinedUser != '') {
    var AssginModuleId = AssinedUser.split(',');
    for(let m = 0 ; m < AssginModuleId.length ; m++ ) {
         var assignedId = AssginModuleId[m];
         $("#" + assignedId).prop('checked', true);
    }

}
$('#submit_form').click(function(event) {
    event.preventDefault();
    $('#loading-image').show();
    var allMOduleId = [];
    var roleId = $('#roleId').val();
    $("input:checkbox[name=moduleId]:checked").each(function(){
        allMOduleId.push($(this).val());
    });
    // console.log(allMOduleId);
   // return
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/updateAdminModules',
                type: 'POST',
                data: {
                    roleId: roleId,
                    modulename: allMOduleId,
                    },
                    success: function(data) {
                        console.log(data);
                          var response = data.trim();
                          if(response == 'Done') {
                             alert('Module Assined Sucessfuly');
                             var url = '{{ route("Admin/role") }}';
                              window.location.href = url;
                         } else {
                             alert('Something Went Wrong')
                         }
                        // console.log('Data', data)
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
    // console.log(yourArray);
})

/*
// **************************** Please Do Not Delete This Module *****************  //
var MOduleIDArray = getmoduleIds.split(',')
console.log(MOduleIDArray);
for(let j = 0 ; j < MOduleIDArray.length ; j++ ) {
    var Id = MOduleIDArray[j];
    // $("#" + Id).prop('checked', true);
    // console.log('Hiiii');
}
*/
</script>
@endsection
