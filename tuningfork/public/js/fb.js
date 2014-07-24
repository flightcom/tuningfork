window.fbAsyncInit = function() {
    FB.init({
        appId      : '1442961679312676',
        cookie     : true,  // enable cookies to allow the server to access 
        oauth      : true,
        status     : true,  // check login status
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.0' // use version 2.0
    });

};

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                // console.log('Successful login for: ' + response.name);
                // console.log(response);
                console.log(response);
                $.ajax({
                    type: 'post',
                    url : '/connexion/fb',
                    // data: JSON.stringify(response),
                    data: $.param(response),
                    success: function(data) {
                        if(data == 1) {
                            console.log('Connection successfull !');
                            location.href = '/';
                        }
                    }
                })
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}
// (function() {
//     var e = document.createElement('script');
//     e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
//     e.async = true;
//     document.getElementById('fb-root').appendChild(e);
// }());

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));