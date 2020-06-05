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
            <div class="neuphormic_shadow" style="padding:10px"><a class="black_anchor" href="{{ url('/show_all_tsreport') }}">
                    <i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 18px;margin-right: 20px;"></i>
                    <span class="bold_text" style="font-size: 18px;">ALL TIMESHEET</span></a>
                <i class="fa fa-close" aria-hidden="true" style="position: relative;float:right;top: 2px;font-size:20px"></i>
            </div>
        </div>
        <div class="flip-card-3D-wrapper" style="width: 100% !important;">
            <div class="columns">
                <div class="inner-column" id="flip-card">

                    <div class="flip-card-front" style="padding-top: 10px;margin-bottom: 15px;">
                        <div class="">
                            <div class="row">
                                <div class="col-md-10">
                                    {{-- <h1 class="left_border font_grey" style="float: left;">Add Client</h1> --}}
                                </div>
                                <div class="col-md-2">
                                    <button id="flip-card-btn-turn-to-back" data-tooltip="Import" class="box circle"><img src="/asset/css/zondicons/zondicons/inbox-download.svg" alt="Import" style="width: 20px;margin-right: 0px;"></button>
                                </div>
                            </div>
                            <div class="padding_20" style="padding: 0px 35px;">

                                <div class="row">

                                    <div class="col-sm-6 col-xs-12 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <label for="leavetype" class="grey">PROJECT NAME</label>
                                                    <select class="form-control" id="PROJECT_ID" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">
                                                        <option>--SELECT--</option>
                                                        <option value="0">ALL</option>
                                                        @foreach ($projectlist as $projectlists)
                                                        <option value="{{ $projectlists->PROJECT_ID }}">{{ $projectlists->PROJECT_NAME }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <label for="leavetype" class="grey">EMPLOYEES NAME</label>
                                                    <select class="form-control" id="USER_ID" style="height: calc(2.25rem + 2px);border: 1px solid #cecece !important;padding: 5px !important;">
                                                        <option>--SELECT--</option>
                                                        <option value="0">ALL</option>
                                                        @foreach ($usernamelist as $usernamelists)
                                                        <option value="{{ $usernamelists->userId }}">{{ $usernamelists->username }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <label for="leavetype" class="grey">FROM DATE</label>
                                                    <input class="effect-16" type="date" id="FROM_DATE" placeholder="" style="clear:both">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6">
                                                <div class="colll-3 input-effect">
                                                    <label for="leavetype" class="grey">TO DATE</label>
                                                    <input class="effect-16" type="date" id="TO_DATE" placeholder="" style="clear:both">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div style="margin: 15px 0px;">
                                    <button type="submit" class="btnn" id="submit_form" style="border: none;">EXPORT CSV</button>

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

            var PROJECT_ID = $("#PROJECT_ID").val();
            var USER_ID = $("#USER_ID").val();
            var FROM_DATE = $("#FROM_DATE").val();
            var TO_DATE = $("#TO_DATE").val();


            $.ajax({

                type: 'POST',
                url: "{{URL::to('timesheet/getcsvdata')}}",
                cache: false,
                data: {
                    'PROJECT_ID': PROJECT_ID,
                    'USER_ID': USER_ID,
                    'FROM_DATE': FROM_DATE,
                    'TO_DATE': TO_DATE,
                    '_token': "{{csrf_token()}}"

                },
                success: function(data) {
                    // console.log(data)
                    var obj = JSON.parse(data);
                    // console.log("OBje", obj);
                    var csvarry = [];
                    csvarry.push(obj['data'][0]);

                    for (let i = 0; i < obj['data'][1].length; i++) {
                        csvarry.push(obj['data'][1][i]);
                    }
                    // console.log("csvarry", csvarry);
                    exportToCsv('timesheet_report.csv', csvarry)


                }
            });

        });
    });

    function exportToCsv(filename, rows) {

        var processRow = function(row) {
            var finalVal = '';
            for (var j = 0; j < row.length; j++) {
                var innerValue = row[j] === null ? '' : row[j].toString();
                if (row[j] instanceof Date) {
                    innerValue = row[j].toLocaleString();
                };
                var result = innerValue.replace(/"/g, '""');
                if (result.search(/("|,|\n)/g) >= 0)
                    result = '"' + result + '"';
                if (j > 0)
                    finalVal += ',';
                finalVal += result;
            }
            return finalVal + '\n';
        };

        var csvFile = '';
        for (var i = 0; i < rows.length; i++) {
            csvFile += processRow(rows[i]);
        }

        var blob = new Blob([csvFile], {
            type: 'text/csv;charset=utf-8;'
        });

        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(blob, filename);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) { // feature detection
                // Browsers that support HTML5 download attribute
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

    }
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
