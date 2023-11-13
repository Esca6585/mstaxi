const x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}

function returnPosition(position) {
    return position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
        x.innerHTML = "User denied the request for Geolocation."
        break;
        case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Location information is unavailable."
        break;
        case error.TIMEOUT:
        x.innerHTML = "The request to get user location timed out."
        break;
        case error.UNKNOWN_ERROR:
        x.innerHTML = "An unknown error occurred."
        break;
    }
}

function start() {
    
    $.ajax({
        url: 'http://ip-api.com/json/217.174.228.202',
        type: 'GET',
        success: function (response) {
            console.log(response);
            $("#success").html('ip address: ' + response.query);
            $("#lat").val(response.lat);
            $("#lon").val(response.lon);
            console.log(response);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err.statusText);
            console.log(err);
        }
    });

    var path = window.location.origin;
    const token = document.getElementById("token");
    var data = "lat=37.91363186773645&lon=58.355444373933715&tarif_id=1";

    const successCallback = (position) => {
        console.log(position);
    };
    
    const errorCallback = (error) => {
        console.log(error);
    };
      
    var coord = navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

    console.log(coord);

    $.ajax({
        headers: {
            Authorization: 'Bearer ' + token
        },
        url: path + '/api/travel-start',
        type: 'POST',
        data: data,
        success: function (data) {
            console.log(data);
            $("#success").html(data);
            console.log(data);
            console.log(path);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err);
            console.log(err);
        }
    });
}

function login() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const token = document.getElementById("token");
    
    var path = window.location.origin;
    var data = 'username=' + username + '&password=' + password;

    console.log(path);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path + '/api/login',
        type: 'POST',
        data: data,
        success: function (response) {
            console.log(data);
            $("#success").html(data);
            $("#token").val(response.access_token);
            console.log(data);
            console.log(path);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err);
            console.log(err);
        }
    });
}

function finish() {
    alert('finish');
}