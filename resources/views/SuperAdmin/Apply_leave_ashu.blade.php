{{-- @extends('Layout.app') --}}
{{-- @section('content') --}}
<style>
    :root {
        --color-primary: rgb(20, 40, 80);
        --color-primary-light3: rgba(32, 166, 243, 0.3);
        --color-primary-light7: rgb(20, 40, 80);
        --color-base: rgb(246, 247, 248);
        --color-letters: rgb(1, 22, 39);
        --color-letters-light1: rgb(1, 22, 39, 0.1);
        --color-danger: rgb(255, 51, 102);
    }

    button {
        /* border: none;
  background-color: var(--color-primary);
  color: var(--color-base);
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 0 3px rgba(1, 22, 39, 0.3);
  transition: all 0.1s ease-in-out; */
        border: none;
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        /* padding: 10px; */
        border-radius: 5px;
        cursor: pointer;
        /* box-shadow: 0 0 3px rgba(1, 22, 39, 0.3); */
        transition: all 0.1s ease-in-out;
    }

    button:focus {
        outline: none;
    }

    button:active {
        transform: scale(0.9);
        box-shadow: 0 0 3px rgba(1, 22, 39, 0.3);
    }

    #datepicker {
        position: relative;
        color: var(--color-letters);
    }

    #datepicker-container {
        /* position: absolute; */
        top: 30px;
        width: auto;
        height: 300px;
        padding: 15px;
        border-radius: 5px;
        left: 50%;
        /* margin-left: 100px; */
        background-color: white;
        box-shadow: 0 0 2px rgba(1, 22, 39, 0.3);
        display: none;
        flex-direction: column;
        align-items: stretch;
    }

    .datepicker-header {
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: stretch;
    }

    .datepicker-button-change {
        width: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    #datepicker-indicator {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-weight: bold;
        user-select: none;
    }

    #datepicker-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 15px 0px;
    }

    .datepicker-week-container {
        all: unset;
        flex: 1;
        display: flex;
        align-items: stretch;
    }

    .datepicker-list-item-container {
        all: unset;
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        user-select: none;
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    .datepicker-list-item-container:hover {
        background-color: var(--color-primary-light7);
        color: var(--color-base);
    }

    .datepicker-list-item-outday {
        opacity: 0.3;
    }

    .datepicker-list-item-selected {
        background-color: var(--color-primary);
        color: var(--color-base);
    }

    .datepicker-list-item-between {
        background-color: var(--color-primary-light3);
        color: var(--color-primary);
        animation: day-between 0.5s ease-in-out;
    }

    .datepicker-list-item-unavaliable {
        cursor: not-allowed;
        color: var(--color-danger);
    }

    .datepicker-list-item-unavaliable:hover {
        background-color: transparent;
        color: var(--color-danger);
    }

    .datepicker-list-item-today::after {
        content: " ";
        width: 100%;
        height: 100%;
        background-color: var(--color-letters-light1);
        position: absolute;
        border: 3px solid var(--color-letters-light1);
        border-radius: 5px;
        top: 0px;
        left: 0px;
    }

    .datepicker-list-item-selected::after {
        content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid var(--color-primary);
        border-radius: 5px;
        top: 0px;
        left: 0px;
    }

    #datepicker-week-title {
        all: unset;
        display: none;
        min-height: 30px;
        align-items: stretch;
        padding-top: 15px;
    }

    #datepicker-week-title>li {
        all: unset;
        flex: 1;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #datepicker-selected-text {}

    .datepicker-footer,
    .datepicker-End-footer {
        min-height: 25px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        text-align: center;
    }

    #datepicker-clear-button {
        display: none;
    }

    @keyframes day-between {
        0% {
            color: var(--color-letters);
            background-color: transparent;
        }

        100% {
            color: var(--color-primary);
            background-color: var(--color-primary-light3);
        }
    }
