self.addEventListener("push", (event) => {
    const notif = event.data.json().notification;
    console.log(notif);
    event.waitUntil(
        self.registration.showNotification(notif.title, {
            body: notif.body,
            icon: notif.icon,
            image: notif.image,
            // data: {
            //     url: "https://docta-tam.com",
            // },
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    console.log(event.notification);
    event.waitUntil(clients.openWindow("https://docta-tam.com"));
});

console.log("Load");

// importScripts("https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js");
// importScripts(
//     "https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"
// );

// var firebaseConfig = {
//     apiKey: "AIzaSyABketxjkmblvbnz4FszSjGVQtAKZnai-A",
//     authDomain: "docta-2907c.firebaseapp.com",
//     projectId: "docta-2907c",
//     storageBucket: "docta-2907c.appspot.com",
//     messagingSenderId: "919308488854",
//     appId: "1:919308488854:web:5abdd3ec7d4268229fb2b7",
// };

// firebase.initializeApp(firebaseConfig);
// const messaging = firebase.messaging();

// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log(payload);
//     const notification = JSON.parse(payload);
//     const notificationOption = {
//         body: notification.body,
//         icon: notification.icon,
//     };
//     return self.registration.showNotification(
//         payload.notification.title,
//         notificationOption
//     );
// });
