// TODO: Ersetzen Sie diese Konfigurationsdetails durch Ihre
const firebaseConfig = {
    apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
    authDomain: "necto-dfceb.firebaseapp.com",
    projectId: "necto-dfceb",
    storageBucket: "necto-dfceb.appspot.com",
    messagingSenderId: "386154409103",
    appId: "1:386154409103:web:2ea259453e03f46832d4fa",
    measurementId: "G-X5XERRSSVJ"
};

// Initialisieren Sie Firebase
const app = firebase.initializeApp(firebaseConfig);
// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();

// Anfordern der Berechtigung vom Benutzer, um Push-Benachrichtigungen zu empfangen.
messaging.requestPermission().then(function() {
    console.log('Notification permission granted.');
    return messaging.getToken(); // Get the token.
}).then(function(token) {
    console.log(token); // Token ausgeben oder an Ihren Server senden
}).catch(function(err) {
    console.log('Unable to get permission to notify.', err);
});

// Vordergrund-Nachrichtenempfang
messaging.onMessage(function(payload) {
    console.log('Message received. ', payload);
    // Verarbeiten Sie die empfangene Nachricht
});