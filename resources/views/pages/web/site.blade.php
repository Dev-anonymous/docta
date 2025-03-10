 @extends('layouts.web')
 @section('title', $title)
 @section('meta')
     @include('components.defaultmeta')
 @endsection
 @section('body')


     <main id="main">
         <section class="contact" style="margin-top: 10%">
             <div class="container">
                 <div class="section-title">
                     <h2>{{ $title }}</h2>
                 </div>
                 <div class="">
                     {!! $text !!}
                 </div>
             </div>
         </section>
     </main>
 @endsection
