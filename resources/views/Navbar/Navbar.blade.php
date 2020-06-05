<style>



</style>
<nav class="navbar navbar-expand-lg navbar-light bg-lightt bottom-shadow" style="">
    @if (session('roleId') == '1')
    <a class="navbar-brand" href="{{ url('SuperAdmin/superadmindahboard') }}"><img
            src="/asset/images/sharedocs_enterpriser.png" style="width: 200px;background: white;" alt=""></a>
    @endif
    @if (session('roleId') == '2')
    <a class="navbar-brand" href="{{ url('Admin/admindahboard') }}"><img src="/asset/images/sharedocs_enterpriser.png"
            style="width: 200px;background: white;" alt=""></a>
    @endif
    @if (session('roleId') == '3')
    <a class="navbar-brand" href="{{ url('Admin/admindahboard') }}"><img src="/asset/images/sharedocs_enterpriser.png"
            style="width: 200px;background: white;" alt=""></a>
    @endif
    {{-- <a class="navbar-brand" href="{{ url('/') }}"><img src="/asset/images/sharedocs_enterpriser.png"
        style="width: 200px;background: white;" alt=""></a> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            {{-- <div class="switch_box box_3 theme-switch">
                <div class="toggle_switch switch">
                    <input type="checkbox" class="switch_3" name="Darkmode" id="Darkmode" onclick="apply_dark()" checked>
                    <svg class="checkbox" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="0 0 168 80">
                       <path class="outer-ring" d="M41.534 9h88.932c17.51 0 31.724 13.658 31.724 30.482 0 16.823-14.215 30.48-31.724 30.48H41.534c-17.51 0-31.724-13.657-31.724-30.48C9.81 22.658 24.025 9 41.534 9z" fill="none" stroke="#233043" stroke-width="3" stroke-linecap="square" stroke-miterlimit="3"/>
                       <path class="is_checked" d="M17 39.482c0-12.694 10.306-23 23-23s23 10.306 23 23-10.306 23-23 23-23-10.306-23-23z"/>
                        <path class="is_unchecked" d="M132.77 22.348c7.705 10.695 5.286 25.617-5.417 33.327-2.567 1.85-5.38 3.116-8.288 3.812 7.977 5.03 18.54 5.024 26.668-.83 10.695-7.706 13.122-22.634 5.418-33.33-5.855-8.127-15.88-11.474-25.04-9.23 2.538 1.582 4.806 3.676 6.66 6.25z"/>
                    </svg>
                  </div>
            </div> --}}
            @if (session('roleId') == '1')
            {{-- <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Superadmin/index">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Superadmin/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Role</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="/SuperAdmin/Show_client">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SuperAdmin/Show_Module">Module</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="">User</a>
            </li> --}}
            @endif
            @if (session('roleId') == '2')




            {{-- <div class="theme-switch">
                <div class="switch"></div>
            </div> --}}



            @endif
            @if (session('roleId') == '3')
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="/Superadmin/index">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/project/showdata">Project Master</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Admin/role">Role</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/Admin/Module">Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/Admin/User">User</a>
            </li> --}}
            @endif

            <li class="nav-item">
                <a class="nav-link   dropdown-menu-right" href="#" data-toggle="dropdown" style="padding-right: 0px;"><i
                        class="fa fa-bell" aria-hidden="true" style="
                    font-size: 22px;
                "></i><i class="fa fa-circle notification_dot" aria-hidden="true"></i></a>
                <div class="dropdown-menu" id="notification" aria-labelledby="navbarDropdownMenuLink"
                    style="margin-right: 25px;min-width: 23rem !important;padding-bottom: 0px;!important;border-radius: 8px;">

                    <div class="noti-title">
                        <span class="new-noti-title">Notificaations</span>
                        <span class="noti-count" id="noti-container-count">2</span>
                    </div>
                    <div class="scrollbar" id="style-1">
                        <div class="force-overflow">
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item " href="#">
                                <div class="row hvr-bounce-to-right">
                                    <div class="col-md-2">
                                        <div class="notificatn_profile_div">
                                            <div class="notificatn_profile_div_main">
                                                <img src="/asset/images/Anonymous_Mask.png" class="notification_icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 notifican_leftpad">
                                        Employee1 upvoted your question
                                        <div>
                                            <span class="notification_bottom_patch_left">10:20pm</span>
                                            <span class="notification_bottom_patch_right">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                            </a></div>
                    </div>
                    <div class="notification_viewall"><a href="">View All</a></div>
                </div>
            </li>
            <li class="nav-item  dropdown dropdown-menu-right">
                <a class="nav-link dropdown-toggle  dropdown-menu-right"
                    style="padding-left: 5px;padding-top: 5px;cursor:pointer;" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon">
                </a>
                <div class="dropdown-menu profile_open animated fadeInUp not_show"
                    aria-labelledby="navbarDropdownMenuLink" id="profile_pict">
                    <div class="profile_div">
                        <div class="hris_prfile" style="width: max-content;">
                            <img src="/asset/images/Anonymous_Mask.png" alt="" class="profile_icon">
                            <div>
                                <h6 class="bold_txt">{{session('username')}}</h6>
                                <h6>{{session('emailId')}}</h6>
                            </div><br>
                            <div>
                                <span style="float:left"><a href="" class="btnn" style="margin: 10px !important;">My
                                        Account</a></span>
                                <span style="float:right"><a href="\logout" class="btnn"
                                        style="margin: 10px !important;">Logout</a></span>
                            </div><br>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="primary-nav">


    <button href="#" class="hamburger open-panel nav-toggle">
        <span class="screen-reader-text">Menu</span>
    </button>

    <nav role="navigation" class="menu">

        @if (session('roleId') == '1')
        <a class="navbar-brand left_marge_logo" href="{{ url('SuperAdmin/superadmindahboard') }}"
            style="margin-right: 0px;">
            <h2 class="h2_font_side_header">Abhishek</h2>
            {{-- <img src="/asset/images/sharedocs_enterpriser.png" style="width: 185px;background: white;" alt=""> --}}
        </a>
        <div class="overflow-container">
            <div class="scrollbar" style="height: 640px;overflow-y: auto;" id="style-1">
                <div class="force-overflow">
                    <ul class="menu-dropdown">

                        <li><a class="nav-link" href="/SuperAdmin/superadmindahboard">Dasboard</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>
                        <li><a class="nav-link" href="/SuperAdmin/Show_client">Client</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>
                        <li><a class="nav-link" href="/SuperAdmin/Show_Module">Module</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>
                        {{-- <li style="top: calc(53vh - 10px);"><a href="#">Settings</a><span class="icon"><i
                                    class="fa fa-gear"></i></span></li> --}}

                    </ul>

                </div>
            </div>
        </div>
        @endif
        @if (session('roleId') == '2')
        <a class="navbar-brand left_marge_logo" href="{{ url('Admin/admindahboard') }}" style="margin-right: 0px;">
            <h2 class="h2_font_side_header">Abhishek</h2>

            {{-- <img src="/asset/images/sharedocs_enterpriser.png" style="width: 185px;background: white;" alt=""> --}}
        </a>
        <div class="overflow-container">
            <div class="scrollbar" style="height: 640px;overflow-y: auto;" id="style-1">
                <div class="force-overflow">
                    <ul class="menu-dropdown">
                        <li><a class="nav-link" href="/Admin/admindahboard">Dashboard</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>

                        <li class="menu-hasdropdown">
                            <span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="Module">
                                <a>Module</a>
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="Module" />
                            <ul class="sub-menu-dropdown">
                                <li><a href="/Leave_manage">Leave</a></li>
                                <li><a href="/project/showdata">Project Master</a></li>
                                <li><a href="/Admin/role">Role</a></li>
                                <li><a href="/Admin/Module">Module</a></li>
                                <li><a href="/Admin/Shifts">Shifts</a></li>
