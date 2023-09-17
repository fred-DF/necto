// Scripts for firebase and firebase messaging
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {
    apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
    authDomain: "necto-dfceb.firebaseapp.com",
    projectId: "necto-dfceb",
    storageBucket: "necto-dfceb.appspot.com",
    messagingSenderId: "386154409103",
    appId: "1:386154409103:web:2ea259453e03f46832d4fa"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

