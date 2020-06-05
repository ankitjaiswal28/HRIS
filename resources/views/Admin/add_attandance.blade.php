@extends('Layout.app')
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        width: 300px !important;
        height: 35px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: -227px !important;
    }

    .select2-container--open .select2-dropdown--below {
        width: 300px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px !important;
    }

    #datepicker-container {
        position: absolute !important;
        right: 0px !important;
        left: -70px !important;
        width: 200% !important;
        top: 40px !important;
        z-index: 100 !important;

    }

    .select2-container {
        right: 270px !important;
    }

    #datepicker {
        display: inline-grid;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: -250px !important;
    }
</style>
<link rel="stylesheet" href="/asset/css/Calender.css">
<div class="new-wrapper">
    <div id="main">
        <div class="main_card">
            <div class="neuphormic_shadow fst_card">
                <div class="fst_card_cntnt">
                    <h3 class="h3_header_prt" style=""><a class="white_anchor"
                            href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline"
                                aria-hidden="true"></i></a> | <label class="ralway_font">Attendence's</label>
                    </h3>
                </div>
                {{-- <div style="position: absolute;width: 300px;right: 80px;margin-right: 15px;bottom: 10px;"> --}}

                <div style="float: right">
                    {{-- <div> --}}
                    <select class="js-select2" id="allusers">
                        <option value="All" selected>All</option>
                        <?php
                                $userlength = count($allusers);
                                for ($m = 0; $m < $userlength; $m++) { ?>
                        <option value={{$allusers[$m]->userId}}><?php echo $allusers[$m]->username ?></option>
                        <?php
                                }
                                ?>
                    </select>
                    {{-- </div> --}}
                    <div id="datepicker">
                        <button id="datepicker-button" class="btnn" style="padding-top: 7px;padding-bottom: 7px;">Open Datepicker</button>
                        <div id="datepicker-container">
                            <div class="datepicker-header">
                                <button class="datepicker-button-change" id="datepicker-previous-button"> - </button>
                                <div id="datepicker-indicator"></div>
                                <button class="datepicker-button-change" id="datepicker-next-button"> + </button>
                            </div>
                            <ul id="datepicker-week-title"></ul>
                            <div id="datepicker-body"></div>
                            <div class="datepicker-footer">
                                <span id="datepicker-selected-text"></span>
                                <button id="datepicker-clear-button">Clear</button>
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0)" onclick="SerachAttendence()" class="btnn"><i class="fa fa-search"
                            style="padding-right: 10px;" aria-hidden="true"></i>Search</a>
                    <a href="{{ url('/Admin/Create') }}" class="btnn"><i class="fa fa-plus" style="padding-right: 10px;"
                            aria-hidden="true"></i>Add Attendence</a>
                </div>
            </div>


        </div>
        <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
        <div class="margin_left_right">
            <table id="client-table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Shift Name</th>
                        <th>Assigned TO</th>
                        <th>User</th>
                        <th>In Date</th>
                        <th>Out Date</th>
                        <th>In Time</th>
                        <th>OUT Time</th>
                        <th>Added By</th>
                        <th>Total Hours</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/jquery_213.min.js"></script>
<script src="/asset/js/datatables.min.js"></script>
{{-- <script src="/asset/js/calender.js"></script> --}}
<script>
    /**
 * Constants
 */
const MONTH_NAMES = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];
const WEEKDAY_NAMES = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const DEFAULT_SELECTED_TEXT = "Select the initial and the end dates";
const DAY_TIME = 86400000;

/**
 * Variables
 */
var currentMonth = new Date().getMonth();
var currentYear = new Date().getFullYear();
var currentIndicator = null;
var selectedInitialDate = null;
var selectedEndDate = null;

/**
 * Component Elements
 */
var datepickerBody = document.getElementById("datepicker-body");
var datepickerButton = document.getElementById("datepicker-button");
var datepickerClearButton = document.getElementById("datepicker-clear-button");
var datepickerContainer = document.getElementById("datepicker-container");
var datepickerSelectedText = document.getElementById(
  "datepicker-selected-text"
);
var datepickerNextButton = document.getElementById("datepicker-next-button");
var datepickerPreviousButton = document.getElementById(
  "datepicker-previous-button"
);
var datepickerIndicator = document.getElementById("datepicker-indicator");
var datepickerWeekTitle = document.getElementById("datepicker-week-title");

/**
 * Event Listeners
 */
datepickerButton.addEventListener("click", evt => toggleDatepicker());
datepickerNextButton.addEventListener("click", evt => changeIndicator(1));
datepickerPreviousButton.addEventListener("click", evt => changeIndicator(-1));
datepickerClearButton.addEventListener("click", evt => clearSelection());
datepickerIndicator.addEventListener("click", evt => fillBody());

/**
 * Initial Conditions
 */
