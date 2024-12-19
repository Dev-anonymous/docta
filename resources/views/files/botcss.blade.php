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
        z-index: 1000;
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
        padding: 0px !important;
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
