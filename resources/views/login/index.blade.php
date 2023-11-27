<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
-->

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{get_core_ui_path()}}vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="{{get_core_ui_path()}}css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="{{get_core_ui_path()}}css/style.css" rel="stylesheet">
</head>
<body>
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <form method="post" action="{{url('dologin')}}">
                                @csrf
                                <h1>{{__('login.login')}}</h1>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                          <svg class="icon">
                                            <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                          </svg>
                                    </span>
                                    <input class="form-control" name="email" type="text" placeholder="{{__('login.email')}}">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" name="password" type="password" placeholder="{{__('login.password')}}">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4" type="button">{{__('login.do_login')}}</button>
                                    </div>
                                    <!--<div class="col-6 text-end">
                                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                    </div>-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{get_core_ui_path()}}vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="{{get_core_ui_path()}}vendors/simplebar/js/simplebar.min.js"></script>
</body>
</html>