WEEKDAY_NAMES.forEach(day => {
  const dayTitle = document.createElement("li");
  dayTitle.innerText = day;
  datepickerWeekTitle.appendChild(dayTitle);
});
datepickerSelectedText.innerText = DEFAULT_SELECTED_TEXT;

/**
 * Enable/disable the datepicker
 */
function toggleDatepicker() {
  if (datepickerContainer.style.display === "flex") {
    datepickerContainer.style.display = "none";
  } else {
    fillMonth();
    datepickerContainer.style.display = "flex";
  }
}

/**
 * Changes the current indicator (month, year or decade).
 * @param {number} d difference
 */
function changeIndicator(d) {
  switch (currentIndicator) {
    case "year":
      currentYear += d;
      fillYear();
      break;
    case "month":
      currentMonth += d;
      fillMonth();
      break;
    case "decade":
      currentYear += d * 10;
      fillDecade();
  }
}

/**
 * Calls the function to fill the datepicker body depending on indicator.
 * @param {'month' | 'year' | 'decade'} indicator
 */
function fillBody(indicator = currentIndicator) {
  currentIndicator = indicator;
  switch (indicator) {
    case "month":
      fillYear();
      break;
    case "year":
      fillDecade();
      break;
    case "decade":
      fillYear(new Date().getFullYear());
      break;
    default:
      fillMonth(new Date());
  }
}

/**
 * Select a day, it can be inital or ender.
 * @param {Date} day
 */
function selectDay(day) {
  if (!selectedInitialDate && !selectedEndDate) {
    selectedInitialDate = day;
    selectedEndDate = day;
    datepickerClearButton.style.display = "block";
  } else if (
    day.getTime() === selectedInitialDate.getTime() &&
    day.getTime() === selectedEndDate.getTime()
  ) {
    return clearSelection(true);
  } else if (day.getTime() === selectedInitialDate.getTime()) {
    selectedInitialDate = selectedEndDate;
  } else if (day.getTime() === selectedEndDate.getTime()) {
    selectedEndDate = selectedInitialDate;
  } else if (day > selectedInitialDate && day < selectedEndDate) {
    if (
      Math.abs(day - selectedInitialDate) >= Math.abs(day - selectedEndDate)
    ) {
      selectedEndDate = day;
    } else {
      selectedInitialDate = day;
    }
  } else if (day > selectedEndDate) {
    selectedEndDate = day;
  } else if (day < selectedInitialDate) {
    selectedInitialDate = day;
  }

  if (day.getMonth() !== currentMonth) {
    currentMonth = day.getMonth();
    currentYear = day.getFullYear();
  }

  datepickerSelectedText.innerHTML = `<b>From:</b> ${selectedInitialDate.toDateString()}<br /><b>To:</b> ${selectedEndDate.toDateString()}`;
  fillMonth();
}

/**
 * Clear selected dates.
 * @param {boolean} keepState keep the body month or return to start
 */
function clearSelection(keepState) {
  datepickerClearButton.style.display = "none";
  selectedInitialDate = null;
  selectedEndDate = null;
  datepickerSelectedText.innerHTML = DEFAULT_SELECTED_TEXT;
  fillMonth(keepState ? undefined : new Date());
}

/**
 * Fills the datepicker body with the weeks of a given day.
 * @param {Date} date
 */
function fillMonth(date = new Date(currentYear, currentMonth)) {
  currentYear = date.getFullYear();
  currentMonth = date.getMonth();
  currentIndicator = "month";

  datepickerBody.innerHTML = "";
  const monthDays = generateMonthDays(date);
  monthDays.forEach(week =>
    datepickerBody.appendChild(generateWeekElement(week))
  );

  datepickerIndicator.innerText =
    MONTH_NAMES[date.getMonth()] + " " + date.getFullYear();
  datepickerWeekTitle.style.display = "flex";
}

/**
 * Fills the datepicker body with the months of given year.
 * @param {number} fullYear
 */
function fillYear(fullYear = currentYear) {
  currentYear = fullYear;
  currentIndicator = "year";

  datepickerBody.innerHTML = "";
  for (let i = 0; i < 4; i++) {
    const element = document.createElement("ul");
    element.className = "datepicker-week-container";
    for (let j = 0; j < 3; j++) {
      element.appendChild(generateMonthElement(new Date(fullYear, i * 3 + j)));
    }
    datepickerBody.appendChild(element);
  }

  datepickerIndicator.innerText = fullYear;
  datepickerWeekTitle.style.display = "none";
}

/**
 * Fills the datepicker body with the decade of a given year.
 * @param {number} from
 */
