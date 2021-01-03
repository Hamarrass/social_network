<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <link rel="stylesheet" href="{{mix('/css/theme.css')}}">
</head>
        <body>
            @if(session()->has('status'))
               <h3 style="color:green">
                   {{session()->get('status')}}
               </h3>
            @endif
            <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}"> Home  </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}"> About </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}"> posts </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('posts.create')}}"> new post </a></li>
                </ul>
            </nav>

          <div class="container ">
            @yield('content')
          </div>
        </body>
        <script src="{{mix('/js/app.js')}}"></script>
</html>

<!--video 9...
