<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel='stylesheet' type='text/css' />


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        
                <div class="top-right links">
                    @if (Session::has('nombre'))
                        <a href="#">{{ Session::get('nombre')}}</a>
                         <a href='javascript:void(0);' onclick="window.open('{{ url('/consumo') }}', '_blank', 'width=700,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=100,screeny=0');">Registro de atencion</a>
                         <a href="{{ url('/excelestudiantes') }}">Descargar excel </a>
                        <a href="{{ url('cerrarSesion') }}">Salir</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                       
                    @endif
                </div>
            
            @if (!Session::has('horaBloqueo') && !Session::has('dni_usuario'))
                 <form action="{{ url('/iniciarSesion') }}" method="POST">
                    {{csrf_field()}}
                    Dni:<input type="text" name="dni"><br>
                     Contraseña:<input type="password" name="password"><br>
                    <button>Iniciar sesión</button>
                </form>
            @else
                <a href="{{ url('/log') }}">intertantar otra vez!!</a>    
            @endif
            <div class="content">
                <div class="title m-b-md">
                    Bienestar
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="{{url('consumo') }}">Consumo</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>

                </div>
                @include('parcial.mensajeGeneral')



            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

    </body>
</html>
