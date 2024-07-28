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
        bottom: 80px !important;
        right: 20px !important;
        background: var(--zbotColor);
        border-radius: 50%;
        color: white;
        padding: 10px;
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
        background: rgb(32, 46, 84) none repeat scroll 0% 0%;
        color: rgb(188, 196, 211);
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
</style>

<div class="zbot-btn" id="btn-chat" style="display: none">
    <i class="fa fa-envelope"></i>
    <span unread class='ml-3 badge badge-danger'></span>
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
            <div class="w-100 appcolor">
                <span class="badge bg-secondary" btnprofile style="cursor: pointer">
                    <i class="fa fa-info-circle text-muted"></i>
                    <span solde></span>
                </span>
            </div>
        </div>
    </div>
    <div class="messages">
        <div id="zone-msg"></div>
    </div>
    <div class="">
        <div class="box">
            <textarea maxlength="160" class="textarea" placeholder="Message ..."></textarea>
        </div>
        <div class="w-100">
            <div syncdiv class="progress w-100" style="display:none">
                <div syncbar class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"></div>
            </div>
            <div class="d-flex justify-content-center">
                <span error class="text-danger" style="font-size: 10px"></span>
            </div>
        </div>
        <div class="d-flex justify-content-end ">
            <span>
                <strong class="text-muted" style="font-size: 10px; padding-right: 20px; font-weight: 900;"
                    mcounter>0/160</strong>
            </span>
        </div>
        <div class="box2">
            <div class="">

            </div>
            <div class="">
                <button id="btn-send" class="zbot-btn2">
                    <i class="fa fa-envelope-circle-check"></i> Envoyer
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-pro" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="w-100 text-center">
                        <button alire class="btn btn-outline-danger btn-sm mb-2"
                            style="stext-transform: none !important; font-size: 10px">
                            <i class="fa fa-exclamation-triangle">
                                <span>A lire !</span>
                            </i>
                        </button>
                    </div>
                    <div alirem class="alert alert-danger" style="display: none">
                        <i class="fa fa-exclamation-circle"></i>
                        <b class="">Vous utilisez nos services sur un device iOS? Lors de la suppression des
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
                    <h6>Appel : <b s-appel></b></h6>
                    <h6>SMS : <b s-sms></b> </h6>
                    <hr>
                    <h4>Crédit d'appel</h4>
                    <h6>Solde : <b s-solde></b></h6>
                    <button class="btn btn-outline-info btn-sm mt-3" btnrech type="button">
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

<div class="modal fade" id="mdl-rech" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                    <div class="d-flex justify-content-between">
                        <h4>Recharge crédit d'appel</h4>
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
        </div>
    </div>
</div>
</div>

<script src="{{ asset('assets/js/moment.js') }}"></script>
<script>
    function iOS() {
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

    if (iOS()) {
        $('#dapp').fadeOut();
        all();
    } else {
        $('#dapp').fadeIn();
    }

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
        });

        function mcount() {
            var n = $('.textarea').val().length;
            $('[mcounter]').html(`${n}/160`);
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

        function restoreMsg() {
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
                    str +=
                        `<div class="message ${mess.fromuser != 1 ? 'bot':''}">
                        ${mess.message}</br>
                        <div class='d-flex justify-content-between'>
                            <small style="font-size:10px;"><i>${mess.date}</i></small>
                            ${icon}
                        </div>

                    </div>`;
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
            var div = zm.closest('.messages');
            div.stop().animate({
                scrollTop: div[0].scrollHeight
            }, 500);
        }

        first = true;

        function watchMsg() {
            $.ajax({
                'url': '{{ route('api.message') }}',
                data: {

                },
                success: function(rep) {
                    var data = rep.data;
                    if (first) {
                        first = false;
                        $("#btn-chat").fadeIn();
                    }
                    var newmsg = data.message.length > 0;
                    var messages = data.message;
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

                    var solde = data.solde;
                    var sms = data.sms;
                    var appel = data.appel;
                    $('[solde]').html(`Crédit d'appel : ${solde} USD`);

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
    }
</script>
