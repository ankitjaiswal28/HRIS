@extends('Layout.app')
@section('content')
<div class="new-wrapper">

    <div id="main">
<div class="main_card">
    <div class="neuphormic_shadow" style="height: 55px;padding: 15px 10px;position: relative;">
        <div style="float:left;">
            <span id="checkout"> <a class="checkout_btn" id="popup-btnn" style="cursor: pointer;color: white;">Check Out
                    <span class="clock"></span></a>
                <span style="padding: 10px;">00:00 Hr</span></span>
            <span id="checkin"><a class="btnn checkin_btn" style="cursor: pointer;color: white;">Check In <span
                        class="clock_stop"></span></a></span>
        </div>
        <div style="float:right;">
            <a href="" class="btnn"><img src="/asset/css/zondicons/zondicons/date-add.svg" class="edit_icon"
                    style="-webkit-filter: invert(1);">Applys Leave</a> <a class="btnn a_btn" id="popup-btn"><img
                    src="/asset/css/zondicons/zondicons/time.svg" class="edit_icon"
                    style="-webkit-filter: invert(1);">Timesheet</a>
        </div>
    </div>
</div>
{{-- <div class="main_card">
    <div class="row" style="padding: 15px 10px;">
        <div class="col-md-6">
            <div>
                <span id="checkout"> <a class="checkout_btn" style="cursor: pointer;color: white;">Check Out <span
                            class="clock"></span></a><span style="padding: 10px;">00:00 Hr</span></span>
                <span id="checkin"><a class="btnn checkin_btn" style="cursor: pointer;color: white;">Check In <span
                            class="clock_stop"></span></a></span>
            </div>
        </div>
        <div class="col-md-6">
            <div style="float:right">
                <a href="" class="btnn"><img src="/asset/css/zondicons/zondicons/date-add.svg" class="edit_icon"
                        style="-webkit-filter: invert(1);">Apply Leave</a> <a class="btnn a_btn" id="popup-btn"><img
                        src="/asset/css/zondicons/zondicons/time.svg" class="edit_icon"
                        style="-webkit-filter: invert(1);">Timesheet</a>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid">
    <div class="row no_left_margin">
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>New Hire
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>Timesheet
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect System
                                        Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>New Hire
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>New Hire
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>New Hire
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="widget">
                <div class="widget-header dcard neuphormic_shadow">
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>New Hire
                        <span class="d_count">25</span>
                    </div>
                    <div class="divcard_hdr">
                        <table id="example" class="table table-hover" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="padding_10_15 no_border">System Architect System Architect</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="no_border padding_10_15">Accountant</td>
                                    <td class="grey_font no_border icon_show" style="float: right;"><a href=""><img
                                                src="/asset/css/zondicons/zondicons/edit-pencil.svg" class="edit_icon"
                                                alt=""></a><a href=""><img
                                                src="/asset/css/zondicons/zondicons/close.svg" class="cross_icon"
                                                alt=""></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">View All</div>
                </div>
                <div class="widget-content">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- //////////////////////////////////             MODEL              /////////////////////////// --}}
<div id="popup-wrapper" class="popup-container">
    <div class="popup-content">
        <span id="close">&times;</span>
        <h3 class="heading">Time-Sheet</h3>
        <div class="row">
            <div class="col-md-6">
                <h6 class="text_title">Project Name</h6>
            </div>
            <div class="col-md-6">
                <h6><input type="text" class="input_text" name="" id=""></h6>
            </div>
            <div class="col-md-6">
                <h6 class="text_title">Project Name</h6>
            </div>
            <div class="col-md-6">
                <h6><input type="text" class="input_text" name="" id=""></h6>
            </div>
            <div class="col-md-6">
                <h6 class="text_title">Project Name</h6>
            </div>
            <div class="col-md-6">
                <h6><input type="text" class="input_text" name="" id=""></h6>
            </div>
        </div>
        <div>
            <div id="inline-popups">
                <a href="#error_popup" data-effect="mfp-move-from-top">Error</a>
                <a href="#test-popup" data-effect="mfp-move-from-top">Move from top</a>
            </div>
            <div id="error_popup" class="white-popup mfp-with-anim mfp-hide  padd_15">
                eorrorklsdfklsdjfklsdjfklsdfkjsdkfjklsdj
                <button title="Close (Esc)" type="button" class="mfp-close top_6">×</button>
            </div>
            <div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
                sfsdfsdfsdfsdfsdfsdfkjksdlfjkjsdkfjklsjdfkljsdklfjksdjfkjsdkfjksdjfkjsdkfljklsdfjkljsdfkljsdflkjsdflkjsdflkjsdfljksdfkljsdfkljsdflkjsdfljksdflkjsdfkljsdfljsflkjsdfkljsdfkl
                klsdfjljf
                sdfkklsdjfkljjkjklklj
            </div>
        </div>
    </div>
</div>
<div id="popup-wrapperr" class="popup-container">
    <div class="popup-content">
        <span id="close">&times;</span>
        <h3 class="heading">Check-Out</h3>
        <a href="" class="btnn"><img src="/asset/css/zondicons/zondicons/date-add.svg" class="edit_icon"
                style="-webkit-filter: invert(1);">Stay</a> <a class="btnn a_btn" id="popup-btn"><img
                src="/asset/css/zondicons/zondicons/time.svg" class="edit_icon"
                style="-webkit-filter: invert(1);">Leave</a>
    </div>
</div></div></div>
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////// --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
<script src="/asset/js/jquery_213.min.js"></script>
<script src="/asset/js/magnific-popup.js"></script>
<script>
    ////////////////////        for top popup      ///////////////////////
// Inline popups
$('#inline-popups').magnificPopup({
  delegate: 'a',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});
/////////////////////////for middle popup////////////////////////////////
var popup = document.getElementById('popup-wrapper');
var btn = document.getElementById("popup-btn");
var span = document.getElementById("close");
btn.onclick = function() {
    popup.classList.add('show');
}
span.onclick = function() {
    popup.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == popup) {
        popup.classList.remove('show');
    }
}
var popupp = document.getElementById('popup-wrapperr');
var btnn = document.getElementById("popup-btnn");
var span = document.getElementById("close");
btnn.onclick = function() {
    popupp.classList.add('show');
}
span.onclick = function() {
    popupp.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == popupp) {
        popupp.classList.remove('show');
    }
}
</script>

<script>
    $(document).ready(function(){
             $("#checkout").hide();
          $("#checkin").click(function(){
            $("#checkin").hide();
            $("#checkout").show();
          });
          $("#checkout").click(function(){
            //    $("#checkin").show();
            // $("#checkout").hide();
          });
        });
</script>
<script>
    const HOURHAND = document.querySelector("#hour");
const MINUTEHAND = document.querySelector("#minute");
const SECONDHAND = document.querySelector("#second");

var date = new Date();
let hr = date.getHours();
let min = date.getMinutes();
let sec = date.getSeconds();

let hrPosition = (hr*360/12) + (min*(360/60)/12);
let minPosition = (min*360/60) + (sec*(360/60)/60);
let secPosition = sec*360/60;


function runTheClock() {

  hrPosition = hrPosition + (3/360);
  minPosition = minPosition + (6/60);
  secPosition = secPosition + 6;

  /*HOURHAND.style.transform = "rotate(" + hrPosition + "deg)";
  MINUTEHAND.style.transform = "rotate(" + minPosition + "deg)";
  SECONDHAND.style.transform = "rotate(" + secPosition + "deg)";*/
}


var interval = setInterval(runTheClock, 1000);
</script>
@endsection
