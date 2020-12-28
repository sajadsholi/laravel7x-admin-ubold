$(function() {


    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyD6OOXG313JJq_UN4kd4xxJib9BGPImDGY",
        authDomain: "admin-569cc.firebaseapp.com",
        databaseURL: "https://admin-569cc.firebaseio.com",
        projectId: "admin-569cc",
        storageBucket: "admin-569cc.appspot.com",
        messagingSenderId: "333589594165",
        appId: "1:333589594165:web:beea28bd20df5d8ac7b17c",
        measurementId: "G-JB9CW6MK5D"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    requestPermission();
    refreshToken();


    // first request to user for give the permission
    function requestPermission() {
        messaging.requestPermission().then(function() {
            // Get Instance ID token. Initially this makes a network call, once retrieved
            // subsequent calls to getToken will return from cache.
            messaging.getToken().then(function(currentToken) {
                console.log("TCL: requestPermission -> currentToken", currentToken)
                if (currentToken) {
                    savePushToken(currentToken);
                } else {
                    removeLocal("pushToken");
                    removeLocal("pushSaved");
                }
            }).catch(function(err) {
                removeLocal("pushToken");
                removeLocal("pushSaved");
                // requestPermission();
            });
        }).catch(function(err) {
            removeLocal("pushToken");
            removeLocal("pushSaved");
        });
    }

    // second save the pushToken
    let savePushToken = function(pushToken) {
        console.log("TCL: savePushToken -> pushToken", pushToken)
        if (pushToken) {
            $.ajax({
                method: "POST",
                url: baseAdminUrl + "/notification/savePushToken",
                data: {
                    token: pushToken,
                }
            }).done(function(response) {
                console.log(response);
                setLocal("pushSaved", true);
                setLocal("pushToken", pushToken);
            }).fail(function(response) {
                setLocal("pushSaved", false);
            });
        }
    }

    function refreshToken() {
        // Callback fired if Instance ID token is updated.
        messaging.onTokenRefresh(function() {
            messaging.getToken().then(function(refreshedToken) {
                if (getSession('pushToken') !== refreshedToken) {
                    removeLocal("pushToken");
                    removeLocal("pushSaved");
                    removeLocal("oldPushSaved");
                    savePushToken(refreshedToken);
                }
            }).catch(function(err) {
                removeLocal("pushToken");
                removeLocal("pushSaved");
                removeLocal("oldPushSaved");
            });
        });
    }

    $('#logoutButton').on('click', function() {
        let pushToken = getLocal("pushToken");
        removeLocal("pushToken");
        removeLocal("pushSaved");
        $.ajax({
            method: "POST",
            url: baseAdminUrl + "/notification/removePushToken",
            data: {
                token: pushToken,
            }
        }).done(function(response) {
            $('#logoutForm').submit();
        });
    });

    messaging.onMessage(function(payload) {
        console.log("TCL: payload", payload)
        let orderSound = new Audio(assetPath + '/order.mp3');
        let supportSound = new Audio(assetPath + '/support.m4a');

        if (payload.data.key === 'order') {
            orderSound.play();
        }

        if (payload.data.key === 'support') {
            supportSound.play();
        }

        toastr.info(`<a href="${payload.data.link}" target="_blank">${payload.data.msg}</a>`, `<a href="${payload.data.link}" target="_blank">${payload.data.title}</a>`, { timeOut: 50000 });
    });


});