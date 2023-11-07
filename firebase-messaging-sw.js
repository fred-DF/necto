
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// Importieren Sie die benötigten Firebase-Skripte
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging.js');

const firebaseConfig = {
    apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
    authDomain: "necto-dfceb.firebaseapp.com",
    projectId: "necto-dfceb",
    storageBucket: "necto-dfceb.appspot.com",
    messagingSenderId: "386154409103",
    appId: "1:386154409103:web:2ea259453e03f46832d4fa",
    measurementId: "G-X5XERRSSVJ"
};

// Initialisieren Sie Firebase wie oben
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background messages.
const messaging = firebase.messaging();


// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
