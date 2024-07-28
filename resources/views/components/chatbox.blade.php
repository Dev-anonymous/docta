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
        z-index: 2;
        box-sizing: border-box;
        border-radius: 10px;
        background: white;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 5px 0px;
    }

    .zbot-chatbox>* {
        font-family: "Montserrat", sans-serif;
    }

    .zbot-chat-box-header {
        background: var(--zbotColor);
        height: 70px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: white;
        text-align: center;
        font-size: 18px;
        padding: 17px;
        padding-bottom: 0px;
        display: flex;
        justify-content: space-between;
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
        background: rgb(240, 242, 247) none repeat scroll 0% 0%;
        color: rgb(6, 19, 43);
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
        <div class="zbot-chat-box-header">Ecrire au Docteur
            <span>
                <span class="chat-box-toggle" style="cursor: pointer">
                    <i class="fa fa-times-circle text-danger fa-2x"></i>
                </span>
            </span>
        </div>

    </div>
    <div class="messages">
        <div id="zone-msg"></div>
    </div>
    <div class="">
        <div class="box">
            <textarea maxlength="160" class="textarea" placeholder="Message ..."></textarea>
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

<script src="{{ asset('assets/js/moment.js') }}"></script>
<script>
    var btn_send = $('#btn-send');
    var ta = $('.textarea');

    $("#btn-chat,.chat-box-toggle").click(function() {
        $("#btn-chat").toggle();
        var cb = $("#chat-box");
        cb.toggle();
        var zm = $('#zone-msg')
        var div = zm.closest('.messages');
        div.stop().animate({
            scrollTop: div[0].scrollHeight
        }, 500);
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
        var msg = getMsg();
        var exist = msg.filter(function(el) {
            return el.id == mess.id;
        });
        if (exist.length == 0) {
            msg.push(mess);
        }
        localStorage.setItem('docta_msg', JSON.stringify(msg));
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
        $('#zone-msg').html(str);
    }

    first = true;

    function watchMsg() {
        $.ajax({
            'url': '{{ route('api.message') }}',
            type: "get",
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
                })
                if (newmsg) {
                    $('span[unread]').html(messages.length);
                    new Audio('{{ asset('notify.mp3') }}').play();
                } else {
                    $('span[unread]').html('');
                }
            }
        }).always(function() {
            setTimeout(function() {
                watchMsg();
            }, 3000);
        })
    }

    function sendlocalmsg() {
        var txt = `<i class="fa fa-envelope-circle-check"></i> Envoyer`;
        btn_send.attr('disabled', true).html(`<i class="spinner-border spinner-border-sm"></i> un instant SVP`);
        var msg = getMsg();

        var newtab = [];
        $(msg).each(async function(i, e) {
            // try {
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
            }
            // } catch (error) {
            //     console.log(error);
            // }
            newtab.push(e);
        });
        // localStorage.setItem('docta_msg', JSON.stringify(newtab));
        console.log(newtab);
        btn_send.attr('disabled', false).html(txt);
        restoreMsg();
    }
</script>
