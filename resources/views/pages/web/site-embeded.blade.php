 <html lang="fr">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>{{ $title }}</title>
     <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

 </head>

 <body>
     <div class="" style="padding: 10px">
         <div class="section-title">
             <h2>{{ $title }}</h2>
         </div>
         <div class="">
             {!! $text !!}
         </div>

         <div class="d-flex justify-content-center" style="margin-top: 20px; margin-bottom: 20px; font-weight: bolder;">
            <a href="{{ route('terme00', ['show'=>'terme']) }}" class="mr-2">Termes et conditions</a> |
            <a href="{{ route('terme00', ['show'=>'politique']) }}" class="mr-2">Politique de confidentialité</a> |
            <a href="{{ route('terme00', ['show'=>'mention']) }}" class="mr-2">Mentions légales</a>
         </div>
     </div>
 </body>

 </html>
