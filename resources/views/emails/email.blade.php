<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
</head>
<body>
    <div class="card container text-center height-100vh">
        <div class="card-head">
            <div class="text-left navbar-brand-wrapper w-100 d-flex justify-content-center mt-4">
                <a class="navbar-brand brand-logo" href="/"><img src="/assets/images/logo-dark.png" alt=""></a>
            </div>
        </div>
        <div class="card-body">
            @yield('content')
        </div>
    </div>
</body>
</html>