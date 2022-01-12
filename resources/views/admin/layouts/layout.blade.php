<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{URL::asset('images')}}/care_action.png">

        <title>Admin</title>

        <!-- Base Css Files -->
        <link href="{{URL::asset('assets')}}/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="{{URL::asset('assets')}}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets')}}/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets')}}/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="{{URL::asset('assets')}}/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{URL::asset('assets')}}/css/waves-effect.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{URL::asset('assets')}}/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <!-- sweet alerts -->
        <link href="{{URL::asset('assets')}}/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!--venobox lightbox-->
        <link rel="stylesheet" href="{{URL::asset('assets')}}/assets/magnific-popup/magnific-popup.css"/>
        
        <!-- Dropzone css -->
        <link href="{{URL::asset('assets')}}/assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />

        <!--bootstrap-wysihtml5-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link href="{{URL::asset('assets')}}/assets/summernote/summernote.css" rel="stylesheet" />

        <!-- Plugins css-->
        <link href="{{URL::asset('assets')}}/assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
        {{-- <link href="{{URL::asset('assets')}}/assets/toggles/toggles.css" rel="stylesheet" /> --}}
        <link href="{{URL::asset('assets')}}/assets/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets')}}/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets')}}/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets')}}/assets/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/assets/jquery-multi-select/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/assets/select2/select2.css" rel="stylesheet" type="text/css" />

        <!-- Custom Files -->
        <link href="{{URL::asset('assets')}}/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{URL::asset('assets')}}/js/modernizr.min.js"></script>
        @livewireStyles
    </head>

    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{url('admin')}}" class="logo"><span>Care Action</span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{URL::asset('images/default.png')}}" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#ubah-pw"><i class="fa fa-lock"></i> Change Password</a></li>
                                        <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
         


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="{{URL::asset('images/default.png')}}" alt="" class="thumb-md img-circle">
                        </a>
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle">{{ Auth::user()->name }}</a>                                
                            </div>

                            <p class="text-muted m-0">Administrator</p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ Route('dashboard') }}" class="waves-effect  {{{ (Request::is('admin') ? 'active' : '') }}}"><i class="md md-dashboard"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ Route('quotes') }}" class="waves-effect  {{{ (Request::segment(2)=='quotes' ? 'active' : '') }}}"><i class="md md-format-quote"></i>Quotes</a>
                            </li>
                            <li>
                                <a href="{{ Route('activity') }}" class="waves-effect  {{{ (Request::segment(2)=='activity' ? 'active' : '') }}}"><i class="md md-beenhere"></i>Activity</a>
                            </li>
                            <li>
                                <a href="{{ Route('category') }}" class="waves-effect  {{{ (Request::segment(2)=='category' ? 'active' : '') }}}"><i class="md md-view-list"></i>Category</a>
                            </li>
                            <li>
                                <a href="{{ Route('news') }}" class="waves-effect  {{{ (Request::segment(2)=='news' ? 'active' : '') }}}"><i class="fa fa-newspaper-o"></i>News</a>
                            </li>
                            <li>
                                <a href="{{ Route('customer') }}" class="waves-effect  {{{ (Request::segment(2)=='customer' ? 'active' : '') }}}"><i class="fa fa-user"></i>Customer</a>
                            </li>
                            <li>
                                <a href="{{ Route('users') }}" class="waves-effect  {{{ (Request::segment(2)=='users' ? 'active' : '') }}}"><i class="fa fa-users"></i> Users</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->
            
            {{-- MODAL UBAH PASSWORD --}}
            <div id="ubah-pw" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog"> 
                    <div class="modal-content"> 
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">Change Password</h4> 
                        </div> 
                        
                        <form action="{{ Route('users.password') }}" method="post" enctype="multipart/form-data" id="modalform">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">Old Password</label> 
                                            <input type="password" class="form-control" id="old_password" name="old_password" value="" required>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">New Password</label> 
                                            <input type="password" class="form-control" id="new_password" name="new_password" value="" required>
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">Confirm New Password</label> 
                                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" value="" required>
                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close <i class="fa fa-close"></i></button> 
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="changePassword()">Save <i class="fa fa-save"></i></button> 
                            </div> 
                        </form>
                    </div> 
                </div>
            </div><!-- /.modal -->

            @yield('content')

                <footer class="footer primary text-center">
                    <marquee><b>Copyright © 2021</b></marquee>
                </footer>

            </div>
        </div>
        <!-- END wrapper -->

        <script type="text/javascript">
            function changePassword()
            {
                if($("#old_password").val() == "")
                {
                    alert("Please fill out Old Password field");
                    return false;
                }

                if($("#new_password").val() == "")
                {
                    alert("Please fill out New Password field");
                    return false;
                }

                if($("#new_password").val() != $("#confirm_new_password").val())
                {
                    alert("Confirm Password didn't match!");
                    return false;
                }

                $.ajax(
                {
                    url: "{{ Route('users.password') }}",
                    type: 'POST',
                    data: 
                    {
                        old_password: $("#old_password").val(),
                        password: $("#new_password").val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response)
                    {
                        if(response.status != "OK")
                        {
                            alert(response.message);
                            return false;
                        }
                        else
                        {
                            swal({
                                title: "Success!",
                                text: "Password changed successfully!",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }
                    }
                });
                
                return false;
            }
        </script>
    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  --> 
        <script src="{{URL::asset('assets')}}/js/jquery.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/bootstrap.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/waves.js"></script>
        <script src="{{URL::asset('assets')}}/js/wow.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="{{URL::asset('assets')}}/js/jquery.scrollTo.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/chat/moment-2.2.1.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-detectmobile/detect.js"></script>
        <script src="{{URL::asset('assets')}}/assets/fastclick/fastclick.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-blockui/jquery.blockUI.js"></script>

        <!-- sweet alerts -->
        <script src="{{URL::asset('assets')}}/assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/sweet-alert/sweet-alert.init.js"></script>
        
        <!-- Page Specific JS Libraries -->
        <script src="{{URL::asset('assets')}}/assets/dropzone/dropzone.min.js"></script>

        <!-- Examples -->
        <script src="{{URL::asset('assets')}}/assets/magnific-popup/magnific-popup.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-datatables-editable/jquery.dataTables.js"></script> 
        <script src="{{URL::asset('assets')}}/assets/datatables/dataTables.bootstrap.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-datatables-editable/datatables.editable.init.js"></script>

        <!-- flot Chart -->
        {{-- <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.time.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.resize.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.pie.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.selection.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.stack.js"></script>
        <script src="{{URL::asset('assets')}}/assets/flot-chart/jquery.flot.crosshair.js"></script> --}}

        <!-- Counter-up -->
        <script src="{{URL::asset('assets')}}/assets/counterup/waypoints.min.js" type="text/javascript"></script>
        <script src="{{URL::asset('assets')}}/assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        
        <!-- CUSTOM JS -->
        <script src="{{URL::asset('assets')}}/js/jquery.app.js"></script>
        
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

        <!--form validation init-->
        <script src="{{URL::asset('assets')}}/assets/summernote/summernote.min.js"></script>

        <script>
            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();

                $('.summernote').summernote({
                    height: 200,                 // set editor height

                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor

                    focus: true                 // set focus to editable area after initializing summernote
                });

            });
        </script>


        <!-- Dashboard -->
        {{-- <script src="{{URL::asset('assets')}}/js/jquery.dashboard.js"></script> --}}

        <!-- Chat -->
        <script src="{{URL::asset('assets')}}/js/jquery.chat.js"></script>

        <!-- Todo -->
        <script src="{{URL::asset('assets')}}/js/jquery.todo.js"></script>

         <!--Data Table -->
        <script src="{{URL::asset('assets')}}/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>

        <script src="{{URL::asset('assets')}}/assets/tagsinput/jquery.tagsinput.min.js"></script>
        {{-- <script src="{{URL::asset('assets')}}/assets/toggles/toggles.min.js"></script> --}}
        <script src="{{URL::asset('assets')}}/assets/bootstrap-toggle/bootstrap-toggle.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/timepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/colorpicker/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/jquery-multi-select/jquery.multi-select.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/jquery-multi-select/jquery.quicksearch.js"></script>
        <script src="{{URL::asset('assets')}}/assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/spinner/spinner.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/select2/select2.min.js" type="text/javascript"></script>

        <script>
            jQuery(document).ready(function() {
                    
                // Tags Input
                jQuery('.tags').tagsInput({width:'auto'});

                // Form Toggles
                // jQuery('.toggle').toggles({on: true});

                // Time Picker
                jQuery('#timepicker').timepicker({defaultTIme: false});
                jQuery('#timepicker2').timepicker({showMeridian: false});
                jQuery('#timepicker3').timepicker({minuteStep: 15});

                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple').datepicker({
                    numberOfMonths: 3,
                    showButtonPanel: true
                });
                //colorpicker start

                $('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
                $('.colorpicker-rgba').colorpicker();


                //multiselect start

                $('#my_multi_select1').multiSelect();
                $('#my_multi_select2').multiSelect({
                    selectableOptgroup: true
                });

                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                //spinner start
                $('#spinner1').spinner();
                $('#spinner2').spinner({disabled: true});
                $('#spinner3').spinner({value:0, min: 0, max: 10});
                $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
                //spinner end

                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
            });
        </script>

        <script type="text/javascript">
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>

         <script type="text/javascript" src="{{URL::asset('assets')}}/assets/gallery/isotope.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets')}}/assets/magnific-popup/magnific-popup.js"></script> 
          
        <script type="text/javascript">
            $(window).load(function(){
                var $container = $('.portfolioContainer');
                $container.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });

                $('.portfolioFilter a').click(function(){
                    $('.portfolioFilter .current').removeClass('current');
                    $(this).addClass('current');

                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    });
                    return false;
                }); 
            });
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        </script>

        @if(Session::has('alert_swal'))
            <script type="text/javascript">{!! session('alert_swal') !!}</script>
        @endif
    

        @livewireScripts 
        <script src="/livewire/livewire.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    </body>
</html>