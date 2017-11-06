<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Page not found</h1>
        @if(\Auth::user() != null)
            <a href="{!! route('ViewProfile') !!}">Go to Profile Page</a>
        @else
            <a href="{!! url('login') !!}">Go to login Page</a>
        @endif
    </body>
</html>
