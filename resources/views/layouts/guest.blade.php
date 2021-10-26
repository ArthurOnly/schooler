<html>
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   @notifyCss
</head>

<body>
   <div class="h-screen w-screen flex bg-gray-200">
      @yield('content')
   </div>

   <!--Notification-->
   <x:notify-messages />
   @notifyJs
</body>
</html>