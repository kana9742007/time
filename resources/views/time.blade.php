<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>time</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/stats.js/r16/Stats.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.3/dat.gui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/84/three.min.js"></script>
</head>

<body>
  <div id="app">
    <router-view></router-view>
  </div>

  <script src="{{mix('js/app.js')}}"></script>
</body>

</html>