 @extends('layouts.web')
 @section('title', "Demande d'adhésion")

 @section('body')


     <main id="main">
         <section class="contact" style="margin-top: 10%">
             <div class="container">
                 <div class="section-title">
                     <h2>Demande d'adhésion</h2>
                 </div>
                 <div class="">

                     <div class="login-form-bg h-100">
                         <div class="container h-100">
                             <div class="row justify-content-center h-100">
                                 <div class="col-xl-6">
                                     <div class="form-input-content">
                                         <div class="card login-form mb-0">
                                             <div class="card-body pt-5">
                                                 <p class="text-center">Veuillez remplir soigneusement tous les champs du
                                                     formulaire</p>
                                                 <form class="mt-5 mb-5 login-input was-validated" id="log">

                                                     <div class="form-group mb-2">
                                                         <label for="recipient-name" class="col-form-label">Nom
                                                             complet</label>
                                                         <input type="text" class="form-control" name="name" required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="recipient-name" class="col-form-label">Email</label>
                                                         <input type="email" class="form-control" name="email" required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="recipient-name"
                                                             class="col-form-label">Téléphone</label>
                                                         <input type="text" class="form-control" name="phone"
                                                             maxlength="10" minlength="10" placeholder="Ex : 099xxxxxxx"
                                                             required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="recipient-name" class="col-form-label">Adresse</label>
                                                         <input type="text" class="form-control" name="adresse" required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="recipient-name" class="col-form-label">Date de
                                                             naissance</label>
                                                         <input type="date" class="form-control" name="datenaissance"
                                                             required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Où avez-vous entendu parler de nous ?</label>
                                                         <select name="source" id="" class="form-control"
                                                             required>
                                                             <option>Un ami ou collègue</option>
                                                             <option>Google</option>
                                                             <option>Reseaux sociaux</option>
                                                             <option>Article de blog</option>
                                                             <option>Autre</option>
                                                         </select>
                                                     </div>
                                                     <div class="form-group">
                                                         <label class="col-form-label">Carte d'identité (Passeport, Carte
                                                             d'identité nationale ou carte d'électeur) [Format PDF 1.2Mo
                                                             Max]</label>
                                                         <input type="file" accept=".pdf" class="form-control"
                                                             name="carteidentite[]" required>
                                                         <div id="filecarte"></div>
                                                         <div class="w-100 d-flex justify-content-end">
                                                             <button class="mt-2 btn btn-sm btn-warning addfile"
                                                                 type="button"><i class="fa fa-plus"></i> Ajouter
                                                                 un fichier</button>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label class="col-form-label">Disposez vous d'un permis de travail
                                                             en RDC ?</label>
                                                         <div class="form-check">
                                                             <input class="form-check-input" type="radio"
                                                                 name="permistravail" value="OUI" id="flexRadioDefault1">
                                                             <label class="form-check-label" for="flexRadioDefault1">
                                                                 OUI
                                                             </label>
                                                         </div>
                                                         <div class="form-check">
                                                             <input class="form-check-input" type="radio"
                                                                 name="permistravail" value="NON" id="flexRadioDefault2"
                                                                 checked>
                                                             <label class="form-check-label" for="flexRadioDefault2">
                                                                 NON
                                                             </label>
                                                         </div>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Travaillez vous ?</label>
                                                         <select name="travail" id="" class="form-control"
                                                             required>
                                                             <option></option>
                                                             <option>NON</option>
                                                             <option>OUI : Privé</option>
                                                             <option>OUI : Public</option>
                                                         </select>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label class="col-form-label">Veuillez joindre votre CV, votre
                                                             diplôme de médecine, votre CNOM et vos diplômes post médecine
                                                             générale si vous en avez. [Format PDF 1.2Mo Max]</label>
                                                         <input type="file" accept=".pdf" class="form-control"
                                                             name="files[]" required>
                                                         <div id="filefiles"></div>
                                                         <div class="w-100 d-flex justify-content-end">
                                                             <button class="mt-2 btn btn-sm btn-warning addfile2"
                                                                 type="button"><i class="fa fa-plus"></i> Ajouter
                                                                 un fichier</button>
                                                         </div>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label class="col-form-label">Votre image de profil. [Format
                                                             png,jpeg,jpg 1.2Mo Max]</label>
                                                         <input type="file" accept=".png,.jpeg,,jpg"
                                                             class="form-control" name="image" required>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label class="col-form-label">Parmi les langues suivantes
                                                             lesquelles parlez vous ?</label>
                                                         <div class="form-group">
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox1"
                                                                     value="Francais" checked>
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox1">Francais</label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox2"
                                                                     value="Anglais">
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox2">Anglais</label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox3"
                                                                     value="Tshiluba">
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox3">Tshiluba
                                                                 </label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox4"
                                                                     value="Lingala">
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox4">Lingala
                                                                 </label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox5"
                                                                     value="Kikongo">
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox5">Kikongo
                                                                 </label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                                 <input name="langues[]" class="form-check-input"
                                                                     type="checkbox" id="inlineCheckbox6"
                                                                     value="Kiswahili">
                                                                 <label class="form-check-label"
                                                                     for="inlineCheckbox6">Kiswahili
                                                                 </label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Etes-vous disposé à être disponible
                                                             lorsqu'on a besoin de vous 24/24h par une personne ayant besoin
                                                             de vos services ?
                                                         </label>
                                                         <select name="disponibilite" id="" class="form-control"
                                                             required>
                                                             <option></option>
                                                             <option>NON</option>
                                                             <option>OUI</option>
                                                         </select>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Avez vous déjà travaillé en ligne avant ?
                                                         </label>
                                                         <select name="travailenligne" id=""
                                                             class="form-control" required>
                                                             <option></option>
                                                             <option>NON</option>
                                                             <option>OUI</option>
                                                         </select>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Quelles sont vos plus grandes forces?
                                                             Enumerez-en 5 dans l'ordre.
                                                         </label>
                                                         <textarea name="forces" id="" cols="30" rows="3" required class="form-control"></textarea>
                                                     </div>
                                                     <div class="form-group mb-2">
                                                         <label for="">Vous êtes médecin</label>
                                                         <select name="categorie_id" id="" class="form-control"
                                                             required>
                                                             <option></option>
                                                             @foreach ($categories as $el)
                                                                 <option value="{{ $el->id }}">
                                                                     {{ ucfirst($el->categorie) }}</option>
                                                             @endforeach
                                                         </select>
                                                     </div>
                                                     <div class="form-group">
                                                         <div id="rep"></div>
                                                     </div>
                                                     <div class="text-center">
                                                         <button class="btn btn-sm btn-info"><span></span>
                                                             Envoyer</button>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>


                 </div>
             </div>
         </section>
     </main>


 @endsection

 @section('js')
     <script>
         $(function() {
             $('#log').submit(function() {
                 event.preventDefault();
                 var form = $(this);
                 var btn = $(':submit', form);
                 btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                 var data = new FormData(form[0]);
                 $(':input', form).attr('disabled', true);
                 var rep = $('#rep', form);
                 rep.stop().slideUp();
                 $.ajax({
                     type: 'post',
                     data: data,
                     contentType: false,
                     processData: false,
                     url: '{{ route('newdoctor') }}',
                     success: function(data) {
                         if (data.success) {
                             form[0].reset();
                             rep.removeClass().addClass('alert alert-success');
                             btn.hide();
                         } else {
                             rep.removeClass().addClass('alert alert-danger');
                         }
                         rep.html(data.message).slideDown();
                     },
                     error: function(data) {
                         rep.removeClass().addClass('alert alert-danger').html(
                             "Erreur, veuillez réessayer.").slideDown();
                     }
                 }).always(function() {
                     btn.find('span').removeClass();
                     $(':input', form).attr('disabled', false);
                 });
             });

             $('.addfile').click(function() {
                 var i = `
                    <div class='d-flex'>
                    <input type="file" accept=".pdf" class="form-control mt-2"
                        name="carteidentite[]" required>
                        <button class="mt-2 btn btn-sm btn-danger removefile" style="margin-left:10px"
                                                                 type="button"><i class="fa fa-times-circle"></i></button>
                    </div>
                    `;
                 $(i).insertBefore('#filecarte');
                 removefile();
             });

             $('.addfile2').click(function() {
                 var i = `
                    <div class='d-flex'>
                    <input type="file" accept=".pdf" class="form-control mt-2"
                                                             name="files[]" required>
                        <button class="mt-2 btn btn-sm btn-danger removefile" style="margin-left:10px"
                                                                 type="button"><i class="fa fa-times-circle"></i></button>
                    </div>
                    `;
                 $(i).insertBefore('#filefiles');
                 removefile();
             });


             function removefile() {
                 $('.removefile').off('click').click(function() {
                     $(this).closest('div').remove();
                 })
             }
         })
     </script>
 @endsection
