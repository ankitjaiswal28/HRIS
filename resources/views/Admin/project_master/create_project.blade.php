@extends('Layout.app')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@next/dist/tailwind.css"> --}}
<style>
    input:checked+label {
        background-color: LightSeaGreen;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .dropdoen_height {
        height: calc(2.5rem + 2px);
        border: 1px solid #cecece !important;
        padding: 8px !important;
    }
</style>
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('project/showdata') }}">
                    <i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i>
                    <span class="bold_text" style="font-size: 18px;">ADD PROJECT</span></a>
                <i class="fa fa-close" aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i>
            </div>
        </div>
        <div class="flip-card-3D-wrapper" style="width: 100% !important;">
            <div class="columns">
                <div class="inner-column" id="flip-card">
                    <div class="flip-card-front" style="padding-top: 10px;margin-bottom: 15px;">
                        <div class="">
                            <div class="padding_20" style="padding: 0px 35px;">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <input class="effect-16" type="text" id="PROJECT_NAME" placeholder="" style="clear:both">
                                                    <label>Project Name</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <input class="effect-16" type="text" id="PROJECT_DESCRIPTION" placeholder="" style="clear:both">
                                                    <label>Project Description</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <input class="effect-16" type="text" id="PROJECT_TARGET_HR" placeholder="" style="clear:both">
                                                    <label>Project Target Hours</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <input class="effect-16" type="text" id="PROJECT_COST" placeholder="" style="clear:both">
                                                    <label>Project Cost</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div style="margin: 15px 0px;">
                                    <button type="submit" class="btnn" id="submit_form" style="border: none;">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
{{-- <script src="/asset/js/jquery.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $("#submit_form").click(function(e) {
            e.preventDefault();

            var PROJECT_NAME = $("#PROJECT_NAME").val();
            var PROJECT_DESCRIPTION = $("#PROJECT_DESCRIPTION").val();
            var PROJECT_TARGET_HR = $("#PROJECT_TARGET_HR").val();
            var PROJECT_COST = $("#PROJECT_COST").val();


            $.ajax({

                type: 'POST',
                url: "{{URL::to('project/addproject')}}",
                cache: false,
                data: {
                    'PROJECT_NAME': PROJECT_NAME,
                    'PROJECT_DESCRIPTION': PROJECT_DESCRIPTION,
                    'PROJECT_TARGET_HR': PROJECT_TARGET_HR,
                    'PROJECT_COST': PROJECT_COST,
                    '_token': "{{csrf_token()}}"

                },
                success: function(data) {
                    console.log('Data', data)
                    //  return;
                    var response = data.trim();
                    if (response == 'Done') {
                        alert('Project Created Successfully.')
                        var url = '{{ route("project/showdata") }}';
                        window.location.href = url;
                    } else if (response == 'Already') {
                        alert('Project Name Already Exits');
                        $('#PROJECT_NAME').val('');
                    } else {
                        alert('Something Went Wrong')
                    }
                }
            });

        });
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#role_icon").change(function() {
        readURL(this);
    });
</script>
<script>
    // document.querySelector("html").classList.add('js');

    // var fileInput = document.querySelector(".input-file"),
    //     button = document.querySelector(".input-file-trigger"),
    //     the_return = document.querySelector(".file-return");

    // button.addEventListener("keydown", function(event) {
    //     if (event.keyCode == 13 || event.keyCode == 32) {
    //         fileInput.focus();
    //     }
    // });
    // button.addEventListener("click", function(event) {
    //     fileInput.focus();
    //     return false;
    // });
    // fileInput.addEventListener("change", function(event) {
    //     the_return.innerHTML = this.value;
    // });
</script>
<script>
    $(window).load(function() {
        $(".colll-3 input").val("");

        $(".input-effect input").focusout(function() {
            if ($(this).val() != "") {
                $(this).addClass("has-content");
            } else {
                $(this).removeClass("has-content");
            }
        })
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
