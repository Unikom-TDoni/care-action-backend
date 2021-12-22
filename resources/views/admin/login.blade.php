<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{URL::asset('images')}}/care_action.png">

        <title>Login</title>

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

        <!-- Custom Files -->
        <link href="{{URL::asset('assets')}}/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/css/style.css" rel="stylesheet" type="text/css" />

        <script src="{{URL::asset('assets')}}/js/modernizr.min.js"></script>
        
    </head>
    <body>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Sign In</h3>
                </div> 

                <div class="panel-body">                
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form-horizontal m-t-20" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control input-lg " type="text" required="" placeholder="Username" id="username" name="username" :value="old('username')">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="password" required="" placeholder="Password" id="password" name="password">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="remember_me" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>     
                </div>                                 
            </div>
        </div>
        
    	<script>
            var resizefunc = [];
        </script>
    	<script src="{{URL::asset('assets')}}/js/jquery.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/bootstrap.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/waves.js"></script>
        <script src="{{URL::asset('assets')}}/js/wow.min.js"></script>
        <script src="{{URL::asset('assets')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="{{URL::asset('assets')}}/js/jquery.scrollTo.min.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-detectmobile/detect.js"></script>
        <script src="{{URL::asset('assets')}}/assets/fastclick/fastclick.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="{{URL::asset('assets')}}/assets/jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="{{URL::asset('assets')}}/js/jquery.app.js"></script>
	
	</body>
</html>