</style>
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">All Employee</span><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
<div class="flip-card-3D-wrapper" style="width: 55% !important;">
    <div class="neuphormic_shadow" style="padding:20px">
        <div>
            <h2>Edit Request: Leave</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="sel1" class="grey">LEAVE TYPE</label>
                    <select class="form-control" id="sel1"
                        style="height: calc(3.25rem + 2px);border: 1px solid #cecece !important;padding: 15px !important;">
                        <option>Casual Leave</option>
                        <option>Sick Leave</option>
                        <option>Maternity Leave</option>
                        <option>Half Pay Leave</option>
                        <option>Study Leave</option>
                    </select>
                </div>
            </div>
            {{-- padding: 15px !important;
    height: calc(3.25rem + 2px);
    border: 1px solid #cecece !important; --}}
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div
                    style="color: white;padding: 15px !important;border-radius: 4px;background: #72758a;position: relative;top: 32px;left: -5px;">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="    border-right: 1px solid;">
                            <span style="font-size: 18px;">12</span> out of <span style="font-size: 18px;">22</span>
                            Used.
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <span style="font-size: 18px;">10</span> days remaining.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div>
                    <div id="datepicker">
                        {{-- <button id="datepicker-button">Open Datepicker</button> --}}
                        <div id="datepicker-container">
                            <div class="datepicker-header">
                                <button class="datepicker-button-change" id="datepicker-previous-button"><span
                                        style="position: absolute;font-size: 40px;">
                                        <</span> </button> <div id="datepicker-indicator">
                            </div>
                            <button class="datepicker-button-change" id="datepicker-next-button"><span
                                    style="position: absolute;font-size: 40px;">></span></button>
                        </div>
                        <ul id="datepicker-week-title"></ul>
                        <div id="datepicker-body"></div>

                        <button id="datepicker-clear-button">Clear</button>
                        {{-- <div>
                            <button id="datepicker-submit-button">Submit</button>
                          </div> --}}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div>
                <div class="datepicker-footer" id='datestart'>
                    <span id="datepicker-selected-text"></span>
                </div>
                <div class="datepicker-End-footer" id='dateend'>
                    <span id="datepicker-End-text"></span>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" style="margin-bottom: 8px;">
                <label for="reason" class="grey" style="margin-top: 10px;">REASON</label>
                <textarea class="form-control" rows="2" id="reason" style="border-radius: 5px;border: 1px solid #cecece !important;"></textarea>
            </div>
            <button type="submit" class="btnn" style="float: right;border: none;width: 150px;">Submit</button>
        </div>
    </div>

</div>
</div>
</div>
{{-- //////////////////////////         Calender datepicker  Script      ////////////////////////////// --}}
{{-- <script src="/asset/js/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script type="text/javascript">
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
            const WEEKDAY_NAMES = ["S", "M", "T", "W", "T", "F", "S"];
            const DEFAULT_SELECTED_TEXT = "Select the Initial dates";
            const DEFAULT_END_TEXT = "Select the End dates";
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
            // var datepickerButton = document.getElementById("datepicker-button");
            var datepickerClearButton = document.getElementById("datepicker-clear-button");
            var datepickerSubmitButton = document.getElementById("datepicker-submit-button");
            var datepickerContainer = document.getElementById("datepicker-container");
            var datepickerSelectedText = document.getElementById("datepicker-selected-text");
            var datepickerEndText = document.getElementById("datepicker-End-text");
            var datepickerNextButton = document.getElementById("datepicker-next-button");
            var datepickerPreviousButton = document.getElementById(
              "datepicker-previous-button"
            );
            var datepickerIndicator = document.getElementById("datepicker-indicator");
            var datepickerWeekTitle = document.getElementById("datepicker-week-title");

            /**
            * Event Listeners
            */
            window.addEventListener("load", evt => toggleDatepicker());
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
            datepickerEndText.innerText = DEFAULT_END_TEXT;

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
                // datepickerSubmitButton.style.display = "block";
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

              datepickerSelectedText.innerHTML = `<b>From:</b> ${selectedInitialDate.toDateString()}<br />`;
              let starteddate = JSON.stringify(selectedInitialDate)
              startdate = starteddate.slice(1,11)
              console.log("datestart:", startdate);

              datepickerEndText.innerHTML = `<b>To:</b> ${selectedEndDate.toDateString()}`;
              let endeddate = JSON.stringify(selectedEndDate)
              enddate = endeddate.slice(1,11)
              console.log("dateend:", enddate);
              fillMonth();
            }

            /**
            * Clear selected dates.
            * @param {boolean} keepState keep the body month or return to start
            */
            function clearSelection(keepState) {
              datepickerClearButton.style.display = "none";
              // datepickerSubmitButton.style.display = "none";
              selectedInitialDate = null;
              selectedEndDate = null;
              datepickerSelectedText.innerHTML = DEFAULT_SELECTED_TEXT;
              datepickerEndText.innerHTML = DEFAULT_END_TEXT;
              fillMonth(keepState ? undefined : new Date());
              console.clear();
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
              if (Date.now() - DAY_TIME - day > 0) {
                element.className += " datepicker-list-item-unavaliable"; // Unavaliable or past days class
              } else {
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
              }
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
    function convertDate(d){
        var parts = d.split(" ");
        var months = {
          Jan: "01",
          Feb: "02",
          Mar: "03",
          Apr: "04",
          May: "05",
          Jun: "06",
          Jul: "07",
          Aug: "08",
          Sep: "09",
          Oct: "10",
          Nov: "11",
          Dec: "12"
        };
        return parts[2]+"-"+months[parts[1]]+"-"+parts[3];
   }
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#datepicker-submit-button").click(function(){
        var getdatestart = $('#datestart span').text();
        var avoid = "From: ";
        var removefrom = getdatestart.replace(avoid,'');
        var datestart = convertDate(removefrom);
        console.log("datestart:", datestart);

        var getdateend = $('#dateend span').text();
        var avoid = "To: ";
        var removeto = getdateend.replace(avoid,'');
        var dateend = convertDate(removeto);;
        console.log("dateend:", dateend);
        });
    });
</script>
{{-- @endsection --}}
