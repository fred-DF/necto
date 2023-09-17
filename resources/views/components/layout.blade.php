<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Necto Clothing</title>
</head>
<body>
    {{ $content }}
    <script src="main.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-analytics.js";
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
    </script>
</body>
</html>
