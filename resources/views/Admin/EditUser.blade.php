@extends('Layout.app')
@section('content')
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow" style="padding:10px"><i class="fa fa-chevron-left" aria-hidden="true"
                    style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">Edit User<?php  print_r($shifts);?></span><i class="fa fa-close" aria-hidden="true"
                    style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
        </div>
        <div class="flip-card-3D-wrapper" style="width: 45% !important;">
            <div class="columns">
                <div class="inner-column" id="flip-card">
                    <div class="flip-card-front" style="padding-top: 10px;">
                        <div class="">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="left_border font_grey" style="float: left;">EMPLOYEE ID :->
                                        <?php print_r($details['EMPLOYEE_ID']);?></h1>
                                </div>
                                <div class="col-md-2">
                                    <button id="flip-card-btn-turn-to-back" data-tooltip="Import"
                                        class="box circle"><img src="/asset/css/zondicons/zondicons/inbox-download.svg"
                                            alt="Import" style="width: 20px;margin-right: 0px;"></button>
                                </div>
                            </div>
                            <div class="padding_20" style="padding: 0px 35px;">
                                <form action="#" name="client_form" id="client_form" class="form_class"
                                    data-parsley-validate autocomplete="off">
                                    <input type="hidden" id="clientuserId" value="{{$details['userId']}}">
                                    <div class="row">
                                        <div class=" col-sm-12 col-xs-12 col-md-12">
                                            <label for="" class="grey">SELECT DATE</label>
                                            <label for="datepicker" style="width: 100%;margin-bottom: 30px;">
                                                <input type="text" class="effect-16" id="datepicker" autocomplete="off"
                                                    required="" data-parsley-trigger="change">
                                            </label>
                                            {{-- data-parsley-errors-container=".errorsdate" --}}
                                            {{-- <span class="errorsdate"></span> --}}
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="functions" required="">
                                                        <option value="">Select Functions</option>
                                                        <?php
                                             $functionslength = count($functions);
                                             $selectedfunction = $details['FUNCTION_NAME_ID'];
                                            for($m = 0 ; $m < $functionslength; $m++) {
                                                ?>
                                                        <option value={{$functions[$m]->FUNCTION_ID}}
                                                            <?php if ($functions[$m]->FUNCTION_ID == $selectedfunction) { echo 'selected'; }?>>
                                                            <?php echo $functions[$m]->FUNCTION_NAME?></option>

                                                        <?php
                                            }
                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group select_2">
                                                    <select class="form-control" id="departmens" required="">
                                                        <option value="">Select Department</option>
                                                        <?php
                                                        // print_r($depatments);
                                                        $countdepatments = count($depatments);
                                                        $selecteddepartment = $details['DEPARTMENTS_ID'];
                                                        for($k = 0 ; $k < $countdepatments; $k++) {
                                                            ?>
                                                        {{-- DEPARTMENT_ID --}}
                                                        <option value="{{$depatments[$k]->DEPARTMENT_ID}}" <?php if ($depatments[$k]->DEPARTMENT_ID == $selecteddepartment) {
                                                                echo 'selected';
                                                            }?>><?php echo $depatments[$k]->DEPARTMENT_NAME?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="gradeorlevel" required="">
                                                        <option value="">Select {{$types}}</option>
                                                        <?php
                                                        $desigantionslength = count($finaldata);
                                                        $selectedGradeorlevel = $details['GRADEORLEVEL_ID'];
                                                        for($v = 0 ; $v < $desigantionslength; $v++) {
                                                            $value = $types . '_' . $finaldata[$v]['Id']
                                                            ?>
                                                        <option value="{{$value}}>" <?php if ($value == $selectedGradeorlevel) {
                                                                echo 'selected';
                                                            }?>>
                                                            {{$finaldata[$v]['Name']}}
                                                        </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="designation" required="">
                                                        <option value="">Select Desginations</option>
                                                        <?php
                                             $desigantionslength = count($desigantions);
                                             $selectedDESIGNATIONID = $details['DESIGNATION_ID'];

                                            for($l = 0 ; $l < $desigantionslength; $l++) {
                                                ?>
                                                        <option value={{$desigantions[$l]->DESIGNATION_ID}} <?php if ($desigantions[$l]->DESIGNATION_ID== $selectedDESIGNATIONID) {
                                                            echo 'selected';
                                                        }?>>
                                                            <?php echo $desigantions[$l]->DESGINATION_NAME?></option>

                                                        <?php
                                            }
                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="">
                                                <select class="js-example-basic-multiple" name="roles[]"
                                                    multiple="multiple" id="roles" data-parsley-trigger="change"
                                                    required="required">
                                                    <?php
                                                    $length = count($roles);
                                                    $assinroles = explode(",", $details['master_roleId']);
                                                    for($i = 0 ; $i < $length; $i ++) {
                                                       ?>
                                                    <option value={{$roles[$i]->MASTER_ROLE_ID}} <?php if (in_array($roles[$i]->MASTER_ROLE_ID, $assinroles))
                                                       {
                                                           echo 'selected';
                                                       }
                                                       ?>><?php echo $roles[$i]->MASTER_ROLE_NAME?></option>
                                                    <?php
                                                    }
                                                   ?>
                                                </select>
                                                <span class="focus-border"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="employetype" required="">
                                                        <option value="">Select Employee Type</option>
                                                        <?php
                                                        $selectedEMPLOYETYPE = $details['EMPLOYE_TYPE'];
                                                        ?>
                                                        <option value="Permanent" <?php if ("Permanent" == $selectedEMPLOYETYPE) {
                                                            echo 'selected';
                                                        }?>>Permanent</option>
                                                        <option value="Contractual" <?php if ("Contractual" == $selectedEMPLOYETYPE) {
                                                            echo 'selected';
                                                        }?>>Contractual</option>
                                                        <option value="Freelancer" <?php if ("Freelancer" == $selectedEMPLOYETYPE) {
                                                            echo 'selected';
                                                        }?>>Freelancer</option>
                                                        <option value="Intern" <?php if ("Intern" == $selectedEMPLOYETYPE) {
                                                            echo 'selected';
                                                        }?>>Intern</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="shifts">
                                                        <option value="">Select Shifts</option>
                                                        <?php
                                                        $shiftslength = count($shifts);
                                                        $selectedSHIFTID = $details['SHIFT_ID'];
                                                        for($q = 0 ; $q < $shiftslength; $q++) {?>
                                                        <option value={{$shifts[$q]->SHIFT_ID}} <?php if ($shifts[$q]->SHIFT_ID == $selectedSHIFTID) {
                                                            echo 'selected';
                                                        }?>>
                                                            <?php echo $shifts[$q]->SHIFT_NAME?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input class="effect-16" type="text" placeholder="" style="clear:both"
                                                    id="username" name="username" data-parsley-trigger="blur"
                                                    required="" data-parsley-errors-container=".errorsusername"
                                                    value="{{$details['username']}}">
                                                <label>User Name</label>
                                                <span class="errorsusername"></span>

                                            </div>
                                            <div class="colll-3 input-effect">
                                                <input type="email" class="effect-16" id="email" placeholder=""
                                                    style="clear:both" name="email" autocomplete="off"
                                                    data-parsley-type="email" data-parsley-trigger="blur" required=""
                                                    data-parsley-errors-container=".erorsemail"
                                                    value="{{$details['emailId']}}">
                                                <label>User Email</label>
                                                <span class="erorsemail"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="companyassined"
                                                        required="">
                                                        <option value="">Select Company</option>
                                                        <?php
                                             $clientslength = count($clients);
                                             $selectedADMINCLIENT = $details['ADMINCLIENT_ID'];

                                            for($z = 0 ; $z < $clientslength; $z++) {
                                                ?>
                                                        <option value={{$clients[$z]->ADMIN_CLIENT_ID}} <?php if ($clients[$z]->ADMIN_CLIENT_ID== $selectedADMINCLIENT) {
                                                            echo 'selected';
                                                        }?>>
                                                            <?php echo $clients[$z]->CLIENT_PREFIX?></option>

                                                        <?php
                                            }
                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="">
                                                <select class="js-example-basic-multiple" name="reportingmanger[]"
                                                    multiple="multiple" id="reportingmanger" required="">
                                                    <?php
                                                    $length = count($users);
                                                    $assinmanagers = explode(",", $details['REPORTING_MANGERS']);
                                                    for($j = 0 ; $j < $length; $j++) {
                                                        ?>
                                                    <option value={{$users[$j]->userId}} <?php if (in_array($users[$j]->userId, $assinmanagers))
                                                        {
                                                            echo 'selected';
                                                        }
                                                        ?>>
                                                        <?php echo $users[$j]->username?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="focus-border"></span>
                                            </div>
                                            <div class="colll-3 input-effect">
                                                <div class="form-group">
                                                    <select class="form-control select_2" id="primaryreportingmangers"
                                                        required="">
                                                        <option value="">Select Primary Manger</option>
                                                        <?php
                                                        $countallmanger = count($allmanger);$selectedPRIMARYMANGER = $details['PRIMARY_MANGER'];
                                                        for ($n=0; $n < $countallmanger; $n++) {
                                                            ?>
                                                        <option value="{{$allmanger[$n]->userId}}" <?php if ($allmanger[$n]->userId == $selectedPRIMARYMANGER) {
                                                                echo 'selected';
                                                            }?>>{{$allmanger[$n]->username}}</option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>




                                            <div class="colll-3 input-effect">
                                                <input type="password" class="effect-16" id="pwd" placeholder=""
                                                    style="clear:both" name="pwd" autocomplete="new-password"
                                                    data-parsley-trigger="blur" required=""
                                                    data-parsley-errors-container=".errorspassword" value="{{$details['passwords']}}">
                                                <label>Password</label>
                                                <span class="errorspassword"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 15px 0px;">
                                        <button type="button" name="submit_id" id="btn_id" class="btnn"
                                            style="border: none;">Submit</button>
                                        <img src="../asset/images/pageloader.gif" id="loading-image"
                                            style="display:none; width: 40px;">
                                        {{-- <button type="submit" class="btnn" style="border: none;">Submit</button> --}}
                                        {{-- <a href="/Superadmin/my_account" class="btnn">My Account</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card-back">
                        <div class="">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="left_border font_grey" style="float: left;">Import Client</h1>
                                </div>
                                <div class="col-md-2">
                                    <button id="flip-card-btn-turn-to-front" data-tooltip="Entry Form"
                                        class="box circle"><img src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                                            alt="Import" style="width: 20px;margin-right: 0px;"></button>
                                </div>
                            </div>
                            <br>
                            <div style="text-align: -webkit-center;">
                                <form action="#">
                                    <h4>Choose Csv file</h4>
                                    <div class="input-file-container">
                                        <input class="input-file" id="my-file" type="file">
                                        <label tabindex="0" for="my-file" class="input-file-trigger">Select a
                                            file...</label>
                                    </div>
                                    <p class="file-return"></p>
                                    <br>
                                    <div style="margin: 15px 0px;">
                                        <button type="submit" class="btnn" style="border: none;">Submit</button>
                                        {{-- <a href="/Superadmin/my_account" class="btnn">My Account</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div >

            </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
<script src="/asset/js/Jquery_ui_1_12_1.min.js"></script>
<script>
    $(document).ready(function() {
     var getDate = "<?php print($details['DOJ']);?>";
     var Val = $("#employetype").val();
    if(Val == 'Freelancer') {
         $("#shifts").prop('required',false);
    } else {
        $("#shifts").prop('required',true);
        // $('#shifts').show();
    }
     var date = new Date(getDate.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
     // console.log(getDate);
    date.setDate(date.getDate());
     $(function() {
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast"
        }).datepicker("setDate", date);
    });

    $('.js-example-basic-multiple').select2();
     $("#roles").select2({
    placeholder: "Roles",
    allowClear: true,
    width:"100%"
});
$("#reportingmanger").select2({
    placeholder: "Reporting Mangers",
    allowClear: true,
    width:"100%"
})
$('#employetype').on('change', function (e) {
    var Val = $(this).val();
    if(Val == 'Freelancer') {
         $("#shifts").prop('required',false);
    } else {
        $("#shifts").prop('required',true);
        // $('#shifts').show();
    }
});
$('#functions').on('change', function (e) {
    var Val = $(this).val();
    if(Val != null || Val == '') {
     // console.log(Val);

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
     $.ajax({
         url: '/getDepartments',
                type: 'POST',
                data: {
                    functions: $(this).val()
                    },
                    success: function(data) {
                        console.log('Data', data);
                       // return;
                        console.log('Length', data.length);
                        var lengths = data.length
                        $('#departmens').empty();
                        $('#departmens').append(`<option value="">Select Department</option>`);
                        for(let j = 0; j < lengths ; j++){

                            $('#departmens').append(`<option value="`+ data[j].DEPARTMENT_ID + `">`+ data[j].DEPARTMENT_NAME + ` </option>`);
                        }
                    }
            })
    }

});
$('#reportingmanger').on('change', function (e) {
    var Val = $(this).val();
    if(Val != null || Val == '') {
     // console.log(Val);

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
     $.ajax({
         url: '/getUsers',
                type: 'POST',
                data: {
                    roles: $(this).val()
                    },
                    success: function(data) {
                        console.log('Data', data);
                        console.log('Length', data.length);
                        var lengths = data.length
                        $('#primaryreportingmangers').empty();
                        $('#primaryreportingmangers').append(`<option value="">Select Primary Manger</option>`);
                        for(let j = 0; j < lengths ; j++){
                            console.log(data[j].username);
                            $('#primaryreportingmangers').append(`<option value="`+ data[j].userId + `">`+ data[j].username + ` </option>`);
                        }
                    }
            })
    }

});
     $('#loading-image').bind('ajaxStart', function() {
         $(this).show();
	}).bind('ajaxStop', function() {
		$(this).hide();
	});
    $('input').parsley();
    $('#btn_id').click(function(event) {
        event.preventDefault();
        // Validate all input fields.
        var isValid = true;
        $('#client_form').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        // var roles = $("#roles").val();
        // var username =  $('#username').val();
        // var reportingmanger = $('#reportingmanger').val()
        // var email = $("#email").val()
        // var pwd = $("#pwd").val()
        // var clientuserId = $("#clientuserId").val()
        if (isValid) {
            $('#loading-image').show();
            var data = $("#datepicker").val();
            var arr = data.split('-');
            var doj = arr[2] + '-' + arr[1] + '-' + arr[0]
            var Val = $("#employetype").val();
            var Shifts = '';
            if(Val == 'Freelancer') {
                Shifts = 0
                // Shiftsprop('required',false);
            } else {
                Shifts = $("#shifts").val();
                // $("#shifts").prop('required',true);
            }
            // console.log(doj);
            // return
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/updateUser',
                type: 'POST',
                data: {
                    roles: $("#roles").val(),
                    username: $('#username').val(),
                    reportingmanger: $('#reportingmanger').val(),
                    primarymanger: $('#primaryreportingmangers').val(),
                    email: $('#email').val(),
                    pwd: $('#pwd').val(),
                    departmens: $('#departmens').val(),
                    functions: $('#functions').val(),
                    doj: doj,
                    employetype: $('#employetype').val(),
                    designation:  $('#designation').val(),
                    companyassined: $('#companyassined').val(),
                    gradeorlevel : $('#gradeorlevel').val(),
                    clientuserId: $('#clientuserId').val(),
                    employeeShifts : Shifts,
                    },
                    success: function(data) {
                        console.log('Data', data);
                        //return;
                         var response = data.trim();
                         if(response == 'Erorr'){
                             alert('Something Went Wrong')
                         } else if(response == 'Already') {
                              alert('Email ID Already Exits');
                              $('#email').val('');
                         } else {
                             alert('User Updated Sucessfuly');
                             // window.location.href = 'SuperAdmin/superadmindahboard';
                             var url = '{{ route("Admin/User") }}';
                             window.location.href = url;
                             //window.location.href ='Superadmin/client'
                         }
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
      }
    })
 });
</script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
<script>
    document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");

button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
fileInput.addEventListener( "change", function( event ) {
    the_return.innerHTML = this.value;
});
</script>
<script>
    $(window).load(function(){
        var inputs = document.getElementsByTagName('input'),
        empty = 0;

    for (var i = 1, len = inputs.length - 1; i < len; i++) {
        empty += !inputs[i].value;
        var tag = inputs[i];
        if(inputs[i].value != '') {
            var id = $(tag).attr('id');
            $('#' + id).addClass("has-content");
        } else {
            var id = $(tag).attr('id');
            $('#' + id).removeClass("has-content");
        }
    }
	});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function(event) {

document.getElementById('flip-card-btn-turn-to-back').style.visibility = 'visible';
document.getElementById('flip-card-btn-turn-to-front').style.visibility = 'visible';

document.getElementById('flip-card-btn-turn-to-back').onclick = function() {
document.getElementById('flip-card').classList.toggle('do-flip');
};

document.getElementById('flip-card-btn-turn-to-front').onclick = function() {
document.getElementById('flip-card').classList.toggle('do-flip');
};

});
</script>
@endsection
