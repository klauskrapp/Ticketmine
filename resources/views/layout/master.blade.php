<!DOCTYPE html><!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
--><!-- Breadcrumb-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ $_title ?? ''  }}</title>

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{get_core_ui_path()}}vendors/simplebar/css/simplebar.css?version={{get_version()}}">
    <link rel="stylesheet" href="{{get_core_ui_path()}}css/vendors/simplebar.css?version={{get_version()}}">
    <!-- Main styles for this application-->
    <link href="{{get_core_ui_path()}}css/style.css?version={{get_version()}}" rel="stylesheet">
    <link href="/css/custom.css?version={{get_version()}}" rel="stylesheet">
    <script src="/js/jquery.js?version={{get_version()}}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script type="text/javascript" src="/plugins/tinymce/tinymce.js?version={{get_version()}}"></script>
    <script type="text/javascript" src="/js/editor.js?version={{get_version()}}"></script>

</head>
<body>


<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include( 'layout.header' )

    @yield( 'content' )



    <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
    </footer>
</div>

<script src="{{get_core_ui_path()}}vendors/@coreui/coreui/js/coreui.bundle.min.js?version={{get_version()}}"></script>
<script src="{{get_core_ui_path()}}vendors/simplebar/js/simplebar.min.js?version={{get_version()}}"></script>

<script src="/js/function.js?version={{get_version()}}"></script>
<script src="/js/grid.js?version={{get_version()}}"></script>
<script src="/js/validator.js?version={{get_version()}}"></script>



<script type="text/javascript">
    var TRANSLATION_GLOBAL_DELETE       = '{{__('global.delete')}}';
    var CORE_UI_PATH                    = '{{get_core_ui_path()}}';
    var TRANSLATION_ATTRIBUTE_OPTIONNAME                    = '{{__('attribute.optionname')}}';
    var TRANSLATION_GLOBAL_POSITION                    = '{{__('global.position')}}';
    var TRANSLATION_GLOBAL_TRANSFER                    = '{{__('global.transfer')}}';
    var TRANSLATION_GLOBAL_FILEUPLOAD_ERROR                    = '{{__('global.error_fileupload')}}';
    var TRANSLATION_GLOBAL_SAVE                    = '{{__('global.save')}}';
    var TRANSLATION_GLOBAL_CLOSE                    = '{{__('global.close')}}';
    var TRANSLATION_CHANGE_ATTRIBUTE                    = '{{__('global.change_attribute')}}';
</script>


@yield( 'modals' )


</body>
</html>
