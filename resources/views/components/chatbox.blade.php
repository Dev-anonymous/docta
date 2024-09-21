<style>
    @media only screen and (max-width: 480px) {
        #chat-box {
            width: 98% !important;
            height: 85% !important;
            top: 100px !important;
            bottom: 10px !important;
            left: 5px !important;
            right: 5px !important;
        }
    }

    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,300&display=swap");

    :root {
        --zbotColor: #02bbff;
    }

    .zbot-btn {
        position: fixed;
        bottom: 100px !important;
        right: 20px !important;
        background: var(--zbotColor);
        border-radius: 50%;
        color: white;
        padding: 20px;
        cursor: pointer;
        display: inherit;
        -moz-box-align: center;
        align-items: center;
        -moz-box-pack: center;
        justify-content: center;
        pointer-events: initial;
        background-size: 130% 130%;
        transition: all 0.2s ease-in-out 0s;
    }

    .zbot-chatbox {
        position: fixed;
        transition: all 0.2s ease-in-out 0s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 24rem;
        height: 38rem;
        z-index: 1000;
        box-sizing: border-box;
        border-radius: 10px;
        background: white;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 5px 0px;
    }

    .zbot-chatbox>* {
        font-family: "Montserrat", sans-serif;
    }

    .appcolor {
        background: var(--zbotColor);
        color: white;
    }

    .zbot-chat-box-header {
        background: var(--zbotColor);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: white;
        font-size: 18px;
        padding-top: 17px;
        padding-left: 17px;
        padding-right: 17px;
        font-weight: bold;
    }

    .zbot-chatbox .messages {
        padding: 0.1rem;
        background: #fff;
        height: 100%;
        flex-shrink: 2;
        overflow-y: auto;
        margin-bottom: 10px;
    }

    .zbot-chatbox .messages .time {
        font-size: 0.8rem;
        background: #eee;
        padding: 0.25rem 1rem;
        border-radius: 2rem;
        color: #999;
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        margin: 0 auto;
    }

    .zbot-chatbox .messages .message {
        cursor: pointer;
        word-wrap: break-word;
        box-sizing: border-box;
        padding: 0.5rem 1rem;
        margin: 0.5rem;
        background: #fff;
        border-radius: 1.125rem 1.125rem 1.125rem 0;
        min-height: 2.25rem;
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        max-width: 66%;
        box-shadow: 0 0 2rem rgba(0, 0, 0, 0.075),
            0rem 1rem 1rem -1rem rgba(0, 0, 0, 0.1);
    }

    .zbot-chatbox .messages .message.bot {
        margin: 0.5rem 0.5rem 0.5rem auto;
        border-radius: 1.125rem 1.125rem 0 1.125rem;
        background: #62c8ec none repeat scroll 0% 0%;
        color: #000;
    }

    .zbot-chatbox .box {
        box-sizing: border-box;
        flex-basis: 4rem;
        flex-shrink: 0;
        display: flex;
    }

    .zbot-chatbox .box2 {
        display: flex;
        padding: 10px;
        justify-content: space-between;
    }

    .zbot-btn2 {
        position: relative;
        overflow: hidden;
        background-color: var(--zbotColor);
        border: none;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .zbot-chatbox .textarea {
        box-shadow: inset 0px 1px 1px 0px #ccc, inset 0px 0px 1px 0px #ccc;
        background: #fff;
        width: 100%;
        height: 100px;
        padding: 10px;
        border: none;
        resize: none;
        outline: none;
        color: #888;
        line-height: 1.5;
        border-radius: 5px;
        font-size: 1.2rem;
    }

    .zbot-chatbox ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .zbot-chatbox ::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 16px;
    }

    .zbot-chatbox ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
    }

    .zbot-chatbox * {
        -ms-overflow-style: 8px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.05);
    }

    .fa {
        font-family: var(--fa-style-family, "Font Awesome 6 Free");
        font-weight: 900;
    }

    .zbot-chatbox {
        position: fixed;
        bottom: 30px;
        right: 30px;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(2);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse2 {
        animation: pulse 1s infinite;
    }

    audio {
        -moz-box-shadow: 2px 2px 4px 0px var(--zbotColor);
        -webkit-box-shadow: 2px 2px 4px 0px var(--zbotColor);
        box-shadow: 2px 2px 4px 0px var(--zbotColor);
        -moz-border-radius: 7px 7px 7px 7px;
        -webkit-border-radius: 7px 7px 7px 7px;
        border-radius: 7px 7px 7px 7px;
        width: 150px;
    }
</style>

<div class="zbot-btn pulse2" id="btn-chat" style="display: none">
    <div>
        <span unread class='badge bg-danger' style="right: 5px; top: 15px ; position: absolute;"></span>
        <i class="fa fa-envelope fa-2x"></i>
    </div>
</div>

<div id="chat-box" class="zbot-chatbox" style="display: none">
    <div class="">
        <div class="zbot-chat-box-header d-block pb-2">
            <div class="d-flex justify-content-between">
                <span>
                    Ecrire au Docteur
                </span>
                <span>
                    <span class="chat-box-toggle" style="cursor: pointer">
                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                    </span>
                </span>
            </div>
            <div class="w-100 appcolor pt-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <span class="badge bg-secondary pulse2" btnprofile style="cursor: pointer">
                            <i class="fa fa-info-circle text-muted"></i>
                            <span solde></span>
                        </span>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary text-white" style="margin-left: 20px"
                        data-bs-toggle="modal" data-bs-target="#mdl-docta">
                        <i class="fa fa-user-md"></i> Docteur
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="messages">
        <div id="zone-msg"></div>
    </div>
    <div class="">
        <div class="box">
            <textarea maxlength="300" class="textarea" placeholder="Message au docteur ..."></textarea>
        </div>
        <div class="w-100">
            <div syncdiv class="progress w-100" style="display:none">
                <div syncbar class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"></div>
            </div>
            <div class="d-flex justify-content-center p-3">
                <b error class="text-danger" style="font-size: 10px"></b>
            </div>
        </div>
        <div class="d-flex justify-content-end ">
            <span>
                <strong class="text-muted" style="font-size: 10px; padding-right: 20px; font-weight: 900;"
                    mcounter>0/300</strong>
            </span>
        </div>
        <div style="margin-left: 10px">
            <b audiotime class="text-danger"></b>
        </div>
        <div class="box2">
            <div class="pl-2 d-flex">
                <div class="">
                    <input id="file" accept=".jpg,.jpeg,.png" type="file" style="display: none">
                    <label for="file"><i class="btn btn-outline-dark fa fa-image"></i></label>
                </div>
                <div style="margin-right: 5px; margin-left: 5px">
                    <button type="button" class="btn btn-outline-info fa fa-microphone startrec"></button>
                </div>
                <div style="margin-right: 5px; display: none">
                    <i class="btn btn-outline-danger fa fa-times-circle cancelrec"></i>
                </div>
                <div style="margin-left: 10px; cursor: pointer;">
                    <i class="fa fa-exclamation-triangle text-danger"
                        title="La taille limite de l'audio est de 1min30sec" data-toggle="tooltip"></i>
                </div>
            </div>

            <div class="">
                <button id="btn-send" class="zbot-btn2">
                    <i class="fa fa-envelope-circle-check"></i> Envoyer
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-pro" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="w-100 text-center">
                        <button alire class="btn btn-outline-danger btn-sm mb-2" style="font-size: 10px">
                            <i class="fa fa-exclamation-triangle">
                                <span>A lire !</span>
                            </i>
                        </button>
                    </div>
                    <div alirem class="alert alert-danger" style="display: none">
                        <i class="fa fa-exclamation-circle"></i>
                        <b class="">Vous utilisez nos services sur un navigateur? Lors de la suppression des
                            données en cache de
                            ce
                            navigateur, VOUS DEVEZ IGNORER la suppression de données de ce
                            site(https://www.docta-tam.com) pour permettre d'identifier votre navigateur et de
                            garder
                            vos informations (conversation, solde, profil).
                        </b>
                    </div>
                    <h4 class="mt-3">Facturation</h4>
                    <hr>
                    {{-- <h6>Appel : <b s-appel></b></h6> --}}
                    <h6>SMS : <b s-sms></b> </h6>
                    <hr>
                    <h4>Crédit</h4>
                    <h6>Solde : <b s-solde></b></h6>
                    <button class="btn btn-info btn-sm mt-3" btnrech type="button">
                        Recharger
                    </button>
                    <hr>
                    <h4>Profil</h4>
                    <h6>Nom : <span unom></span></h6>
                    <h6>Tel : <span utel></span></h6>
                    <h6>Email : <span uemail></span></h6>
                    <button class="btn btn-outline-info btn-sm mt-3" btnpfo type="button">
                        Modifier
                    </button>
                    <div class="mt-3" style="display: none" divpro>
                        <form action="#" class="was-validated" id="f-up">
                            <div class="form-group">
                                <label for="">Nom (*)</label>
                                <input required type="text" class="form-control" placeholder="Votre nom"
                                    name="nom">
                            </div>
                            <div class="form-group">
                                <label for="">Télephone (*)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+243</span>
                                    </div>
                                    <input type="text" required pattern="[0-9.]+" class="form-control"
                                        placeholder="Votre numéro Tel." name="telephone" maxlength="9">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email (facultatif)</label>
                                <input type="email" class="form-control" placeholder="Votre email" name="email">
                            </div>
                            <div class="mt-3">
                                <div id="rep"></div>
                            </div>
                            <button class="btn btn-outline-info mt-3" type="submit">
                                <span></span>
                                Valider
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-info" onclick="event.preventDefault();" data-bs-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-rech" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="d-flex justify-content-between">
                        <h4>Recharge crédit</h4>
                        <i class="fa fa-lock text-success fa-2x"></i>
                    </div>
                    <hr>
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle"></i>
                        Nous utilisons les payements sécurisés
                    </div>
                    <form action="#" class="was-validated" id="f-pay">
                        <div class="form-group">
                            <label for="">Télephone Mobile Money</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">+243</span>
                                </div>
                                <input type="text" required pattern="[0-9.]+" class="form-control"
                                    placeholder="Votre numéro Tel." name="telephone" maxlength="9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Montant de recharge</label>
                            <input type="number" required min="0.1" step="0.1" class="form-control"
                                placeholder="Montant, Ex: 1000" name="amount">
                        </div>
                        <div class="form-group">
                            <label for="">Devise</label>
                            <select name="devise" id="" class="form-control">
                                <option>CDF</option>
                                <option>USD</option>
                            </select>
                        </div>
                        <div class="mt-3 mb-3">
                            <div id="rep"></div>
                        </div>
                        <button class="btn btn-outline-info" type="submit">
                            <span></span>
                            Valider
                        </button>

                        <button type="button" class="btn btn-light my-2" id="btncancel"
                            style="display: none">Annuler
                        </button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark my-2" data-bs-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-welcome" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="d-flex justify-content-between">
                        <h4>Bienvenue</h4>
                        <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                    </div>
                    <div class="mt-4">
                        <h5>Besoin de parler à un médecin ? vous êtes au bon endroit, cliquez sur l'icône message
                            <b class="text-info"> en bleu </b>
                            de votre écran et adressez-vous directement à un docteur qualifié en toute discrétion et
                            confidentialité.
                        </h5>
                        <br>
                        <h5 class="text-danger">Docta vous offre un message gratuit.</h5>
                        <br>
                        <h5>Pour recharger votre compte, cliquez sur le solde.</h5>
                    </div>
                    <button type="button" class="btn btn-outline-dark my-2" data-bs-dismiss="modal">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $docta = App\Models\User::where('user_role', 'docta')->orderBy('name', 'desc')->get();

    $code = request('docta');
    $docta_id = false;
    $text = '';
    if ($code) {
        $pro = App\Models\Profil::where('code', $code)->first();
        if ($pro) {
            $docta_id = $pro?->users_id;
            $text =
                'Voulez-vous choisir le docteur <b>' .
                ucwords($pro->user->name) .
                ' (' .
                ucfirst($pro?->categorie->categorie) .
                ')</b>' .
                ' pour la discussion ?';
        }
    }
    $show = (bool) $docta_id;
@endphp
<div class="modal fade" id="mdl-docta" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="d-flex justify-content-between">
                        <h4>Changement du docteur</h4>
                        <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                    </div>
                    <div class="mt-4">
                        <h5>Voulez-vous parler à un médecin spécifique ? sélectionnez le médecin qu'il vous faut.</h5>
                        <div class="row">
                            @foreach ($docta as $el)
                                @php
                                    $profi = $el->profils()->first();
                                    $img = $profi?->image;
                                    if (!$img) {
                                        $img = asset('images/doc.jpg');
                                    } else {
                                        $img = asset('storage/' . $img);
                                    }
                                    $text2 =
                                        'Voulez-vous choisir le docteur <b>' .
                                        ucwords($el->name) .
                                        ' (' .
                                        ucfirst($profi?->categorie->categorie) .
                                        ')</b>' .
                                        ' pour la discussion ?';
                                @endphp
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="card m-2 p-2 divdocta">
                                        <div class="d-flex justify-content-center">
                                            <div class="">
                                                <img class='img-circle' style="object-fit: contain"
                                                    src="{{ $img }}" width="100px" height="100px"
                                                    alt="">
                                            </div>
                                        </div>
                                        <p style="font-weight: 900" class="m-0">{{ ucwords($el->name) }}</p>
                                        <p style="font-weight: 300" class="m-0">
                                            <i>{{ ucfirst($profi?->categorie->categorie) }}</i>
                                        </p>
                                        <p style="font-weight: 300" class="m-0">
                                            <i>Code médecin : {{ $profi?->code }}</i>
                                        </p>
                                        {{-- <div class="mt-3" style="height: 180px; overflow: auto;">
                                            <p style="font-weight: 300" class="m-0">
                                                {{ ucfirst($profi?->bio) }}
                                            </p>
                                        </div> --}}
                                        <div class="d-flex justify-content-end">
                                            <button value="{{ $el->id }}" class="btn btn-sm btn-info bdocta"
                                                data-bs-target="#mdl-change-docta" data-bs-toggle="modal"
                                                text="{{ $text2 }}">
                                                <i class="fa fa-user-md"></i> Choisir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-dark my-2" data-bs-dismiss="modal">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-change-docta" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="d-flex justify-content-between">
                        <h4>Changement du docteur</h4>
                        <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                    </div>
                    <form action="#" class="form" id="fdoc">
                        <div class="mt-4">
                            <h5 changemsg>{!! $text !!}</h5>
                            <p id="rep" style="font-weight: 900"></p>
                        </div>
                        <input type="hidden" value="{{ $show ? $docta_id : '' }}" name="docta_id" id="docta_id">
                        <button type="button" class="btn btn-sm btn-outline-dark my-2 m-2 bclo"
                            data-bs-dismiss="modal">
                            NON
                        </button>
                        <button type="submit" class="btn btn-info btn-sm my-2 m-2 byes">
                            <span></span> OUI JE CONFIRME
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<style>
    .divdocta {
        box-shadow: 0px 10px 45px rgba(2, 187, 255, 0.1);
        transition: transform .5s;
    }

    .divdocta:hover {
        box-shadow: 0px 10px 45px rgba(2, 187, 255, 0.5);
        transform: scale(1.02);
    }
</style>

<script>
    new WOW().init();

    function isIOS() {
        return [
                'iPad Simulator',
                'iPhone Simulator',
                'iPod Simulator',
                'iPad',
                'iPhone',
                'iPod'
            ].includes(navigator.platform) ||
            (navigator.userAgent.includes("Mac") && "ontouchend" in document)
    }

    function isAndroid() {
        var isAndroid = /(android)/i.test(navigator.userAgent);
        return isAndroid;
    }

    $(function() {
        $("[data-toggle='tooltip']").tooltip();
    });

    @if ($show)
        $(function() {
            $('#mdl-change-docta').modal('show');
        })
    @endif

    $('.bdocta').click(function() {
        var txt = $(this).attr('text');
        var id = this.value;
        $('[changemsg]').html(txt);
        $('#docta_id').val(id);
        $('.byes').show();
        $('.bclo').html('NON').show();
        $('#rep', $('#fdoc')).removeClass().html('');
    });

    $('#fdoc').submit(function() {
        event.preventDefault();
        var form = $(this);
        var btn = $(':submit', form);
        btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
        var data = form.serialize();
        $(':input', form).attr('disabled', true);
        var rep = $('#rep', form);
        rep.stop().slideUp();
        $.ajax({
            type: 'post',
            data: data,
            url: '{{ route('api.docta') }}',
            success: function(data) {
                if (data.success) {
                    rep.removeClass().addClass('alert alert-success');
                    $('.byes').fadeOut();
                    $('.bclo').html('Fermer');
                    @if ($show)
                        setTimeout(() => {
                            location.assign('{{ route('web.index') }}');
                        }, 5000);
                    @endif
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
        })
    });

    // if (iOS()) {
    // $('#dapp').fadeOut();
    all();
    // } else {
    $('#dapp').fadeIn();
    // }

    function all() {
        var btn_send = $('#btn-send');
        var ta = $('.textarea');

        $('[alire]').click(function() {
            $('[alirem]').stop().slideToggle();
        })

        $("#btn-chat,.chat-box-toggle").click(function() {
            $("#btn-chat").toggle();
            var cb = $("#chat-box");
            cb.toggle();
            var zm = $('#zone-msg')
            var div = zm.closest('.messages');
            div.stop().animate({
                scrollTop: div[0].scrollHeight
            }, 500);
            received();
            if (cb.is(':visible')) {
                ta.focus();
            }
            try {
                window.requestPerm();
            } catch (error) {
                console.log(error);
            }
        });

        function convertFileToBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = reject;
            });
        }

        $('#file').change(async function() {
            if (!canmessage()) {
                return false;
            }
            lockbtn(true);
            try {
                var field = $(this);
                var size = this.files[0].size / 1024 / 1024;
                if (size > 1) {
                    var sp = $('[error]');
                    sp.stop().html("La taille maximale du fichier est de 1Mo.");
                    setTimeout(() => {
                        sp.html('');
                    }, 3000);
                    return false;
                }

                var fileName = field[0].value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (!(extFile == "jpg" || extFile == "jpeg" || extFile == "png")) {
                    var sp = $('[error]');
                    sp.stop().html("Seuls les formats png, jpg et jpeg sont autorisés.");
                    setTimeout(() => {
                        sp.html('');
                    }, 3000);
                    return false;
                }

                const base64 = await convertFileToBase64(field[0].files[0]);
                var date = moment().utcOffset('+0200').format('YYYY-MM-DD h:mm:ss');
                var rnd = `${Math.random()}`.split('0.').join('');
                var tt = Date.now();
                var id = `${tt}-${rnd}`;

                var fname = field.val().replace(/C:\\fakepath\\/i, '')
                var mess = {
                    id: id,
                    message: fname,
                    file: base64,
                    date: date,
                    sent: 0,
                    fromuser: 0,
                };
                setMsg(mess);
                restoreMsg();
                sendlocalmsg();

            } catch (error) {
                var sp = $('[error]');
                sp.stop().html("Oops, echec d'envoi du fichier.");
                setTimeout(() => {
                    sp.html('');
                }, 3000);
            }
            lockbtn(false);

        })

        function mcount() {
            var n = $('.textarea').val().length;
            $('[mcounter]').html(`${n}/300`);
        }
        ta.keyup(function(e) {
            mcount();
            if (e.keyCode == 13) {
                return sendMessage();
            }
        });
        btn_send.click(function() {
            return sendMessage();
        })

        function canmessage(showmessage = false) {
            var localmsg = getMsg();
            localmsg = localmsg.filter(function(mes) {
                return mes.fromuser == 0;
            });
            var n = localmsg.length;

            var spa = $('[solde]');
            var solde = Number(spa.attr('solde'));
            var facsms = Number(spa.attr('sms'));

            if (n > 0) {
                if ((solde == 0 && facsms > 0)) {
                    var sp = $('[error]');
                    sp.stop().html(
                        "Veuillez recharger votre crédit SVP. Cliquez sur la zone crédit en gris foncé en haut.");
                    setTimeout(() => {
                        sp.html('');
                    }, 10000);
                    return false;
                }
            }
            return true;
        }

        function sendMessage() {
            var msg = ta.val().trim();
            var d = btn_send.attr('disabled');
            if (d == 'disabled') {
                var sp = $('[error]');
                sp.stop().html("Patientez SVP.");
                setTimeout(() => {
                    sp.html('');
                }, 2000);
                return false;
            }
            if (msg.length == 0) {
                ta.val('');
                return false;
            }

            if (!canmessage()) {
                return false;
            }

            var date = moment().utcOffset('+0200').format('YYYY-MM-DD h:mm:ss');
            var m = `<div class="message bot">
                    ${msg}</br>
                    <div class='d-flex justify-content-between'>
                        <small style="font-size:10px;"><i>${date}</i></small>
                        <i class="fa fa-clock text-danger" style="margin-left:20px; font-size:13px;"></i>
                    </div>
                </div>`;

            var zm = $('#zone-msg')
            zm.append(m);
            var div = zm.closest('.messages');
            div.stop().animate({
                scrollTop: div[0].scrollHeight
            }, 500);
            ta.val('');
            mcount();
            var tt = Date.now();
            var rnd = `${Math.random()}`.split('0.').join('');
            var id = `${tt}-${rnd}`;
            var mess = {
                id: id,
                message: msg,
                date: date,
                sent: 0,
                fromuser: 0,
            };
            setMsg(mess);
            sendlocalmsg();
        }

        function init() {
            var uid = localStorage.getItem('docta_uid');
            var deviceid = localStorage.getItem('docta_deviceid');
            $.ajax({
                'url': '{{ route('web.uid') }}',
                type: "post",
                data: {
                    from: 'web',
                    uid: uid,
                    deviceid: deviceid,
                },
                success: function(rep) {
                    var data = rep.data;
                    if (data.uid && data.deviceid) {
                        localStorage.setItem('docta_uid', data.uid);
                        localStorage.setItem('docta_deviceid', data.deviceid);
                        $("#btn-chat").fadeIn();
                        $.ajaxSetup({
                            headers: {
                                'uid': data.uid,
                                'deviceid': data.deviceid,
                            }
                        });
                        restoreMsg();
                        sendlocalmsg();
                        watchMsg();
                        welcome();
                    }
                },
                error: function(rep) {
                    setTimeout(() => {
                        init();
                    }, 3000);
                }
            })
        }
        init();

        function getMsg() {
            var msg = localStorage.getItem('docta_msg');
            if (msg) {
                msg = JSON.parse(msg);
                return msg;
            }
            return [];
        }

        function setMsg(mess) {
            lockbtn(true);
            var msg = getMsg();
            var exist = msg.filter(function(el) {
                return el.id == mess.id;
            });
            if (exist.length == 0) {
                msg.push(mess);
            }
            localStorage.setItem('docta_msg', JSON.stringify(msg));
            lockbtn(false);
        }

        function restoreMsg(scroll = true) {
            var msg = getMsg();
            var str = '';
            $(msg).each(function(e, mess) {
                var isfile = !!mess.file;
                var icon =
                    '<i class="fa fa-user-doctor" style="margin-left:20px; font-size:15px; color:#02bbff"></i>';
                if (mess.fromuser == 0) {
                    if (mess.sent == 0) {
                        icon =
                            '<i class="fa fa-clock text-danger" style="margin-left:20px; font-size:13px;"></i>';
                    }
                    if (mess.sent == 1) {
                        icon =
                            '<i class="fa fa-check text-success" style="margin-left:20px; font-size:13px;"></i>';
                    }
                    if (mess.userread == 1) {
                        icon =
                            '<i class="fa fa-check-double text-success" style="margin-left:20px; font-size:13px;"></i>';
                    }
                }
                if (isfile) {
                    var file = mess.file;
                    if (file.includes('data:image')) {
                        str +=
                            `<div class="message ${mess.fromuser != 1 ? 'bot':''}">
                                <a href="${file}" target="_blank"><img class="img-thumbnail" src="${file}" /></a></br>
                                <div class='d-flex justify-content-between'>
                                    <small style="font-size:10px;"><i>${mess.date}</i></small>
                                    ${icon}
                                </div>
                            </div>`;
                    } else if (file.includes('data:audio')) {
                        str +=
                            `<div class="message ${mess.fromuser != 1 ? 'bot':''}">
                                <small>${mess.message}</small>
                                <audio controls >
                                    <source src="${file}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <div class='d-flex justify-content-between'>
                                    <small style="font-size:10px;"><i>${mess.date}</i></small>
                                    ${icon}
                                </div>
                            </div>`;
                    } else {

                    }

                } else {
                    str +=
                        `<div class="message ${mess.fromuser != 1 ? 'bot':''}">
                        ${mess.message}</br>
                        <div class='d-flex justify-content-between'>
                            <small style="font-size:10px;"><i>${mess.date}</i></small>
                            ${icon}
                        </div>

                    </div>`;
                }
            });
            var zm = $('#zone-msg')
            zm.html(str);
            if (scroll) {
                var div = zm.closest('.messages');
                div.stop().animate({
                    scrollTop: div[0].scrollHeight
                }, 500);
            }

        }

        first = true;

        function watchMsg() {
            $.ajax({
                'url': '{{ route('api.message') }}',
                data: {
                    fcmtoken: localStorage.getItem('fcmtoken'),
                },
                success: function(rep) {
                    var data = rep.data;
                    if (first) {
                        first = false;
                        $("#btn-chat").fadeIn();
                    }
                    var newmsg = data.message.length > 0;
                    var messages = data.message;
                    var markread = data.markhasread;

                    $(messages).each(function(i, e) {
                        e.received = 0;
                        e.fromuser = 1;
                        setMsg(e);
                    });
                    if (newmsg) {
                        $('span[unread]').html(messages.length);
                        new Audio('{{ asset('notify.mp3') }}').play();
                        restoreMsg();
                    } else {
                        $('span[unread]').html('');
                    }
                    if ($("#chat-box").is(':visible')) {
                        received();
                    }

                    if (markread == true) {
                        markhasread(false);
                    }

                    var solde = data.solde;
                    var sms = data.sms;
                    var appel = data.appel;
                    $('[solde]').html(`Crédit : ${solde} USD`);
                    $('[solde]').attr('sms', sms);
                    $('[solde]').attr('solde', solde);

                    $('[s-solde]').html(`${solde} USD`);
                    $('[s-appel]').html(`${appel} USD/Séc`);
                    $('[s-sms]').html(`${sms} USD/SMS`);
                }
            }).always(function() {
                setTimeout(function() {
                    watchMsg();
                }, 3000);
            })
        }

        function lockbtn(lock) {
            var txt = `<i class="fa fa-envelope-circle-check"></i> Envoyer`;
            var txt2 = `<i class="spinner-border spinner-border-sm"></i> un instant SVP`;
            btn_send.attr('disabled', lock).html(lock ? txt2 : txt);
        }

        async function sendlocalmsg() {
            lockbtn(true);
            var msg = getMsg();

            var newtab = [];
            var tosent = msg.filter(function(e) {
                return e['fromuser'] == 0 && e['sent'] == 0;
            }).length;
            var sent = 0;

            var syncdiv = $('[syncdiv]');
            var syncbar = $('[syncbar]');
            syncdiv.slideDown();

            for (var i in msg) {
                var e = msg[i];
                try {
                    if (e['fromuser'] == 0 && e['sent'] == 0) {
                        var rep = await $.ajax({
                            url: '{{ route('api.message') }}',
                            type: 'post',
                            data: {
                                id: e.id,
                                message: e.message,
                                file: e.file,
                                date: e.date,
                            },
                        }).then();
                        e.sent = rep.success == true ? 1 : 0;
                        sent += 1;
                    }
                } catch (error) {
                    if (e['fromuser'] == 0 && e['sent'] == 0) {
                        sent += 1;
                    }
                }
                newtab.push(e);

                if (tosent > 0) {
                    var perc = `${Math.floor(sent * 100 /tosent)}`;
                    syncbar.css('width', `${perc}%`).html(`Envoi ${perc}%`);
                }
            };

            syncdiv.stop();
            setTimeout(() => {
                syncdiv.slideUp(function() {
                    syncbar.css('width', `0%`).html('');
                });
            }, 1000);
            localStorage.setItem('docta_msg', JSON.stringify(newtab));
            lockbtn(false);
            restoreMsg();
        }

        function received() {
            var msg = getMsg();
            var mes = msg.filter(function(e) {
                return e['fromuser'] == 1 && e['received'] == 0;
            });
            var ids = [];
            $(mes).each(function(i, e) {
                ids.push(e['id']);
            })
            if (ids.length > 0) {
                $.ajax({
                    url: '{{ route('api.received') }}',
                    type: 'post',
                    data: {
                        data: ids.join(',')
                    },
                    success: function() {
                        var msg = getMsg();
                        lockbtn(true);
                        var tmp = [];
                        for (var i in msg) {
                            var find = false;
                            for (var j in mes) {
                                if (mes[j].id == msg[i].id) {
                                    find = true;
                                    break;
                                }
                            }
                            var m = msg[i];
                            m.received = find ? 1 : 0;
                            tmp.push(m);
                        }
                        localStorage.setItem('docta_msg', JSON.stringify(tmp));
                        lockbtn(false);
                    }
                });
            }
        }

        function markhasread(scroll = false) {
            lockbtn(true);
            var msg = getMsg();
            var tmp = [];
            for (var i in msg) {
                var m = msg[i];
                if (m.fromuser == 0 && m.sent == 1) {
                    m.userread = 1;
                }
                tmp.push(m);
            }
            localStorage.setItem('docta_msg', JSON.stringify(tmp));
            lockbtn(false);
            restoreMsg(scroll);
        }

        $('[btnprofile]').click(function() {
            $('#mdl-pro').modal('show');
        });
        $('[btnpfo]').click(function() {
            $('[divpro]').slideToggle();
        });
        $('#f-up').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            var rep = $('#rep', form);
            rep.html('');
            var data = form.serialize();
            if ($('[name=email]', form).val().trim().length == 0) {
                data = data.split('email=').join('');
            }
            data = data.split('telephone=').join('telephone=+243');

            btn.attr('disabled', true).find('span').removeClass().addClass('spinner-border spinner-border-sm');
            $.ajax({
                url: '{{ route('api.profile') }}',
                type: 'post',
                data: data,
                success: function(res) {
                    if (res.success) {
                        rep.removeClass().addClass('text-success').html(res.message);
                        localStorage.setItem('docta_uprofile', JSON.stringify({
                            nom: $('[name=nom]', form).val().trim(),
                            telephone: $('[name=telephone]', form).val().trim(),
                            email: $('[name=email]', form).val().trim(),
                        }));
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    } else {
                        rep.removeClass().addClass('text-danger').html(res.message);
                    }
                }
            }).always(function() {
                btn.attr('disabled', false).find('span').removeClass();
            });
        });

        function uprofile() {
            var p = localStorage.getItem('docta_uprofile');
            if (p) {
                p = JSON.parse(p);
                $('[unom]').html(p.nom);
                $('[uemail]').html(p.email);
                $('[utel]').html(p.telephone);
                var form = $('#f-up');

                $('[name=nom]', form).val(p.nom);
                $('[name=telephone]', form).val(p.telephone);
                $('[name=telephone]', $('#f-pay')).val(p.telephone);
                $('[name=email]', form).val(p.email);
            }
        }
        uprofile();

        $('[btnrech]').click(function() {
            var p = localStorage.getItem('docta_uprofile');
            if (!p) {
                alert("Veuillez renseigner votre nom et numéro de télephone avant de recharger votre compte.");
                $('[divpro]').slideDown();
                $('[name=nom]', $('#f-up')).focus();
                return;
            }
            $('.modal').modal('hide');
            $('#mdl-rech').modal('show');
        });


        CANSHOW = true;
        var xhr = [];
        var interv = null;

        var callback = function() {
            var x =
                $.ajax({
                    url: '{{ route('api.check.pay') }}',
                    data: {
                        myref: REF,
                    },
                    success: function(res) {
                        var trans = res.transaction;
                        var status = trans?.status;
                        if (status === 'success') {
                            $('#btncancel').hide();
                            clearInterval(interv);
                            var form = $('#f-pay');
                            var btn = $(':submit', form).attr('disabled', false);
                            btn.html('<span></span> Valider');
                            rep = $('#rep', form);
                            rep.html(
                                `<b>TRANSACTION EFFECTUEE !</b><p>Vous pouvez effectuer un autre paiement ou fermer cette page.</p>`
                            ).removeClass();
                            rep.addClass('alert alert-success');
                            rep.slideDown();

                        } else if (status === 'failed') {
                            clearInterval(interv);
                            $('#btncancel').hide();
                            var form = $('#f-pay');
                            var btn = $(':submit', form).attr('disabled', false);
                            btn.html('<span></span> Valider');
                            var rep = $('#rep', form);
                            rep.html(
                                `<b>TRANSACTION ECHOUEE !</b><p>Vous avez peut-être saisi un mauvais Pin. Merci de réessayer.</p>`
                            ).removeClass();
                            rep.addClass('alert alert-danger');
                            $(xhr).each(function(i, e) {
                                e.abort();
                            });
                        }
                    }
                });
            xhr.push(x);
        }
        $('#btncancel').click(function() {
            clearInterval(interv);
            $(this).hide();
            var form = $('#f-pay');
            var btn = $(':submit', form).attr('disabled', false);
            btn.html('<span></span> Valider');
            var rep = $('#rep', form);
            rep.html("Paiement annulé.").removeClass();
            rep.addClass('alert alert-danger');
            $(xhr).each(function(i, e) {
                e.abort();
            });
        });

        $('#f-pay').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            var rep = $('#rep', form);
            rep.html('').removeClass();
            var data = form.serialize();
            data = data.split('telephone=').join('telephone=+243');

            btn.attr('disabled', true).find('span').removeClass().addClass('spinner-border spinner-border-sm');
            $.ajax({
                url: '{{ route('api.init.pay') }}',
                type: 'post',
                data: data,
                success: function(res) {
                    if (res.success) {
                        rep.html(res.message).removeClass();
                        rep.addClass('alert alert-success');
                        btn.html(
                            '<i class="spinner-border spinner-border-sm"></i> Confirmez votre Pin au téléphone...'
                        );
                        btn.attr('disabled', true);
                        clearInterval(interv);
                        REF = res.data.myref;
                        interv = setInterval(callback, 3000);
                        $('#btncancel').show();
                    } else {
                        rep.removeClass().addClass('text-danger').html(res.message);
                        btn.attr('disabled', false).find('span').removeClass();
                    }
                }
            });
        });


        function initAudio() {
            const startButton = $('.startrec');
            const cancelButton = $('.cancelrec');
            let audioRecorder;
            let audioChunks = [];
            let isrec = false;
            let sendfi = false;
            var audiotime = $('[audiotime]');
            var intervalfunc = null;
            var isinit = false;

            var totalSeconds = 0;

            function setTime() {
                ++totalSeconds;
                var sec = pad(totalSeconds % 60);
                var m = pad(parseInt(totalSeconds / 60));
                audiotime.html(`${m}:${sec}`);
                if (totalSeconds > 90) {
                    clearInterval(intervalfunc);
                    intervalfunc = null;
                    startButton.removeClass('fa-stop btn-outline-success');
                    startButton.addClass('fa-microphone btn-outline-info');
                    audioRecorder.stop();
                    cancelButton.closest('div').toggle();
                }
            }

            function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                    return "0" + valString;
                } else {
                    return valString;
                }
            }

            startButton.click(function() {
                if (!canmessage()) {
                    return false;
                }
                navigator.mediaDevices
                    .getUserMedia({
                        audio: true
                    })
                    .then((stream) => {
                        if (!isinit) {
                            isinit = true;
                            initEevent(stream);
                        }
                    })
                    .catch((err) => {
                        alert("Veuillez autoriser l'accès à votre micro pour envoyer un message audio.")
                    });
            });

            function initEevent(stream) {
                audioRecorder = new MediaRecorder(stream);
                audioRecorder.addEventListener('dataavailable', e => {
                    audioChunks.push(e.data);
                    let reader = new FileReader()
                    reader.onloadend = () => {
                        isrec = false;
                        if (sendfi) {
                            var file = reader.result;

                            var date = moment().utcOffset('+0200').format('YYYY-MM-DD h:mm:ss');
                            var tt = Date.now();
                            var rnd = `${Math.random()}`.split('0.').join('');
                            var id = `${tt}-${rnd}`;
                            var mess = {
                                id: id,
                                message: `Audio(${audiotime.html()})`,
                                file: file,
                                date: date,
                                sent: 0,
                                fromuser: 0,
                            };
                            setMsg(mess);
                            restoreMsg();
                            sendlocalmsg();
                        }
                        audiotime.html('');
                    }
                    reader.readAsDataURL(e.data);
                });

                startButton.off('click').on('click', () => {
                    sendfi = true;
                    if (isrec) {
                        audioRecorder.stop();
                        isrec = false;
                        startButton.removeClass('fa-stop btn-outline-success');
                        startButton.addClass('fa-microphone btn-outline-info');
                        totalSeconds = 0;
                        clearInterval(intervalfunc);
                        intervalfunc = null;
                    } else {
                        isrec = true;
                        audioChunks = [];
                        audioRecorder.start();
                        startButton.removeClass('fa-microphone btn-outline-info');
                        startButton.addClass('fa-stop btn-outline-success');

                        totalSeconds = 0;
                        clearInterval(intervalfunc);
                        intervalfunc = null;
                        intervalfunc = setInterval(setTime, 1000);
                    }
                    cancelButton.closest('div').toggle();
                });
                cancelButton.off('click').on('click', () => {
                    sendfi = false;
                    clearInterval(intervalfunc);
                    intervalfunc = null;
                    startButton.removeClass('fa-stop btn-outline-success');
                    startButton.addClass('fa-microphone btn-outline-info');
                    audioRecorder.stop();
                    cancelButton.closest('div').toggle();
                });

                startButton.click();
            }
        }

        initAudio();

        function welcome() {
            var mdl = $('#mdl-welcome');
            var ok = Number(localStorage.getItem('docta_ios_welcome'));
            if (ok < 2) {
                mdl.modal('show');
            }

            mdl.on('hide.bs.modal', function() {
                var ok = Number(localStorage.getItem('docta_ios_welcome'));
                ok += 1;
                localStorage.setItem('docta_ios_welcome', ok);
            });
        }
    }
