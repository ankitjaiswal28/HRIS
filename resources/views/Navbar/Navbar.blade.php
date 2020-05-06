<nav class="navbar navbar-expand-lg navbar-light bg-lightt bottom-shadow" style="">
 @if (session('roleId') == '1')
 <a class="navbar-brand" href="{{ url('SuperAdmin/superadmindahboard') }}"><img src="/asset/images/sharedocs_enterpriser.png"
            style="width: 200px;background: white;" alt=""></a>
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
            <li class="nav-item">
                <a class="nav-link"  href="/SuperAdmin/Show_client">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/SuperAdmin/Show_Module">Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="">User</a>
            </li>
        @endif
        @if (session('roleId') == '2')
             <li class="nav-item active">
                <a class="nav-link" href="/Admin/admindahboard">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link" href="/Leave_manage">Leave</a>
=======
                <a class="nav-link" href="/project/showdata">Project Master</a>
>>>>>>> a18a727566605479b313dcc7f6fadb04d1b10abd
            </li>
            {{-- <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Page 1-1</a></li>
                  <li><a href="#">Page 1-2</a></li>
                  <li><a href="#">Page 1-3</a></li>
                </ul>
              </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="/Admin/role">Role</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/Admin/Module">Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/Admin/User">User</a>
            </li>
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                                        <img src="/asset/images/Anonymous_Mask.png"
                                            class="notification_icon">
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
                    </a></div></div>
                    <div class="notification_viewall"><a href="">View All</a></div>
                </div>
            </li>
            <li class="nav-item  dropdown dropdown-menu-right">
                <a class="nav-link dropdown-toggle  dropdown-menu-right"
                    style="padding-left: 5px;padding-top: 5px;cursor:pointer;" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon">
                </a>
                <div class="dropdown-menu profile_open animated fadeInUp not_show" aria-labelledby="navbarDropdownMenuLink" id="profile_pict">
                    <div class="profile_div">
                        <div class="hris_prfile">
                            <img src="/asset/images/Anonymous_Mask.png" alt="" class="profile_icon">
                            <div>
                                <h6 class="bold_txt">{{session('username')}}</h6>
                                <h6>{{session('emailId')}}</h6>
                            </div><br>
                            <div>
                                <span style="float:left"><a href="" class="btnn">My Account</a></span>
                                <span style="float:right"><a href="\logout" class="btnn">Logout</a></span>
                            </div><br>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
