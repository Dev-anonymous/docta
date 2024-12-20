@include('files.botcss')

<div class="zbot-btn" id="btn-chat" style="display: none">
    <div>
        <span unread class='badge bg-danger' style="right: 5px; top: 15px ; position: absolute;"></span>
        <i class="fa fa-envelope fa-2x"></i>
    </div>
</div>

<div id="chat-box" class="zbot-chatbox" style="display: none">
    <div class="">
        <div class="zbot-chat-box-header d-block pb-2">
            <div class="d-flex justify-content-between">
                <span uname></span>
                <span>
                    <span class="chat-box-toggle" style="cursor: pointer">
                        <i class="fa fa-times-circle fa-2x"></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="h-100" style="overflow: auto;" divchat></div>
    <div class="messages" divmsg style="display: none">
        <div id="zone-msg"></div>
    </div>
    <div class="" divcontrol style="display: none">
        <div class="box">
            <textarea maxlength="300" class="textarea" placeholder="Message ..."></textarea>
        </div>
        <div class="w-100">
            <div syncdiv class="progress w-100" style="display:none">
                <div syncbar class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar">
                </div>
            </div>
            <div class="d-flex justify-content-center p-3">
                <b error class="text-danger" style="font-size: 10px"></b>
            </div>
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

<script src="{{ asset('assets/js/moment.js') }}"></script>
<script>
    var btn_send = $('#btn-send');
    var ta = $('.textarea');

    $("#btn-chat,.chat-box-toggle").click(function() {
        if ($('[divcontrol]').is(':visible')) {
            $('[divchat]').show();
            $('[divmsg]').hide();
            $('[divcontrol]').hide();
            $('[uname]').html('');
            $('[uname]').attr('chat_id', '');
            return;
        }
        $("#btn-chat").toggle();

        var cb = $("#chat-box");
        cb.toggle();
        var zm = $('#zone-msg')
        var div = zm.closest('.messages');
        div.stop().animate({
            scrollTop: div[0].scrollHeight
        }, 500);
        received2();
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

            var fname = field.val().replace(/C:\\fakepath\\/i, '');
            var chat_id = $('[uname]').attr('chat_id');
            var mess = {
                id: id,
                chat_id: chat_id,
                message: fname,
                file: base64,
                date: date,
                sent: 0,
                fromuser: 1,
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
    });

    ta.keyup(function(e) {
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
                        <i class="fa fa-spinner fa-spin text-danger" style="margin-left:20px; font-size:13px;"></i>
                    </div>
                </div>`;

        var zm = $('#zone-msg')
        zm.append(m);
        var div = zm.closest('.messages');
        div.stop().animate({
            scrollTop: div[0].scrollHeight
        }, 500);
        ta.val('');
        var tt = Date.now();
        var rnd = `${Math.random()}`.split('0.').join('');
        var id = `${tt}-${rnd}`;
        var chat_id = $('[uname]').attr('chat_id');
        var mess = {
            id: id,
            chat_id: chat_id,
            message: msg,
            date: date,
            sent: 0,
            fromuser: 1,
        };
        setMsg(mess);
        restoreMsg();
        sendlocalmsg();
    }

    function init() {
        restoreMsg();
        sendlocalmsg();
        watchMsg();
    }
    init();

    function getMsg(chatid = null) {
        var msg = localStorage.getItem('docta_msg0');
        if (msg) {
            msg = JSON.parse(msg);
            if (chatid) {
                msg = msg.filter(function(el) {
                    return el.chat_id == chatid;
                });
            }
            return msg;
        }
        return [];
    }

    function getChat() {
        var msg = localStorage.getItem('docta_chat0');
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
        localStorage.setItem('docta_msg0', JSON.stringify(msg));
        lockbtn(false);
    }

    function setChat(chat) {
        lockbtn(true);
        var msg = getChat();
        var exist = msg.filter(function(el) {
            return el.id == chat.id;
        });
        if (exist.length == 0) {
            msg.push(chat);
        }
        localStorage.setItem('docta_chat0', JSON.stringify(msg));
        lockbtn(false);
    }

    function restoreMsg(scroll = true) {
        var str = '';
        $(getChat()).each(function(e, mess) {
            var app = mess.app;
            var n = app.nom ?? app.uid;
            str += `
                    <div class="card m-0 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; cursor:pointer" chat=${mess.id} user='${escape(n)}'>
                        <div class="card-body p-2 d-flex">
                            <div class="">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="pl-2 d-flex align-items-center" style="line-height: 15px">
                                <b>${n}</b>
                            </div>
                            <div>
                                <span chatunread="${mess.id}" class='bg-danger rounded-circle' style="right: 5px; top: 15px ; position: absolute; padding:10px; display:none"></span>
                            </div>
                        </div>
                    </div>
                `;
        });

        if (str.length == 0) {
            str = `
                    <div class="card m-0 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; cursor:pointer">
                        <div class="card-body p-2 d-flex text-danger">
                            <div class="">
                                <i class="fa fa-exclamation-circle fa-3x"></i>
                            </div>
                            <div class="pl-2 d-flex align-items-center" style="line-height: 15px">
                                <b>Aucune conversation</b>
                            </div>
                        </div>
                    </div>
                `;
        }
        $('[divchat]').html(str);

        $('[chat]').off('click').click(function() {
            var chatid = $(this).attr('chat');
            var user = unescape($(this).attr('user'));
            $('[divchat]').hide();
            $('[divmsg]').show();
            $('[divcontrol]').show();
            $('[uname]').html(user);
            $('[uname]').attr('chat_id', chatid);

            var msg = getMsg(chatid);
            showmsg(msg);
            received(chatid);
        });

        var chatid = $('[uname]').attr('chat_id');
        if (chatid != '') {
            var msg = getMsg(chatid);
            showmsg(msg);
        }
    }

    function showmsg(msg) {
        var str = '';
        $(msg).each(function(e, mess) {
            var isfile = !!mess.file;
            var icon =
                '<i class="fa fa-user-doctor" style="margin-left:20px; font-size:15px; color:#02bbff"></i>';
            if (mess.fromuser == 1) {
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
                        `<div class="message ${mess.fromuser != 1 ? '':'bot'}">
                                <a href="${file}" target="_blank"><img class="img-thumbnail" src="${file}" /></a></br>
                                <div class='d-flex justify-content-between'>
                                    <small style="font-size:10px;"><i>${mess.date}</i></small>
                                    ${icon}
                                </div>
                            </div>`;
                } else if (file.includes('data:audio')) {
                    str +=
                        `<div class="message ${mess.fromuser != 1 ? '':'bot'}">
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
                    `<div class="message ${mess.fromuser != 1 ? '':'bot'}">
                        ${mess.message}</br>
                        <div class='d-flex justify-content-between'>
                            <small style="font-size:10px;"><i>${mess.date}</i></small>
                            ${icon}
                        </div>

                    </div>`;
            }
        });
        var zm = $('#zone-msg');
        zm.html(str);
        if (scroll) {
            setTimeout(() => {
                var div = zm.closest('.messages');
                div.stop().animate({
                    scrollTop: div[0].scrollHeight
                }, 500);
            }, 500);
        }
    }
    first = true;

    function watchMsg() {
        $.ajax({
            'url': '{{ route('api.docta.chat') }}',
            data: {
                fcmtoken: localStorage.getItem('fcmtoken'),
            },
            success: function(rep) {
                var data = rep.data;
                if (first) {
                    first = false;
                    $("#btn-chat").fadeIn();
                }
                var newmsg = data.messages.length > 0;
                var newchat = data.chats.length > 0;
                var messages = data.messages;
                var chats = data.chats;

                $(chats).each(function(i, e) {
                    e.received = 0;
                    setChat(e);
                    restoreMsg();
                });

                $(messages).each(function(i, e) {
                    e.received = 0;
                    setMsg(e);
                });

                $('[chatunread]').hide();
                if (newmsg || newchat) {
                    var n = messages.length;
                    $('span[unread]').html(n > 0 ? n : '');
                    new Audio('{{ asset('notify.mp3') }}').play();
                    restoreMsg();
                    $(messages).each(function(i, e) {
                        var chatid = e['chat_id'];
                        $(`[chatunread=${chatid}]`).show();
                    });
                } else {
                    $('span[unread]').html('');
                }
                if ($("#chat-box").is(':visible')) {
                    received2();
                }

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
            return e['fromuser'] == 1 && e['sent'] == 0;
        }).length;
        var sent = 0;

        var syncdiv = $('[syncdiv]');
        var syncbar = $('[syncbar]');
        syncdiv.slideDown();

        for (var i in msg) {
            var e = msg[i];
            try {
                if (e['fromuser'] == 1 && e['sent'] == 0) {
                    var rep = await $.ajax({
                        url: '{{ route('api.docta.chat') }}',
                        type: 'post',
                        data: {
                            id: e.id,
                            chat_id: e.chat_id,
                            message: e.message,
                            file: e.file,
                            date: e.date,
                        },
                    }).then();
                    e.sent = rep.success == true ? 1 : 0;
                    sent += 1;
                }
            } catch (error) {
                if (e['fromuser'] == 1 && e['sent'] == 0) {
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
        localStorage.setItem('docta_msg0', JSON.stringify(newtab));
        lockbtn(false);
        restoreMsg();
    }

    function received(chatid) {
        var msg = getMsg(chatid);
        var mes = msg.filter(function(e) {
            return e['fromuser'] == 0 && e['received'] == 0;
        });
        var ids = [];
        $(mes).each(function(i, e) {
            ids.push(e['id']);
        })

        if (ids.length > 0) {
            $.ajax({
                url: '{{ route('api.docta.received') }}',
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
                    localStorage.setItem('docta_msg0', JSON.stringify(tmp));
                    lockbtn(false);
                }
            });
        }
    }

    function received2() {
        var msg = getChat();
        var ids = [];
        var mes = msg.filter(function(e) {
            return e['fromuser'] == 0 && e['received'] == 0;
        });
        $(mes).each(function(i, e) {
            ids.push(e['id']);
        });

        if (ids.length > 0) {
            $.ajax({
                url: '{{ route('api.docta.received-2') }}',
                type: 'post',
                data: {
                    data: ids.join(',')
                },
                success: function() {
                    var msg = getChat();
                    lockbtn(true);
                    var tmp = [];
                    for (var i in msg) {
                        m.received = 1;
                        tmp.push(m);
                    }
                    localStorage.setItem('docta_chat0', JSON.stringify(tmp));
                    lockbtn(false);
                }
            });
        }
    }

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
                        var chat_id = $('[uname]').attr('chat_id');
                        var mtxt = `Audio(${audiotime.html()})`;
                        var mess = {
                            id: id,
                            chat_id: chat_id,
                            message: mtxt,
                            file: file,
                            date: date,
                            sent: 0,
                            fromuser: 1,
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

    try {
        window.requestPerm(false);
    } catch (error) {
        console.log(error);
    }
</script>
