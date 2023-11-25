<?php

    if(isset($_GET['token'])) {

    } else {
//        header("HTTP/1.1 403");
//        header("Location: login.html");
//        exit();
    }
    require_once __DIR__.'/../bootstrap.php';
    require_once 'AdminController.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="webmanifest.json" />
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#fcfcfc">
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/style.css">
    <title>Necto Clothing - Dashboard</title>
</head>
<body>
    <div id="modal">
        <div id="push-permit" data-shown="false">
            <div id="example-push-notification">
                <img src="<?php echo $_ENV['URL']; ?>/admin/logo.jpg" alt="">
                <div>
                    <div>
                        <span><b>⚠️ dispatch orders ⚠️</b></span>
                        <span>Dispatch packages today to stay in timing!</span>
                    </div>
                    <span>now</span>
                </div>
            </div>
            <h2>Allow push notifications</h2>
            <p>To get this <b>app working</b>, it's <b>required</b> to send <b>push notifications</b>. You get <b>notified</b> in following scenarios:</p>
            <ul>
                <li>new <b>orders</b></li>
                <li><b>payment problems</b> (e.g. user rethrow the payment)</li>
                <li>costumer <b>support requests</b></li>
            </ul>
            <button id="allow-push-notification"><b>Allow</b> Push-Notifications</button>
        </div>

    </div>
    <div class="widget-wrapper">
        <img src="<?php echo $_ENV['URL']; ?>/admin/logo.jpg" alt="" height="120px" style="object-fit: cover; border-radius: 15px;">
        <div>
            <div style="display: flex; flex-flow: row; align-items: center; gap: 14px">
                <h4>sales</h4>
                <span id="sales-day">today</span>
            </div>
            <div id="sales-wrapper">
                <span id="euro"><?php echo AdminController::getDayAmount(); ?></span>
                <div id="sales-wrapper-column">
                    <span id="cent">.00</span>
                    <span id="currency">BGR</span>
                </div>
            </div>
            <a class="small" href="">view more</a>
        </div>
        <div>
            <h4>dispatch</h4>
            <div>
                <span id="orders-to-package"><?php echo AdminController::countDispatches(); ?></span>
                <span>Orders to dispatch</span>
            </div>
            <button id="start-dispatching">Start dispatching</button>
        </div>
<!--        <div>-->
<!--            <h4>costumer support</h4>-->
<!--            <span id="support-requests-count">4 requests to answer</span><br>-->
<!--            <button>review support requests</button>-->
<!--        </div>-->
        <div>
            <h4><svg viewBox="0 0 60 25" xmlns="http://www.w3.org/2000/svg" width="40" height="16" class="UserLogo variant-- "><title>Stripe logo</title><path fill="#635BFFFF" d="M59.64 14.28h-8.06c.19 1.93 1.6 2.55 3.2 2.55 1.64 0 2.96-.37 4.05-.95v3.32a8.33 8.33 0 0 1-4.56 1.1c-4.01 0-6.83-2.5-6.83-7.48 0-4.19 2.39-7.52 6.3-7.52 3.92 0 5.96 3.28 5.96 7.5 0 .4-.04 1.26-.06 1.48zm-5.92-5.62c-1.03 0-2.17.73-2.17 2.58h4.25c0-1.85-1.07-2.58-2.08-2.58zM40.95 20.3c-1.44 0-2.32-.6-2.9-1.04l-.02 4.63-4.12.87V5.57h3.76l.08 1.02a4.7 4.7 0 0 1 3.23-1.29c2.9 0 5.62 2.6 5.62 7.4 0 5.23-2.7 7.6-5.65 7.6zM40 8.95c-.95 0-1.54.34-1.97.81l.02 6.12c.4.44.98.78 1.95.78 1.52 0 2.54-1.65 2.54-3.87 0-2.15-1.04-3.84-2.54-3.84zM28.24 5.57h4.13v14.44h-4.13V5.57zm0-4.7L32.37 0v3.36l-4.13.88V.88zm-4.32 9.35v9.79H19.8V5.57h3.7l.12 1.22c1-1.77 3.07-1.41 3.62-1.22v3.79c-.52-.17-2.29-.43-3.32.86zm-8.55 4.72c0 2.43 2.6 1.68 3.12 1.46v3.36c-.55.3-1.54.54-2.89.54a4.15 4.15 0 0 1-4.27-4.24l.01-13.17 4.02-.86v3.54h3.14V9.1h-3.13v5.85zm-4.91.7c0 2.97-2.31 4.66-5.73 4.66a11.2 11.2 0 0 1-4.46-.93v-3.93c1.38.75 3.1 1.31 4.46 1.31.92 0 1.53-.24 1.53-1C6.26 13.77 0 14.51 0 9.95 0 7.04 2.28 5.3 5.62 5.3c1.36 0 2.72.2 4.09.75v3.88a9.23 9.23 0 0 0-4.1-1.06c-.86 0-1.44.25-1.44.9 0 1.85 6.29.97 6.29 5.88z" fill-rule="evenodd"></path></svg>Dashboard</h4>
            <span>To view all the important data around finances, go to the Stripe Dashboard.</span><br>
            <button id="go-to-stripe">go to Stripe</button>
        </div>
        <div>
            <h4>products</h4>
            <span>Set stock amount and edit the offers</span><br>
            <button onclick="window.location = '/admin/products.php'">edit products</button>
        </div>
    </div>
    <script>
        document.getElementById('go-to-stripe').addEventListener('click', () => {
            window.location = '<?php echo $_ENV['STRIPE_DASHBOARD_LINK'] ?>';
        });

        document.getElementById('start-dispatching').addEventListener('click', () => {
           window.location = '<?php echo $_ENV['URL'] ?>/admin/dispatching.php';
        });

    </script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-analytics.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging.js";
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

        function requestPermission() {
            console.log('Requesting permission...');
            Notification.requestPermission().then((permission) => {
                if (permission === 'granted') {
                    console.log('Notification permission granted.')
                    document.getElementById('push-permit').dataset.shown = false;
                }
            });
        }

        // Get registration token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        getToken(messaging, { vapidKey: 'BHa_WW_-OSAOjE-zth6cp9M_nxYbUY812v4xnoayydb4EWXNPH_ogF65Vez8eyPm55Zde6mzFVju7n9RUlSXCpI' }).then((currentToken) => {
            if (currentToken) {
                console.log(currentToken);
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                document.getElementById('push-permit').dataset.shown = true;
                document.getElementById('allow-push-notification').addEventListener('click', () => {
                     requestPermission();
                });
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
        });

    </script>
</body>
</html>
