 @extends('layouts.web')
 @section('title', 'Mentions légales')

 @section('body')


     <main id="main">
         <section class="contact" style="margin-top: 10%">
             <div class="container">
                 <div class="section-title">
                     <h2>Mentions légales</h2>
                 </div>
                 <div class="">
                     {!! $text !!}
                 </div>
             </div>
         </section>
     </main>
 @endsection
