 @extends('layouts.web')
 @section('title', 'Politique de confidentialité')

 @section('body')


     <main id="main">
         <section class="contact" style="margin-top: 10%">
             <div class="container">
                 <div class="section-title">
                     <h2>Politique de confidentialité</h2>
                 </div>
                 <div class="">
                     {!! $text !!}
                 </div>
             </div>
         </section>
     </main>
 @endsection
