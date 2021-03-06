<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> --}}

    <link rel="stylesheet" href="/asset/css/main_css.css">
    <style>
        body {
            background: #f9f9f9;
            font-family: KayakSansBold !important;
            color: #151515;
        }

        a {
            color: black;
            font-weight: 600;
            font-size: 0.85em;
            text-decoration: none;
        }

        label {
            color: black;
            font-weight: 600;
            font-size: 0.85em;
        }

        input:focus {
            outline: none;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
        }

        .form {
            display: flex;
            width: auto;
            background: #fff;
            margin: 15px;
            padding: 25px;
            border-radius: 25px;
            margin-top: 100px;
            box-shadow: 0px 10px 25px 5px #0000000f;
        }

        .sign-in-section {
            padding: 30px;
        }

        .sign-in-section h6 {
            margin-top: 0px;
            font-size: 0.75em;
        }

        .sign-in-section h1 {
            text-align: center;
            font-weight: 700;
            position: relative;
        }

        .sign-in-section h1:after {
            position: absolute;
            content: "";
            height: 5px;
            bottom: -15px;
            margin: 0 auto;
            left: 0;
            right: 0;
            width: 40px;
            background: #7F00FF;
            background: -webkit-linear-gradient(to right, #E100FF, #7F00FF);
            background: linear-gradient(to right, #E100FF, #7F00FF);
            -o-transition: 0.25s;
            -ms-transition: 0.25s;
            -moz-transition: 0.25s;
            -webkit-transition: 0.25s;
            transition: 0.25s;
        }

        .sign-in-section h1:hover:after {
            width: 100px;
        }

        .sign-in-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        .sign-in-section ul>li {
            display: inline-block;
            padding: 10px;
            font-size: 15px;
            width: 20px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 50%;
            box-shadow: 0px 3px 1px #0000000f;
            border: 1px solid #e2e2e2;
        }

        .sign-in-section p {
            text-align: center;
            font-size: 0.85em;
        }

        .form-field {
            display: block;
            width: 300px;
            margin: 10px auto;
        }

        .form-field label {
            display: block;
            margin-bottom: 10px;
        }

        .form-field input[type="email"],
        input[type="password"] {
            width: -webkit-fill-available;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #e8e8e8;
        }

        .form-field input::placeholder {
            color: #e8e8e8;
        }

        .form-field input:focus {
            border: 1px solid #AE00FF;
        }

        .form-field input[type="checkbox"] {
            display: inline-block;
        }

        .form-options {
            display: block;
            margin: auto;
            width: 300px;
        }

        .checkbox-field {
            display: inline-block;
            float: left;
        }

        .form-options a {
            float: right;
            text-decoration: none;
        }

        .btn {
            padding: 15px;
            font-size: 1em;
            width: 100%;
            border-radius: 25px;
            border: none;
            margin: 20px 0px;
        }

        .btn-signin {
            cursor: pointer;
            background: #7F00FF;
            background: -webkit-linear-gradient(to right, #E100FF, #7F00FF);
            background: linear-gradient(to right, #E100FF, #7F00FF);
            box-shadow: 0px 5px 15px 5px #840fe440;
            color: #fff;
        }

        .links a:nth-child(1) {
            float: left;
        }

        .links a:nth-child(2) {
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form">
            <div class="sign-in-section">
                <h1>LogIn</h1>
                <ul>
                    <li><img src="/asset/css/zondicons/zondicons/edit-pencil.svg" style="position: relative;margin-top: 0px; top: 3px;width:15px;"></li>
                    <li><img src="/asset/css/zondicons/zondicons/edit-pencil.svg" style="position: relative;margin-top: 0px; top: 3px;width:15px;"></li>
                </ul>
                <p>or use your email</p>
                <form action="#" method="get" name="form_name" id="form_id" class="form_class">
                    <div class="form-field">
                        <label for="email">Email</label>
                        {{-- <input type="text" name="email" id="email" placeholder="Email" required data-parsley-type="email" data-parsley-trigger="keyup" /> --}}
                        <input id="text" name="email" type="email" placeholder="Email" required data-parsley-type="email" data-parsley-trigger="keyup"  />
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        {{-- <input type="password" name="passwords" id="passwords" placeholder="Password" /> --}}
                        <input id="passwords" name="passwords" type="password" placeholder="Password" required data-parsley-trigger="blur" />
                    </div>
                    <div class="form-options">
                        <div class="checkbox-field">
                            <input id="rememberMe" type="checkbox" class="checkbox" />
                            <label for="rememberMe">Remember Me</label>
                        </div>
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="form-field">
                    <button type="button" name="submit_id" id="btn_id" class="btn btn-signin" >Submit</button>
                        {{-- <input type="button" class="btn btn-signin" value="Submit" /> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#form_id').parsley();
            $('#btn_id').click(function() {
                if ($('#form_id').parsley().isValid()) {
                    var createForm = $("#form_id");
                    var formData = createForm.serialize();
                    // var base_url = {!!json_encode(url('/')) !!};
                    $.ajax({
                        url: '/checklogin',
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            var response = data.trim();
                            console.log(data);
                           // return;
                            if(response === 'NotFound') {
                                alert('Email Id Not Found')
                            } else if(response === 'PassNotFound') {
                               alert('PassWord Does Not Match')
                            } else{
                                 // console.log(data);
                                 // return;
                                var response = data.trim();
                                var getAaary = response.split('_,');
                                if (getAaary[0] === '1') {
                                    console.log('SuperAdmin');
                                    window.location.href = 'SuperAdmin/superadmindahboard';

                                } else if(getAaary[0] === '2') {
                                    // console.log('Admin' , getAaary[2]);
                                    if(getAaary[2] == 'First') {
                                        window.location.href = 'changePassword/' + getAaary[3];
                                        console.log('Url' + getAaary[3])
                                    } else if(getAaary[2] == 'Get') {
                                        window.location.href = 'Admin/admindahboard';
                                    } else {
                                        alert('Something Went Wrong');
                                    }

                                    // window.location.href = 'Admin/admindahboard';
                                } else if (getAaary[0] === '3') {
                                    if(getAaary[2] == 'First') {
                                        window.location.href = 'changePassword/' + getAaary[3];
                                        console.log('Url' + getAaary[3])
                                    } else if(getAaary[2] == 'Get') {
                                        window.location.href = 'User/dashboard';
                                    } else {
                                        alert('Something Went Wrong');
                                    }
                                } else {
                                     alert('Something Went Wrong');
                                   // window.location.href = 'User/dashboard';
                                    // console.log('User');
                                }
                              //   console.log(getAaary);
                               //  alert('Succesfuly Login') console.log(data);
                           //   return;
                                 //  window.location.href = 'admindashboard';
                            }
                        },
                    })
                }
                // console.log($('#form_id').parsley().isValid());

            })
        });
    </script>
</body>

</html>
