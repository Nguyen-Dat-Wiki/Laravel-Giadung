<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.layouts.head')
</head>
<body>
    @include('client.layouts.menu')
    
    @yield('slibar')
    <div class="main">
        <div class="container">

            @yield('content_new')

            @yield('category_1')
            @yield('category_2')
            @yield('category_3')
            @yield('category_4')
            @yield('category_5')
            
            @yield('main-header')
            @yield('main-middle')
            @yield('main-bottom')
            
            
            @yield('tieuchi')
        </div>
    </div>
    @include('client.layouts.footer')
    @include('client.layouts.script')
</body>
</html>