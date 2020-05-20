@extends('Layout.app')
@section('content')
<div class="main_card">
    <div class="neuphormic_shadow" style="height: 55px;padding: 15px 10px;position: relative;">
        <div style="float:left;">
            <span id="checkout"> <a class="checkout_btn" id="popup-btnn" style="cursor: pointer;color: white;">Check Out
                    {{-- <span class="clock"></span>--}}</a>
                     {{-- <span id="sw_h">00</span>:
    <span id="sw_m">00</span>:
    <span id="sw_s">00</span>:
    <span id="sw_ms">00</span> --}}
                    {{-- <span  id="sw_h">00</span>:
                     <span id="sw_m">00</span>:
                 <span id="sw_s" class="foo">00</span>:
                 <span id="sw_ms">00</span> --}}
                 {{-- <span id="resume"><a class="btnn checkin_btn" style="cursor: pointer;color: white;">Resume<span
                        class="clock_stop"></span></a> --}}

                </span>
                 <span id="resume" style="padding: 10px;"><a class="btnn checkin_btn" style="cursor: pointer;color: white;">Resume<span
                        class="clock_stop"></span></a></span>
            <span id="checkin"><a class="btnn checkin_btn" style="cursor: pointer;color: white;">Check In <span
                        class="clock_stop"></span></a></span>
        </div>
        <div style="float:right;">
            <a href="/applyleave" class="btnn"><img src="/asset/css/zondicons/zondicons/date-add.svg" class="edit_icon"
                    style="-webkit-filter: invert(1);">Apply Leave</a> <a href="/timesheet/showdata" class="btnn a_btn" ><img
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
                    <div class="card_hdr"><span class="round_dot_1"></span><span class="round_dot_2"></span>Employee Details
                        <span class="d_count">25</span>
                    </div>
                    <div class="bg-style">
                        {{-- <div class="wrapper"> --}}
                            <div class="row">
                                <div class="col-md-10 offset-md-2" style="margin-top: 30px;">
                                    <div class="counter" data-cp-percentage="{{$percentage}}" data-cp-color="#00bfeb">
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
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
        <button class="btnn"><img src="/asset/css/zondicons/zondicons/date-add.svg" class="edit_icon"
                style="-webkit-filter: invert(1);">Stay</button> <button class="btnn a_btn" id="leave"><img
                src="/asset/css/zondicons/zondicons/time.svg" class="edit_icon"
                style="-webkit-filter: invert(1);">Leave</button>
    </div>
</div>
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////// --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
{{-- <script src="/asset/js/jquery_213.min.js"></script> --}}
{{-- <script src="/asset/js/magnific-popup.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

var circleProgress = (function(selector) {
  var wrapper = document.querySelectorAll(selector);
  Array.prototype.forEach.call(wrapper, function(wrapper, i) {
    var wrapperWidth,
      wrapperHeight,
      percent,
      innerHTML,
      context,
      lineWidth,
      centerX,
      centerY,
      radius,
      newPercent,
      speed,
      from,
      to,
      duration,
      start,
      strokeStyle,
      text;

    var getValues = function() {
      wrapperWidth = parseInt(window.getComputedStyle(wrapper).width);
      wrapperHeight = wrapperWidth;
      percent = wrapper.getAttribute('data-cp-percentage');
      innerHTML = '<span class="percentage"><strong>' + percent + '</strong> %</span><canvas class="circleProgressCanvas" width="' + (wrapperWidth * 2) + '" height="' + wrapperHeight * 2 + '"></canvas>';
      wrapper.innerHTML = innerHTML;
      text = wrapper.querySelector(".percentage");
      canvas = wrapper.querySelector(".circleProgressCanvas");
      wrapper.style.height = canvas.style.width = canvas.style.height = wrapperWidth + "px";
      context = canvas.getContext('2d');
      centerX = canvas.width / 2;
      centerY = canvas.height / 2;
      newPercent = 0;
      speed = 1;
      from = 0;
      to = percent;
      duration = 1000;
      lineWidth = 25;
      radius = canvas.width / 2 - lineWidth;
      strokeStyle = wrapper.getAttribute('data-cp-color');
      start = new Date().getTime();
    };

    function animate() {
      requestAnimationFrame(animate);
      var time = new Date().getTime() - start;
      if (time <= duration) {
        var x = easeInOutQuart(time, from, to - from, duration);
        newPercent = x;
        text.innerHTML = Math.round(newPercent) + " %";
        drawArc();
      }
    }

    function drawArc() {
      var circleStart = 1.5 * Math.PI;
      var circleEnd = circleStart + (newPercent / 50) * Math.PI;
      context.clearRect(0, 0, canvas.width, canvas.height);
      context.beginPath();
      context.arc(centerX, centerY, radius, circleStart, 4 * Math.PI, false);
      context.lineWidth = lineWidth;
      context.strokeStyle = "#ddd";
      context.stroke();
      context.beginPath();
      context.arc(centerX, centerY, radius, circleStart, circleEnd, false);
      context.lineWidth = lineWidth;
      context.strokeStyle = strokeStyle;
      context.stroke();

    }
    var update = function() {
      getValues();
      animate();
    }
    update();

    var btnUpdate = document.querySelectorAll(".btn-update")[0];
    /*btnUpdate.addEventListener("click", function() {
      wrapper.setAttribute("data-cp-percentage", Math.round(getRandom(5, 95)));
      update();
    });*/
    wrapper.addEventListener("click", function() {
      update();
    });

    var resizeTimer;
    window.addEventListener("resize", function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        clearTimeout(resizeTimer);
        start = new Date().getTime();
        update();
      }, 250);
    });
  });

  //
  // http://easings.net/#easeInOutQuart
  //  t: current time
  //  b: beginning value
  //  c: change in value
  //  d: duration
  //
  function easeInOutQuart(t, b, c, d) {
    if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
    return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
  }

});

