<style>

@font-face {
    font-family: PierSans;
    src: url("../Fonts/PierSans/PierSans-Light.otf");
}

@font-face {
    font-family: Manrope;
    src: url(../Fonts/Manrope/manrope-regular.otf);
}

@font-face {
    font-family: KayakSans;
    src: url(../Fonts/KayakSans/Kayak_Sans_Regular.otf);
}

@font-face {
    font-family: orkney;
    src: url(../Fonts/orkney/Orkney-Regular.otf);
}

@font-face {
    font-family: Sk_Modernist;
    src: url(../Fonts/Sk-Modernist/Sk-Modernist-Regular.otf);
}

body {
    font-family: KayakSans !important;
}

.dropdown-toggle::after {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: .255em;
    vertical-align: 0px !important;
    content: "";
    border-top: .4em solid !important;
    border-right: .4em solid transparent !important;
    border-bottom: 0;
    border-left: .4em solid transparent !important;
}

.dropdown-menu {
    right: 0 !important;
    left: auto !important;
}

.bottom-shadow {
    box-shadow: 0 1px 20px 0px #d0d0d0;
}

.navbar_profile_icon {
    background: red;
    width: 30px;
    border-radius: 8px;
}

.bg-lightt {
    background-color: #aed5ff !important;
}


/* .col-md-6 {
    margin-right: 0px !important;
    padding-right: 15px !important;
    padding-left: 15px !important;
}*/


/* ///////////////////////////////////////////////////////////////////////////////// */

.grey_font {
    color: #a5a5a5;
}

table.dataTable {
    clear: both;
    margin-top: 0px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    border-collapse: collapse !important;
    border-spacing: 0;
}

.table-bordered {
    border: 1px solid #ffffff !important;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #ffffff !important;
}

.table th,
.table td {
    padding: 8px !important;
}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before,
table.dataTable thead .sorting_desc_disabled:after {
    position: absolute;
    bottom: 3px;
    display: block;
}

table.dataTable thead>tr>th.sorting_asc,
table.dataTable thead>tr>th.sorting_desc,
table.dataTable thead>tr>th.sorting,
table.dataTable thead>tr>td.sorting_asc,
table.dataTable thead>tr>td.sorting_desc,
table.dataTable thead>tr>td.sorting {
    letter-spacing: 1px;
    color: #676767;
    text-transform: uppercase;
    padding-right: 30px;
    font-size: 14px;
}

table.table-bordered.dataTable tbody th,
table.table-bordered.dataTable tbody td {
    font-size: smaller;
}

.page-item.disabled .page-link {
    color: #124b7d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #ffffff !important;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #007bff;
    border-color: #ffffff !important;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #ffffff !important;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 1px solid #dee2e6 !important;
    border-top: 0px solid white !important;
}

.page-link {
    border-radius: 50%;
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1;
    color: #007bff;
    background-color: #fff;
    border: 0px solid #dee2e6 !important;
}

.page-link:focus {
    z-index: 2;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0) !important;
}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before,
table.dataTable thead .sorting_desc_disabled:after {
    position: absolute;
    bottom: 8px;
    display: block;
}

div.dataTables_wrapper div.dataTables_filter input {
    border: none;
    margin-left: 0.5em;
    display: inline-block;
    width: auto;
    border-bottom: 1px solid #d4d4d4;
    border-radius: 0;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.04) !important;
}


/* /////////////////////////////////////////////////////////////// */

.margin_left_right {
    margin-left: 40px;
    margin-right: 40px;
}

.navbar_profile_icon_name {
    border-radius: 50%;
    width: 25px;
    background: red;
}

.blue_circle {
    color: blue;
}

.yellow_circle {
    color: yellow;
}

.fafa_icon {
    margin: 5px 5px;
    font-size: 15px;
}

.fafa_add_circle {
    font-size: 20px;
    color: white;
    padding: 12px 15px;
    background: green;
    border-radius: 50%;
}

.absolute_add_btn {
    right: 60px;
    top: 35px;
    position: absolute;
}
</style>
