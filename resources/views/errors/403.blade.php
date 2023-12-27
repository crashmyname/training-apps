{{-- @extends('errors::minimal') --}}

@section('title', __('Forbidden'))
{{-- @section('code', '403') --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forbidden Access - Training Apps</title>
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/bootstrap.css')}}">
    
    <link rel="shortcut icon" href="{{asset('img/ise.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/app.css')}}">
</head>
<body>
    <div id="error">
        
<div class="container text-center pt-32">
    <h1 class='error-title'>403</h1>
    <p>Forbidden Access</p>
    <a href="{{route('dashboard')}}" class='btn btn-primary'>Go Home</a>
</div>

        <div class="footer pt-32">
            <p class="text-center">Copyright &copy; Fadli 2023</p>
        </div>
    </div>
</body>
</html>
@section('message', __($exception->getMessage() ?: 'Forbidden'))
