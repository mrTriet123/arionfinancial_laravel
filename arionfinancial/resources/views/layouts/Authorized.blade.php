<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        @include('Include.head')
        @include('Include.css')
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><span>Arion Financial</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                @if($User->Profile == "")
                                <img src="{!! URL('public/upload/') !!}/user.png" alt="..." class="img-circle profile_img" width="50" height="50">
                                @else
                                <img src="{!! URL('public/upload/') !!}/small_{{$User->Profile}}" alt="..." class="img-circle profile_img" width="50" height="50">
                                @endif
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>{!! Session::get('UserName') !!}</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        
                        <br />
                        
                        @include('Include.sidebar')
                        
                    </div>
                                        
                </div>
                @include('Include.topnavigation')
                
                <div class="right_col" role="main">
                    <div class="">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        
        <div class="right_col" role="main">
            <div class=""></div>
        </div>
        @include('Include.script')
        @yield('internalScript')
    </body>
</html>
