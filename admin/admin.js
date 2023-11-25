// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-analytics.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-messaging.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
    authDomain: "necto-dfceb.firebaseapp.com",
    projectId: "necto-dfceb",
    storageBucket: "necto-dfceb.appspot.com",
    messagingSenderId: "386154409103",
    appId: "1:386154409103:web:2ea259453e03f46832d4fa",
    measurementId: "G-X5XERRSSVJ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);