circleProgress('.counter');

// Gibt eine Zufallszahl zwischen min (inklusive) und max (exklusive) zurück
function getRandom(min, max) {
  return Math.random() * (max - min) + min;
}
});

</script>
<script>
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
    // alert('jiiii')
    popupp.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target == popupp) {
        popupp.classList.remove('show');
    }
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{-- <script src="/js/stopwatch.js"></script> --}}
<script>
/*
var d = new Date();
// document.getElementById("demo").innerHTML = d.getSeconds();
document.getElementById("demo").innerHTML = d.getDate() + '/' + d.getMonth() + '/' + d.getFullYear() + ' ' +d.getHours()+':'+ d.getMinutes() + ':' +d.getSeconds() +':'+ d.getMilliseconds();
*/
    $(document).ready(function(){
        var userId = "<?php echo session('userid');?>";
        //console.log('UserId', userId);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
        url: '/getatendence',
        type: 'POST',
        data: {
            userId: userId
        },
        success: function(data) {
            console.log(data);
           // return;
            if(data === 'IN') {
                $('#resume').hide();
                $("#checkout").show();
                $("#checkin").hide();
            } else if(data === 'OUT'){
                $('#resume').hide();
                $("#checkout").hide();
                $("#checkin").hide();
            } else {
                $('#resume').hide();
                $("#checkout").hide();
                $("#checkin").show();
            }
        },
    })


          $("#checkin").click(function(){
            AddAtendence();
          });
          $("#checkout").click(function(){
               $("#sw_pause").click();
               $('#resume').hide();
               // $("#sw_start").show();
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
$('#resume').click(function(){

 // $("#sw_start").click();
  // alert('hiiiiii')
    $("#sw_start").click();
    $('#resume').hide();
});
$('#leave').click(function(){
    LeaveAttendence();

});

function AddAtendence() {
    var today = new Date();
    var timestamp  = today.getFullYear() + '-' + today.getMonth() + '-' + today.getDate() + ' ' +today.getHours()+':'+ today.getMinutes() + ':' +today.getSeconds() ;
    // alert('fdfdf')
    //console.log(timestamp);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/addatendence',
        type: 'POST',
        data: {
            timestamp: timestamp
        },
        success: function(data) {
            console.log(data);
            // return;
            var response = data.trim();
            if(response =='Done') {
                $("#checkin").hide();
                $("#checkout").show();
                $("#sw_start").click();

               //  window.location.href = 'Admin/admindahboard';
            }else {
                alert('Some Thing Went Wrong')
            }
        },
    })
}
function LeaveAttendence() {
    var today = new Date();
    var timestamp  = today.getFullYear() + '-' + today.getMonth() + '-' + today.getDate() + ' ' +today.getHours()+':'+ today.getMinutes() + ':' +today.getSeconds() ;
    // alert('fdfdf')
    //console.log(timestamp); return;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/leaveatendence',
        type: 'POST',
        data: {
            timestamp: timestamp
        },
        success: function(data) {
            console.log(data);
             //return ;
            var response = data.trim();
            if(response =='Done') {
                location.reload();
               // $('#sw_reset').click();
                $("#checkin").show();
                $("#checkout").hide();
                $('#resume').hide();
                /*$("#checkin").hide();
                $("#checkout").show();
                $("#sw_start").click();*/
            }else {
                alert('Some Thing Went Wrong')
            }
        },
    })
}
</script>
@endsection
