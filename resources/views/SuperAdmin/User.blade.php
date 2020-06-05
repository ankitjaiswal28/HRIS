@extends('Layout.app')
@section('content')
<div>
    <div class="row" style="position: relative;background: #142850 ;width: 100%;margin-right: 0px;margin-left: 0px;">
        <div style="padding:8px 35px;">
            <div>
                <h3 style="margin-bottom: 0px;color:white"><a class="white_anchor" href="{{ url('/Superadmin/dashboard') }}"><i class="typcn typcn-home-outline" aria-hidden="true"></i></a> |
                    User's</h3>
            </div>
        </div>
        <div class="absolute_add_btn" style=""><a href="{{ url('/Superadmin/dashboard') }}"><i
                    class="fa fa-arrow-left fafa_add_circle_left" aria-hidden="true"></i></a><a
                href="{{ url('/Superadmin/Add_Userr') }}"><i class="fa fa-plus fafa_add_circle_right"
                    aria-hidden="true"></i></a></div>
    </div>
</div>
<br>
<div class="margin_left_right">
    <table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle blue_circle" aria-hidden="true"></i> Active</td>
                <td class="grey_font"><a href="{{ url('/Superadmin/Add_Userr') }}"><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle yellow_circle" aria-hidden="true"></i> Not Active</td>
                <td class="grey_font"><a href="{{ url('/Superadmin/Add_Userr') }}"><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle blue_circle" aria-hidden="true"></i> Active</td>
                <td class="grey_font"><a href=""><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle yellow_circle" aria-hidden="true"></i> Active</td>
                <td class="grey_font"><a href=""><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle blue_circle" aria-hidden="true"></i> Active</td>
                <td class="grey_font"><a href=""><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
            <tr>
                <td><img src="/asset/images/Anonymous_Mask.png" class="navbar_profile_icon_name"> Tiger
                    Nixon
                </td>
                <td class="grey_font">System Architect</td>
                <td class="grey_font">Edinburgh</td>
                <td class="grey_font">61</td>
                <td class="grey_font"><i class="fa fa-circle yellow_circle" aria-hidden="true"></i> Active</td>
                <td class="grey_font"><a href=""><img
                            src="/asset/css/zondicons/zondicons/edit-pencil.svg"
                            style="width: 15px;margin-right: 20px;    filter: invert(0.5);" alt=""></a><a href=""><img
                            src="/asset/css/zondicons/zondicons/close.svg"
                            style="width: 15px;    filter: invert(0.5);" alt=""></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/datatables.min.js"></script>
<script>
    $('#example').DataTable({
        language: {
        searchPlaceholder: "Search records",
        search: "<i class='fa fa-search' aria-hidden='true'></i>",
        paginate: {
      next: '<span class="typcn typcn-arrow-right-outline"></span>', // or '→'
      previous: '<span class="typcn typcn-arrow-left-outline"></span>' // or '←'
    }
      }
   });
</script>
@endsection
