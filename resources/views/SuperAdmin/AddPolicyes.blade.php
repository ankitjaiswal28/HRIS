@extends('Layout.app')
@section('content')
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/Superadmin/role') }}"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;"><?php print_r($clinetDetais['COMPANY_NAME']); ?></span></a><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<?php
$GRADEORLEVEL = $clinetDetais['GRADEORLEVEL'];
// print_r($clinetDetais['GRADEORLEVEL']);
?>
<div class="container-fluid">
<h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Grade / Levels </h5>
    <div class="row no_left_margin ">
    <input type="hidden" name="clientId" id="clientId" value="{{$clinetDetais['id']}}">
    <?php
    if($GRADEORLEVEL == '') {
        ?>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Grade</h5>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="gradeorfunction" id = "grade" value = "Grade">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Level</h5>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="gradeorfunction" id = "level" value = "Level">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">{{$GRADEORLEVEL}}</h5>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">

                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="moduleId" id = "grade" value = "Grade">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
        <?php
    }
    ?>
    </div>
    <div style="position: relative;width: auto;margin: 0 auto;">
            <button type="button" class="btnn" id="submit_form" style="border: none;width: 150px;">Submit</button>
             <img src="../../asset/images/pageloader.gif" id="loading-image" style=" display:none;width: 40px;">
        </div>
</div>
<script src="/asset/js/jquery.min.js"></script>
<script>
$('#submit_form').click(function(event) {
    event.preventDefault();
    $('#loading-image').show();
    var gradeorlevel = "<?php echo $GRADEORLEVEL;?>";
    var gradeorlevelvalue = '';
    if(gradeorlevel == '') {
        gradeorlevelvalue = $("input:checkbox[name=gradeorfunction]:checked").val()
    } else {
        gradeorlevelvalue = null
    }
    var ClientId = $('#clientId').val();
    // console.log(gradeorlevelvalue);
   /* var allMOduleId = [];
    var ClientId = $('#clientId').val();
    $("input:checkbox[name=moduleId]:checked").each(function(){
        allMOduleId.push($(this).val());
    });*/
    // return;
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/updatepoliyices',
                type: 'POST',
                data: {
                    ClientId: ClientId,
                    gradeorlevelvalue: gradeorlevelvalue,
                    },
                    success: function(data) {
                        console.log('Data' + data);
                        var response = data.trim();
                        if(response != 'Error') {
                            alert(response);
                            var url = '{{ route("SuperAdmin/Show_client") }}';
                            window.location.href = url;
                        } else {
                            alert('Something Went Worong');
                        }
                        //return;
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
