 @extends('layouts.web')
 @section('title', 'Demande du profil Docta')

 @section('body')


     <main id="main">
         <section class="contact" style="margin-top: 10%">
             <div class="container">
                 <div class="section-title">
                     <h2 class="mt-5">Demande du profil Docta</h2>
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
                                                     <div class="form-group my-3">
                                                         <div class="form-check form-check-inline">
                                                             <input name="accept" class="form-check-input"
                                                                 type="checkbox" id="inlineCheckbox1001" value="Francais"
                                                                 required>
                                                             <label class="form-check-label"
                                                                 for="inlineCheckbox1001">J'accepte <a href="#"
                                                                     data-bs-toggle="modal" data-bs-target="#acceptmdl"
                                                                     onclick="event.preventDefault()">le contral de
                                                                     consultation Docta </a>
                                                             </label>
                                                         </div>
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

     <div class="modal fade" id="rracceptmdl" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Contrat de consultation Docta</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                             aria-hidden="true">X</span>
                     </button>
                 </div>
                 <form id="fadd">
                     <div class="modal-body">

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>

     <div class="modal fade" id="acceptmdl" tabindex="-1" role="dialog" aria-hidden="true"
         data-bs-backdrop="static">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content ">
                 <div class="modal-body">
                     <div class="p-2 rounded-3" style="background-color: rgba(0, 0, 0, 0.075)">
                         <div class="d-flex justify-content-between">
                             <h2>Contrat de consultation Docta</h2>
                             <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                         </div>
                     </div>
                     <div class="" style="margin-top: 50px">
                         <style type="text/css">
                             h1 {
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: bold;
                                 text-decoration: none;
                                 font-size: 16pt;
                             }

                             h2 {
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: bold;
                                 text-decoration: none;
                                 font-size: 10pt;
                             }

                             .p,
                             p {
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: normal;
                                 text-decoration: none;
                                 font-size: 10pt;
                                 margin: 0pt;
                             }

                             .s1 {
                                 color: #00f;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: normal;
                                 text-decoration: underline;
                                 font-size: 10pt;
                             }

                             .a {
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: normal;
                                 text-decoration: none;
                                 font-size: 10pt;
                             }

                             li {
                                 display: block;
                             }

                             #l1 {
                                 padding-left: 0pt;
                                 counter-reset: c1 1;
                             }

                             #l1>li>*:first-child:before {
                                 counter-increment: c1;
                                 content: counter(c1, decimal) ". ";
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: bold;
                                 text-decoration: none;
                                 font-size: 10pt;
                             }

                             #l1>li:first-child>*:first-child:before {
                                 counter-increment: c1 0;
                             }

                             #l2 {
                                 padding-left: 0pt;
                             }

                             #l2>li>*:first-child:before {
                                 content: "- ";
                                 color: black;
                                 font-family: Arial, sans-serif;
                                 font-style: normal;
                                 font-weight: normal;
                                 text-decoration: none;
                                 font-size: 10pt;
                             }
                         </style>
                         <h1
                             style="
                          padding-top: 3pt;
                          padding-left: 34pt;
                          text-indent: 0pt;
                          text-align: center;
                        ">
                             CONTRAT D’OBTENTION DU PROFIL DOCTA
                         </h1>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <h2 style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                             ENTRE : [Consultant externe]<span class="p">, Numéro d’ordre de médecin : … , résidant
                                 …</span>
                         </h2>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <p style="padding-left: 5pt; text-indent: 418pt; text-align: left">
                             D’une part,
                         </p>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <h2 style="padding-left: 113pt; text-indent: -108pt; text-align: justify">
                             ET : DOCTA SARL<span class="p">, une société à responsabilité limitée enregistrée au RCCM
                                 de
                                 Lubumbashi (RDC) sous le numéro CD/LSH/RCCM/24-B-00765 et dont le siège
                                 social est sis au : 465 Av/Kintambo, Golf Faustin, Lubumbashi,
                                 RDC.</span>
                         </h2>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <ol id="l1">
                             <li data-list-text="1.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     PRESTATIONS
                                 </h2>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     L’Entreprise offre sa plateforme comme lieu permettant une interaction
                                     virtuelle des personnes avec un médecin de leur choix (généraliste ou
                                     spécialiste). Le médecin recevra donc des messages sous formes de
                                     textes, note vocales, appel vocale ou vidéos (dès que ces deux
                                     dernières fonctionnalités seront disponible). Le médecin consultant
                                     recevra des documents permettant de comprendre le fonctionnement de
                                     l’entreprise, la manière dont il lui est demandé d’interagir avec les
                                     personnes clientes qui peuvent être patientes ou non et répondre aux
                                     questions qu’il pourrait se poser de façon générale.
                                 </p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Ces documents sont à lire obligatoirement.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="2.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     MISSION
                                 </h2>
                                 <p
                                     style="
                              padding-top: 11pt;
                              padding-left: 5pt;
                              text-indent: 0pt;
                              text-align: justify;
                            ">
                                     Le médecin,
                                     consultant externe est tenu à faire part de ses
                                     services, connaissances et son expérience médicale avec les
                                     personnes clientes de Docta, ton ami médecin en se disponibilisant à
                                     chaque fois qu’il y a un besoin qui lui est adressé. Les personnes
                                     clientes pourront le joindre par textes, notes vocales et appels à
                                     travers l’application Docta ou le site <a href="http://www.docta-tam.com/"
                                         class="s1" target="_blank">www.docta-tam.com</a>
                                 </p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Docta vous permet d’avoir un cabinet médical virtuel et être consulté
                                     par un plus grand nombre de personne en fonction aussi d’à combien de
                                     personne vous avez parlé ou partager votre profil ou code médecin.
                                 </p>
                                 <p style="padding-top: 11pt; text-indent: 0pt; text-align: left">
                                     <br />
                                 </p>
                             </li>
                             <li data-list-text="3.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     OBLIGATIONS
                                 </h2>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Le médecin, consultant est obligé de :
                                 </p>
                                 <ul id="l2">
                                     <li data-list-text="-">
                                         <p
                                             style="
                                  padding-top: 11pt;
                                  padding-left: 41pt;
                                  text-indent: -18pt;
                                  text-align: left;
                                ">
                                             Avoir un téléphone Android ; ça peut être son téléphone privé ou
                                             utiliser un autre téléphone qui sera dédié au travail ;
                                         </p>
                                     </li>
                                     <li data-list-text="-">
                                         <p style="padding-left: 40pt; text-indent: -17pt; text-align: left">
                                             Avoir une connexion internet valide et stable chaque jour;
                                         </p>
                                     </li>
                                     <li data-list-text="-">
                                         <p style="padding-left: 40pt; text-indent: -17pt; text-align: left">
                                             Etre disponible.
                                         </p>
                                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                                     </li>
                                 </ul>
                             </li>
                             <li data-list-text="4.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     CONDITIONS DU CONTRAT ET RÉSILIATION
                                 </h2>
                                 <p
                                     style="
                              padding-top: 3pt;
                              padding-left: 5pt;
                              text-indent: 0pt;
                              text-align: justify;
                            ">
                                     Ce contrat
                                     entre en vigueur à partir du moment où le code médecin
                                     est disponible et le profil est créé. Chaque partie peut résilier ce
                                     contrat 7 jours après l’avoir notifié par écrit à l’autre partie. La
                                     lettre de notification devra être envoyée par courrier recommandé à
                                     l’adresse email : <a href="mailto:contact@docta-tam.com" class="a"
                                         target="_blank">contact@docta-tam.com</a> ou remise en main propre à l’adresse
                                     physique
                                     de l’entreprise.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="5.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     TEMPS CONSACRÉ PAR LE CONSULTANT
                                 </h2>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Le temps nécessaire pourrait varier de jour ou de semaine. Toutefois,
                                     le Consultant devra consacrer un minimum de 720 Heures par mois pour
                                     ses fonctions au titre du présent contrat, ce qui revient à dire qu’il
                                     offre ses prestations 24/24h en fonction du besoin de sa clientèle.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="6.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     LIEU DE LA PRESTATION
                                 </h2>
                                 <p
                                     style="
                              padding-top: 11pt;
                              padding-left: 5pt;
                              text-indent: 0pt;
                              text-align: justify;
                            ">
                                     Le choix du lieu où le médecin exécutera les prestations conformément
                                     à ce contrat est laissé à sa discrétion tant que le lieu lui permette
                                     de mieux exécuter sa tâche. Par ailleurs, le médecin exécutera ses
                                     prestations en se servant de son téléphone et est obligé de toujours
                                     avoir un forfait internet valide pour pouvoir exécuter les obligations
                                     du présent contrat.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="7.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     RÉMUNÉRATION
                                 </h2>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Le Consultant recevra 70 pourcent de ses prestations chaque mois pour
                                     le travail accompli. Le Consultant aura une copie du montant total
                                     revenu sur ses prestations dans l’application Docta pour médecin lui
                                     fournit par l’entreprise DOCTA SARL. L’Entreprise va procéder au
                                     paiement des montants dus au consultant à la fin de chaque mois ou sur
                                     demande spéciale par le consultant Docta ; cette demande doit être
                                     soumise 48h avant le jour concerné, en tenant compte de la véracité
                                     des informations et du caractère urgent pour motiver ce retrait
                                     d’argent.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="8.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     STATUT DE COLLABORATEUR EXTERNE
                                 </h2>
                                 <p
                                     style="
                              padding-top: 11pt;
                              padding-left: 5pt;
                              text-indent: 0pt;
                              text-align: justify;
                            ">
                                     L’Entreprise et le médecin Consultant Docta s’accordent pour
                                     reconnaître le Consultant comme un collaborateur externe au titre de
                                     ce contrat. Par conséquent, le Consultant sera responsable du paiement
                                     de toutes taxes relevant de ses prestations.
                                 </p>
                                 <p style="padding-top: 11pt; text-indent: 0pt; text-align: left">
                                     <br />
                                 </p>
                             </li>
                             <li data-list-text="9.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     INFORMATIONS CONFIDENTIELLES
                                 </h2>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                                 <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                                     Le Consultant accepte que toute information personnelle, financière,
                                     ou concernant les activités de l’Entreprise, reçue pendant toute
                                     exécution de ses obligations dans le cadre de ce contrat, sera gardée
                                     confidentielle et ne sera pas divulguée à d’autres personnes,
                                     entreprises ou organisations.
                                 </p>
                                 <p style="text-indent: 0pt; text-align: left"><br /></p>
                             </li>
                             <li data-list-text="10.">
                                 <h2 style="padding-left: 22pt; text-indent: -17pt; text-align: left">
                                     EMPLOI DE TIERS
                                 </h2>
                             </li>
                         </ol>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                             L’Entreprise interdit au Consultant de recourir à de tiers dans le cadre
                             des fonctions du Consultant en conformité avec le présent contrat et dans
                             le cas du non-respect le consultant sera tenu responsable de tout ce qui
                             peut advenir.
                         </p>
                         <p style="text-indent: 0pt; text-align: left"><br /></p>
                         <p style="padding-left: 5pt; text-indent: 0pt; text-align: justify">
                             En foi de quoi, par la présente le médecin consultant accepte ce contrat
                             qui prend effet à la date de soumission du formulaire d’obtention d’un
                             profil Docta.
                         </p>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <a type="button" class="btn btn-danger mr-3"
                         href="{{ asset('ContratDeConsultationExterneDOCTA.pdf') }}">Télécharger le contrat </a>
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                 </div>
             </div>
         </div>
     </div>


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
