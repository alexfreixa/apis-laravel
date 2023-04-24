<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Dashboard</title>
    <link rel="stylesheet" href="{{asset('/css/dashboard.css')}}">
</head>
<body id="body" class="">
    @include('dashboard.header')
    <div class="main-content">
        @yield('content')
    </div>
    @include('dashboard.footer')
 </body>
</html>

@yield('footer')