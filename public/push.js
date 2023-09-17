
// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-analytics.js";
import { getMessaging, getToken  } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-messaging.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// Import the functions you need from the SDKs you need
// Your web app's Firebase configuration

const firebaseConfig = {
    apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
    authDomain: "necto-dfceb.firebaseapp.com",
    projectId: "necto-dfceb",
    storageBucket: "necto-dfceb.appspot.com",
    messagingSenderId: "386154409103",
    appId: "1:386154409103:web:2ea259453e03f46832d4fa"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);

function requestPermission () {
    console.log('Requesting permission...');
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            getToken(messaging, { vapidKey: 'BHa_WW_-OSAOjE-zth6cp9M_nxYbUY812v4xnoayydb4EWXNPH_ogF65Vez8eyPm55Zde6mzFVju7n9RUlSXCpI' }).then((currentToken) => {
                if (currentToken) {
                    $.ajax({
                        url: "api?route=save-push-sub&data=" + JSON.stringify({subscription: currentToken, deviceId: localStorage.getItem('deviceId')}),
                        type: "GET",
                        contentType: "application/json",
                        success: function(response) {
                            console.log(response.message)
                        }
                    });
                } else {
                    showModal('PushNotificationRequest');
                    alert("Keine Push Sub eingerichtet")
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);
                // ...
            });
        }
    });
}

window.requestPermission = requestPermission;
