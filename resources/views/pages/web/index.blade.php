 @extends('layouts.web')
 @section('title', 'Accueil')

 @section('body')
     <section id="hero" class="d-flex align-items-center">
         <div class="container">
             <h1>Bienvenue chez {{ config('app.name') }}</h1>
             <h2>Votre Santé est notre Priorité.</h2>
             <a href="#contact" class="btn-get-started scrollto">Commencer</a>
         </div>
     </section>

     <main id="main">

         <section id="why-us" class="why-us">
             <div class="container">

                 <div class="row">
                     <div class="col-lg-4 d-flex align-items-stretch">
                         <div class="content">
                             <h3>Pourquoi choisir {{ config('app.name') }}?</h3>
                             <p>
                                 Pas besoin de rendez-vous ni de file d'attente, discutez instantanément avec un médecin
                                 du
                                 confort de votre chambre, salon, bureau, etc. à tout moment et depuis n'importe quel
                                 endroit le globe. Docta, ton ami médecin.
                             </p>
                             {{-- <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div> --}}
                         </div>
                     </div>
                     <div class="col-lg-8 d-flex align-items-stretch">
                         <div class="icon-boxes d-flex flex-column justify-content-center">
                             <div class="row">
                                 <div class="col-xl-4 d-flex align-items-stretch">
                                     <div class="icon-box mt-4 mt-xl-0">
                                         <i class="bx bx-check-circle"></i>
                                         <h4>Rassurant</h4>
                                         <p>
                                             Docta met à votre disposition des professionnels pour que votre joie soit
                                             parfaite. Votre bien être est notre priorité !
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-xl-4 d-flex align-items-stretch">
                                     <div class="icon-box mt-4 mt-xl-0">
                                         <i class="bx bx-check-circle"></i>
                                         <h4>Rapide</h4>
                                         <p>
                                             Le service est instantané, vous avez besoin de parler à un médecin ? Choisissez
                                             Docta !
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-xl-4 d-flex align-items-stretch">
                                     <div class="icon-box mt-4 mt-xl-0">
                                         <i class="bx bx-check-circle"></i>
                                         <h4>Discret</h4>
                                         <p>Renseignez-vous auprès d'un médecin spécialisé en toute discrétion, aucune de
                                             vos données ne sera conservée.
                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </section>

         <section id="counts" class="counts">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-3 col-md-6">
                         <div class="count-box">
                             <i class="fas fa-user-md"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1"
                                     class="purecounter"></span>+</span>
                             <p>Docteurs</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                         <div class="count-box">
                             <i class="far fa-hospital"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1"
                                     class="purecounter"></span>
                             </span>
                             <p>Departements</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                         <div class="count-box">
                             <i class="fas fa-user-group"></i>
                             <span class="d-flex justify-content-center">
                                 <span class="d-flex justify-content-center">
                                     <span data-purecounter-start="0" data-purecounter-end="2028"
                                         data-purecounter-duration="1" class="purecounter"></span>+
                                 </span>
                             </span>
                             <p>Utilisateurs</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                         <div class="count-box">
                             <i class="fas fa-phone"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="3000" data-purecounter-duration="1"
                                     class="purecounter"></span>+
                             </span>
                             <p>Appels</p>
                         </div>
                     </div>

                 </div>

             </div>
         </section>
         <section class="contact pb-0" id="about">
             <div class="container">
                 <div class="section-title">
                     <h2>Docta, qu'est ce ?</h2>
                     <p>
                         <i>Docta, ton ami médecin</i> est une plateforme virtuelle d'interaction instantanée avec un
                         médecin
                         qui a pour but de vous accompagner dans toutes vos questions et préoccupations d'ordre médical
                         en ce qui concerne votre santé ou celle de vos proches sans avoir à vous déplacer.
                     </p>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Mission</h2>
                     <p>
                         Docta, ton ami médecin a pour mission de vous accompagner dans toutes vos questions relatives à
                         la santé ( votre santé ou celle de vos proches ), en mettant à votre disposition des médecins
                         ayant suivi un cursus normal d'études de médecine et inscrits régulièrement à l'ordre des
                         médecins et avec une expérience minimum de 3 ans de service clinique.
                     </p>
                     <p>
                         Docta, ton ami médecin n'est pas un hôpital virtuel, mais travaille en collaboration avec des
                         hôpitaux, services d'imagerie ou de laboratoires comme partenaires pour continuité ou relais
                         physique si avéré nécessaire par le médecin contacté via la plateforme; ce qui sera disponible
                         avec le service premium.
                     </p>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2> Services offerts</h2>
                     <ul>
                         <li>La version simple vous permet d'interagir avec un médecin généraliste de manière
                             instantanée
                             sur les questions ou préoccupations qui vous dérangent et cela par appel ou par
                             messagerie
                             (avec possibilité de joindre un fichier et/ou faire un audio).</li>
                         <li>
                             La version premium, bientôt disponible permet une interaction avec un médecin
                             spécialiste
                             d'une filière de votre choix par appel ou messagerie avec possibilité d'être recommandé
                             dans
                             une structure sanitaire partenaire à moindre frais pour un suivi médical si avéré
                             important
                             par le médecin.
                         </li>
                     </ul>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Facturation</h2>
                     <p>Le payement se fait principalement par :
                     </p>
                     <div class="d-flex justify-content-center">
                         <ul class="text-start">
                             <li><i class="fa fa-check-circle text-success"></i> Mobile money : Airtel money, Orange
                                 money, M-pesa, Afrimoney;</li>
                             <li><i class="fa fa-check-circle text-success"></i> Online banking via carte bancaire </li>
                         </ul>
                     </div>

                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Pourquoi choisir Docta ?</h2>
                     <p>Docta, ton ami médecin vient réellement vous procurer un ami médecin et vous faire gagner du
                         temps en vous
                         donnant la capacité de le joindre pour de manière instantanée via son application depuis le lieu
                         où vous êtes(
                         chambre, bureau, taxi, etc.)
                     </p>

                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2> Docta, y a-t-il des restrictions ? </h2>
                     <p>Docta, est réellement ton ami médecin et ne connait donc pas de restriction dans son service en
                         ce qui concerne : la religion, la race, le sexe, l'âge, l'appartenance tribale, etc..Docta, se
                         limite à vous répondre et vous accompagner dans la bonne compréhension et prise de décision pour
                         votre bonne santé.
                     </p>

                 </div>
             </div>
         </section>


         <section id="contact" class="contact">
             <div class="container">
                 <div class="section-title">
                     <h2>Contact</h2>
                     <p>Besoin de plus d'informations ? n'hésitez pas à nous contacter.</p>
                 </div>
             </div>
             <div>
                 <iframe style="border:0; width: 100%; height: 350px;"
                     src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125032.68739457447!2d27.41979049233817!3d-11.675162240022242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19723ea34874cbd9%3A0xa1c6f5a74f805b2f!2sLubumbashi!5e0!3m2!1sen!2scd!4v1715285465474!5m2!1sen!2scd"
                     allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div>
             <div class="container">
                 <div class="row mt-5">
                     <div class="col-lg-4">
                         <div class="info">
                             <div class="address">
                                 <i class="bi bi-geo-alt"></i>
                                 <h4>Adresse:</h4>
                                 <p>N°465, Av/ kintambo, golf faustin, commune Annexe, Lubumbashi, RDC </p>
                             </div>

                             <div class="email">
                                 <i class="bi bi-envelope"></i>
                                 <h4>Email:</h4>
                                 <p>contac@docta-tam.com</p>
                             </div>

                             <div class="phone">
                                 <i class="bi bi-phone"></i>
                                 <h4>Apples:</h4>
                                 <p>
                                     <a href="tel:+243851810869" class="text-muted">+243 85 18 10 869</a>
                                 </p>
                             </div>

                         </div>

                     </div>

                     <div class="col-lg-8 mt-5 mt-lg-0">

                         <form id="fcont" action="#" class="php-email-form">
                             @csrf
                             <div class="row">
                                 <div class="col-md-6 form-group">
                                     <input type="text" name="name" class="form-control" id="name"
                                         placeholder="Votre nom" required>
                                 </div>
                                 <div class="col-md-6 form-group mt-3 mt-md-0">
                                     <input type="email" class="form-control" name="email" id="email"
                                         placeholder="Votre Email ou Phone" required>
                                 </div>
                             </div>
                             <div class="form-group mt-3">
                                 <input type="text" class="form-control" name="subject" id="subject"
                                     placeholder="Subjet" required>
                             </div>
                             <div class="form-group mt-3">
                                 <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                             </div>
                             <div class="my-3">
                                 <div id="rep" class="loading"></div>
                             </div>
                             <div class="text-center"><button type="submit"><span></span> Envoyer</button></div>
                         </form>

                     </div>

                 </div>

             </div>
         </section>

     </main>
 @endsection