<<<<<<< HEAD
                                <li><a href="/Admin/LevelsorGrade">Levels/Grade</a></li>
=======
                                {{-- <li><a href="/Admin/LevelsorGrade">Levels/Grade</a></li> --}}
>>>>>>> 88540fb225b2993d23b335b1dc270312e75b60d9
                                <li><a href="/Admin/User">User</a></li>
                                <li><a href="/Admin/Departments">Department</a></li>
                                <li><a href="/Admin/Functions">Function</a></li>
                                <li><a href="/Admin/Designation">Designation</a></li>
                                <li><a  href="/showclient">Admin-Client</a></li>
                                <li><a href="/Admin/LevelsorGrade">Levels/Grade</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link" href="/Admin/add_attendance">Show Atendence</a><span class="icon"><i
                            class="fa fa-dashboard"></i></span></li>

                        <li class="menu-hasdropdown">
                            <span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="settings">
                                <a>Settings</a>
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="settings" />

                            <ul class="sub-menu-dropdown">
                                <li><a href="">Profile</a></li>
                                <li><a href="">Security</a></li>
                                <li><a href="">Account</a></li>
                            </ul>
                        </li>
                        <li class="menu-hasdropdown">
                            <span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="settings">
                                <a>Settings</a>
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="settings" />

                            <ul class="sub-menu-dropdown">
                                <li><a href="">Profile</a></li>
                                <li><a href="">Security</a></li>
                                <li><a href="">Account</a></li>
                            </ul>
                        </li>


                        {{-- <li style="top: calc(53vh - 10px);"><a href="#">Settings</a><span class="icon"><i
                                    class="fa fa-gear"></i></span></li> --}}

                    </ul>

                </div>
            </div>
        </div>
        @endif
        @if (session('roleId') == '3')
        <a class="navbar-brand left_marge_logo" href="{{ url('Admin/admindahboard') }}" style="margin-right: 0px;">
            <h2 class="h2_font_side_header">Abhishek</h2>

            {{-- <img src="/asset/images/sharedocs_enterpriser.png" style="width: 185px;background: white;" alt=""> --}}
        </a>
        <div class="overflow-container">
            <div class="scrollbar" style="height: 640px;overflow-y: auto;" id="style-1">
                <div class="force-overflow">
                    <ul class="menu-dropdown">

                        <li><a class="nav-link" href="/User/dashboard">Dasboard</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>
                        <li><a class="nav-link" href="/User/show_atendence">Show Attendence</a><span class="icon"><i
                                    class="fa fa-dashboard"></i></span></li>

                        {{-- <li style="top: calc(53vh - 10px);"><a href="#">Settings</a><span class="icon"><i
                                    class="fa fa-gear"></i></span></li> --}}

                    </ul>

                </div>
            </div>
        </div>
        @endif




    </nav>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function apply_dark() {
        var mode;
        if ($('#Darkmode').not(':checked').length) {
            var mode = 'DarkMode';
        } else {
            var mode = 'LightMode';
        }
        console.log(mode);
        var form_data = new FormData();
        form_data.append('mode', mode);
        $.ajax({
            url: '/darkmode',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data) {
                console.log(data);
            }
        });

    }

    $('.nav-toggle').click(function(e) {
        e.preventDefault();
        $("html").toggleClass("openNav");
        $(".nav-toggle").toggleClass("active");
    });
</script>