function fillDecade(from = currentYear) {
  currentIndicator = "decade";

  from = Math.floor(from / 10) * 10;

  datepickerBody.innerHTML = "";
  for (let i = 0; i < 5; i++) {
    const element = document.createElement("ul");
    element.className = "datepicker-week-container";
    for (let j = 0; j < 2; j++) {
      element.appendChild(generateYearElement(from + i * 2 + j));
    }
    datepickerBody.appendChild(element);
  }

  datepickerIndicator.innerText = `${from} - ${from + 9}`;
  datepickerWeekTitle.style.display = "none";
}

/**
 * Returns a matrix with all dates of the month of given date.
 * It completes a matrix of 6 weeks with adjacent months days.
 * @param {Date} date
 */
function generateMonthDays(date = new Date()) {
  let monthDays = [];
  const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
  let day = new Date(
    firstDay.getFullYear(),
    firstDay.getMonth(),
    1 - firstDay.getDay()
  );
  for (let weekcount = 0; weekcount < 6; weekcount++) {
    monthDays[weekcount] = [];
    for (let weekday = 0; weekday < 7; weekday++) {
      monthDays[weekcount][weekday] = new Date(day);
      day = new Date(day.setDate(day.getDate() + 1));
    }
    weekday = 0;
  }
  return monthDays;
}

/**
 * Returns a list item element to represent a day.
 * @param {Date} day
 */
function generateDayElement(day) {
  let element = document.createElement("li");
  element.innerText = day.getDate();
  element.className = "datepicker-list-item-container"; // Base day element class
  if (Date.now() - day >= 0 && Date.now() - day <= DAY_TIME) {
    element.className += " datepicker-list-item-today"; // Today class
  }
  if (day.getMonth() !== currentMonth) {
    element.className += " datepicker-list-item-outday"; // Out month days class
  }
//   if (Date.now() - DAY_TIME - day > 0) {
//     element.className += " datepicker-list-item-unavaliable"; // Unavaliable or past days class
//   } else {
    element.addEventListener("mousedown", evt => selectDay(day));
    if (selectedInitialDate && selectedEndDate) {
      if (
        day.getTime() === selectedInitialDate.getTime() ||
        day.getTime() === selectedEndDate.getTime()
      ) {
        element.className += " datepicker-list-item-selected"; // Selected days class
      } else if (day > selectedInitialDate && day < selectedEndDate) {
        element.className += " datepicker-list-item-between"; // Between selected days class
      }
    }
//   }
  return element;
}

/**
 * Returns a list element to represent a week of a given array of days.
 * @param {Date[]} week
 */
function generateWeekElement(week) {
  let element = document.createElement("ul");
  element.className = "datepicker-week-container";
  week.forEach(day => element.appendChild(generateDayElement(day)));
  return element;
}

/**
 * Returns a list item element to represent a month.
 * @param {Date} date
 */
function generateMonthElement(date = new Date(currentYear)) {
  const element = document.createElement("li");
  element.innerText = MONTH_NAMES[date.getMonth()];
  element.className = "datepicker-list-item-container";
  if (
    new Date().getMonth() === date.getMonth() &&
    new Date().getFullYear() === date.getFullYear()
  ) {
    element.className += " datepicker-list-item-today";
  }
  if (
    new Date().getFullYear() > date.getFullYear() ||
    (new Date().getMonth() > date.getMonth() &&
      new Date().getFullYear() === date.getFullYear())
  ) {
    element.className += " datepicker-list-item-unavaliable";
  } else {
    element.addEventListener("click", evt =>
      fillMonth(new Date(currentYear, date.getMonth()))
    );
    if (selectedInitialDate && selectedEndDate) {
      if (
        (date.getFullYear() === selectedInitialDate.getFullYear() &&
          date.getMonth() === selectedInitialDate.getMonth()) ||
        (date.getFullYear() === selectedEndDate.getFullYear() &&
          date.getMonth() === selectedEndDate.getMonth())
      ) {
        element.className += " datepicker-list-item-selected";
      } else if (
        date.getFullYear() === selectedInitialDate.getFullYear() ||
        date.getFullYear() === selectedEndDate.getFullYear()
      ) {
        if (
          selectedInitialDate.getFullYear() === selectedEndDate.getFullYear()
        ) {
          if (
            date.getMonth() > selectedInitialDate.getMonth() &&
            date.getMonth() < selectedEndDate.getMonth()
          ) {
            element.className += " datepicker-list-item-between";
          }
        } else {
          if (
            (date.getFullYear() === selectedInitialDate.getFullYear() &&
              date.getMonth() > selectedInitialDate.getMonth()) ||
            (date.getFullYear() === selectedEndDate.getFullYear() &&
              date.getMonth() < selectedEndDate.getMonth())
          ) {
            element.className += " datepicker-list-item-between";
          }
        }
      } else if (
        date.getFullYear() > selectedInitialDate.getFullYear() &&
        date.getFullYear() < selectedEndDate.getFullYear()
      ) {
        element.className += " datepicker-list-item-between";
      }
    }
  }
  return element;
}

