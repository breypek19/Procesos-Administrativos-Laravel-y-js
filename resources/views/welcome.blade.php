<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-16x16.png')}}">

        <title>Bienvenido- Gestion Ipuc</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(".jpg"); /* The image used */
  background-color:#454545; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
                
                color: white;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                overflow-x:hidden;
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
                right: 50px;
                top: 30px;
            }

            .content {
                text-align: center;
                
            }
            .mark{
    margin-left: 6px;
    font-size: 78px;
    overflow: hidden;
    white-space: nowrap;
    border-right: 2px solid ;
    transform: translateY(-50%);    
   animation:mark 10s .2s 1 both, mark1 600ms  infinite normal;
   font-family:"New Century Schoolbook", Times, serif;
   

}
@keyframes  mark{
    0%{width: 0; }
    100% {width: 5.1em; }
}
@keyframes mark1{
    0%{border-right-color: slategray;}  /** solo el borde derecho de la caja es el que va a parpadear*/
    100%{border-right-color:transparent }
}


            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
               
            }

            #login{
             font-size:20px;   
            padding:12px 30px;
            color: brown;
            
            box-sizing:border-box;
            background-color: beige;
            border-radius:8px;
            transition: font-size .7s;
            }

            #login:hover{
                font-size:23px;
                
            }

            .m-b-md {
                margin-bottom: 10px;
            }

            p{
                
                margin-bottom:-19px;
                font-size:22px;
                font-family:Courier, "Lucida Console", monospace
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a id="login" href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="mark  m-b-md">
                    Bienvenido
                </div>
                <div>
                    <p>Gestion Administrativa</p>
                    <p>Ipuc Central Tierralta</p>
                </div>

            </div>
        </div>
    </body>
</html>
