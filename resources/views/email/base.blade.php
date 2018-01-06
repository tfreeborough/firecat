<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body{
            font-family: "Raleway", sans-serif;
            margin:0;
            padding:0;
        }

        a{
            text-decoration: none;
            color:#305196;
            font-weight: bold;
        }

        .link{
            text-decoration: none;
            color:#305196;
            font-weight: bold;
        }

        a.button{
            border:1px solid rgba(150,150,150,0.3);
            padding:1rem;
            border-radius:4px;
            background:rgba(155,155,155,0.1);
            color:#5DBBB7;
        }

        a.button:hover{
            background:rgba(155,155,155,0.2);
        }

        .content{
            max-width:600px;
            margin:auto;
            width:100%;
        }

        .center{
            text-align: center;
        }

        .center p{
            text-align: center;
        }

        .highlight{
            color:#5DBBB7;
        }

        .title{
            color:rgba(55,55,55,0.3);
        }

        p,li{
            color:rgba(55,55,55,0.7);
            font-size:1.4rem;
            text-align: justify;
        }

        ul{
            text-align: left;
        }

        p.small{
            font-size:0.9rem;
            color:rgba(55,55,55,0.3);
        }

        .block{
            padding: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div>
    <div id="email">
        @include('email.banner')


        @yield('content')

        @include('email.footer')
    </div>
</div>
</body>
</html>