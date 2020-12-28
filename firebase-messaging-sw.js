importScripts("https://www.gstatic.com/firebasejs/5.0.3/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/5.0.3/firebase-messaging.js");

// Initialize Firebase
var config = {
    apiKey: "AIzaSyD6OOXG313JJq_UN4kd4xxJib9BGPImDGY",
    authDomain: "admin-569cc.firebaseapp.com",
    databaseURL: "https://admin-569cc.firebaseio.com",
    projectId: "admin-569cc",
    storageBucket: "admin-569cc.appspot.com",
    messagingSenderId: "333589594165",
    appId: "1:333589594165:web:beea28bd20df5d8ac7b17c",
    measurementId: "G-JB9CW6MK5D"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();


// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(payload);
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
// [END background_handler]