</script>
<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";

    import {
        getMessaging,
        getToken,
        onMessage
    } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-messaging.js";

    const firebaseConfig = {
        apiKey: "AIzaSyABketxjkmblvbnz4FszSjGVQtAKZnai-A",
        authDomain: "docta-2907c.firebaseapp.com",
        projectId: "docta-2907c",
        storageBucket: "docta-2907c.appspot.com",
        messagingSenderId: "919308488854",
        appId: "1:919308488854:web:5abdd3ec7d4268229fb2b7"
    };

    window.fbInit = false;

    window.requestPerm = function requestPerm(showmess = true) {
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                if (window.fbInit == true) {
                    return true;
                }
                const app = initializeApp(firebaseConfig);
                const messaging = getMessaging(app);

                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register('{{ asset('sw.js') }}')
                        .then((registration) => {
                            getToken(messaging, {
                                    serviceWorkerRegistration: registration,
                                    vapidKey: "BNNh_E3fLYSjaaFIg7SeQpW95cVbILgYGB9y7twxvVgv-oJ_Er5CEBNa9rJ4GdaJJiJ81zVzhKI4WK8z3Q3SOKk",
                                })
                                .then((fcmtoken) => {
                                    if (fcmtoken) {
                                        localStorage.setItem('fcmtoken', fcmtoken);
                                        window.fbInit = true;
                                    }
                                })
                                .catch(function(err) {
                                    console.log("Error ==> ", err);
                                });
                            // messaging.onBackgroundMessage((payload) => {
                            //     console.log(
                            //         '[firebase-messaging-sw.js] Received background message ',
                            //         payload
                            //     );
                            //     const notificationTitle = 'Background Message Title';
                            //     const notificationOptions = {
                            //         body: 'Background Message body.',
                            //         icon: '/firebase-logo.png'
                            //     };
                            //     self.registration.showNotification(notificationTitle,
                            //         notificationOptions);
                            // });

                            // messaging.onMessage((payload) => {
                            //     console.log(
                            //         '[firebase-messaging-sw.js] Received background message ',
                            //         payload
                            //     );
                            //     const notificationTitle = '###Message Title';
                            //     const notificationOptions = {
                            //         body: 'Normal Message body.',
                            //         icon: '/firebase-logo.png'
                            //     };
                            //     self.registration.showNotification(notificationTitle,
                            //         notificationOptions);
                            // });
                        }).catch(function(err) {
                            console.error(err);
                        });
                };

            } else {
                if (showmess) {
                    alert(
                        "Pour une meilleure experience utilisateur, veuillez autoriser l'accès aux notifications."
                    )
                }
            }
        });
    }

    // if (iOS()) {
    try {
        window.requestPerm(false);
    } catch (error) {
        console.log(error);
    }
    // }
</script>
