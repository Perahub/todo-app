<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            body {
                background: #ffffff
            }

            .card {
                height: 320px
            }

            .forms-inputs {
                position: relative
            }

            .forms-inputs span {
                position: absolute;
                top: -18px;
                left: 10px;
                background-color: #fff;
                padding: 5px 10px;
                font-size: 15px
            }

            .forms-inputs input {
                height: 50px;
                border: 2px solid #000
            }

            .forms-inputs input:focus {
                box-shadow: none;
                outline: none;
                border: 2px solid #000
            }

            .success-data {
                display: flex;
                flex-direction: column
            }

            .bxs-badge-check {
                font-size: 90px
            }
        </style>
    </head>
    <body>
        <div id="app">
            <!-- <login-component></login-component> -->
            <router-view></router-view>
        </div>  
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
