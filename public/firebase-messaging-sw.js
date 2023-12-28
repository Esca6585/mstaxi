// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyCb4-gYuRCchkACI-z-H0N3BGZSVE1OPTw",
    authDomain: "magnetic-lore-322008.firebaseapp.com",
    projectId: "magnetic-lore-322008",
    storageBucket: "magnetic-lore-322008.appspot.com",
    messagingSenderId: "227557197970",
    appId: "1:227557197970:web:aad3453997eb67a7073e4b"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});