/**
 * Returns a list item element to represent a month.
 * @param {number} fullYear
 */
function generateYearElement(fullYear) {
  const element = document.createElement("li");
  element.innerText = fullYear;
  element.className = "datepicker-list-item-container";
  if (new Date().getFullYear() === fullYear) {
    element.className += " datepicker-list-item-today";
  }
  if (new Date().getFullYear() > fullYear) {
    element.className += " datepicker-list-item-unavaliable";
  } else {
    element.addEventListener("click", evt => fillYear(fullYear));
    if (selectedInitialDate && selectedEndDate) {
      if (
        fullYear === selectedInitialDate.getFullYear() ||
        fullYear === selectedEndDate.getFullYear()
      ) {
        element.className += " datepicker-list-item-selected"; // Selected days class
      } else if (
        fullYear > selectedInitialDate.getFullYear() &&
        fullYear < selectedEndDate.getFullYear()
      ) {
        element.className += " datepicker-list-item-between"; // Between selected days class
      }
    }
  }
  return element;
}

</script>
<script>
    $(document).ready(function() {
        // var fromDate = '';
        // var toDate = '';
        var z = $('#datepicker-selected-text').text();
        if(z == 'Select the initial and the end dates') {

            var tdate = new Date();
            var dd = tdate.getDate(); //yields day
            var MM = tdate.getMonth(); //yields month
            var yyyy = tdate.getFullYear(); //yields year
            var currentDate= yyyy + "-" +( MM+1) + "-" + dd;
        } else {
            console.log(z);
        }
        var fromDate = currentDate;
        var toDate = currentDate;
        var userId = $('#allusers').val();
        getAllRecords(userId, fromDate, toDate);

        //  console.log('Start Date', fromDate);
        //  console.log('End Date', toDate);
        //  console.log('userId', userId);


  $(".js-select2").select2();

  $(".js-select2-multi").select2();

  $(".large").select2({
    dropdownCssClass: "big-drop",
  });

});
</script>
<script>
</script>
<script>
    function SerachAttendence () {
        // event.preventDefault();
        var z = $('#datepicker-selected-text').text();
        var fromDate = ''
        var toDate = ''
        if(z == 'Select the initial and the end dates') {
            var tdate = new Date();
            var dd = tdate.getDate(); //yields day
            var MM = tdate.getMonth(); //yields month
            var yyyy = tdate.getFullYear(); //yields year
            var currentDate= yyyy + "-" +( MM+1) + "-" + dd;
            fromDate = currentDate;
            toDate = currentDate;
        } else {
            var res = z.split(":");
            var f1 =res[1].trim().split("To")[0];
            var f2 =res[2].trim()
            var forStartDate = new Date(f1);
            var dd1 = forStartDate.getDate(); //yields day
            var MM1 = forStartDate.getMonth(); //yields month
            var yyyy1 = forStartDate.getFullYear(); //yields year
            var fromDate= yyyy1 + "-" +( MM1+1) + "-" + dd1;
            var forendDate = new Date(f2);
            var dd = forendDate.getDate(); //yields day
            var MM = forendDate.getMonth(); //yields month
            var yyyy = forendDate.getFullYear(); //yields year
            var toDate= yyyy + "-" +( MM+1) + "-" + dd;
        }
        var userId = $('#allusers').val();
        $('#client-table').DataTable().clear().destroy();
        getAllRecords(userId, fromDate, toDate);

    }
    function getAllRecords(userId, fromDate, ToDate) {
        var path = {!! json_encode(url('/')) !!};
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#client-table tbody').empty();
    $('#client-table').DataTable({
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
    url : path + '/showallAttendence',
    type : 'post',
    data : {_token: CSRF_TOKEN,getUserId:userId,getfromdate: fromDate, getToDate:ToDate},
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'shift', name: 'shift' },
        { data: 'assgin_user_toclient', name: 'assgin_user_toclient' },
        { data: 'user_id', name: 'user_id' },
        { data: 'in_Date', name: 'in_Date' },
        { data: 'out_Date', name: 'out_Date' },
        { data: 'in_time', name: 'in_time' },
        { data: 'out_time', name: 'out_time' },
        { data: 'CREATED_BY', name: 'CREATED_BY' },
        { data: 'total_hours', name: 'total_hours' },
        { data: 'Stutus', name: 'Stutus' },
        { data: 'action', name: 'action' }


    ]
});
    }

    function deleteAttendence(id,event) {
    event.preventDefault(); // prevent form submit
    $('#loading-image').show();
        if (confirm("Are You Sure You Want to Delete Client!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/deleteAttendence/' + id ,
                type: 'get',
                success: function(data) {
                        console.log('Data', data);
                        // return;
                         var response = data.trim();
                         if(response == 'Done'){
                            alert('Attendence Deleted Sucessfuly');
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
