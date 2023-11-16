const x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser";
    }
}

function getLocationByIpAddress(){
    x.innerHTML += ' Location getting by ip address!';

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
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;

    $("#lat").val(position.coords.latitude);
    $("#lon").val(position.coords.longitude);
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

    getLocationByIpAddress();
}

function start() {
    var path = window.location.origin;
    const token = document.getElementById("token").value;
    const lat = document.getElementById("lat").value;
    const lon = document.getElementById("lon").value;
    const tarif_id = document.getElementById("tarif_id").value;

    var data = 'lat=' + lat + '&lon=' + lon + '&tarif_id=' + tarif_id;

    console.log("start()");
    console.log("token:" + token);
    console.log("lat:" + lat);
    console.log("lon:" + lon);
    console.log("tarif_id:" + tarif_id);

    $.ajax({
        headers: {
            Authorization: 'Bearer ' + token
        },
        url: path + '/api/travel-start',
        type: 'POST',
        data: data,
        success: function (res) {
            console.log(res);
            $("#success").html('travel_id = ' + res.travel_id);
            console.log(res.travel_id);
            $("#travel_id").val(res.travel_id);
            console.log(path);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err);
            console.log(err);
        }
    });
}

function travel() {

    var path = window.location.origin;
    const token = document.getElementById("token").value;
    const lat = document.getElementById("lat").value;
    const lon = document.getElementById("lon").value;
    const travel_id = document.getElementById("travel_id").value;
    
    var data = 'travel_id=' + travel_id + '&lat=' + lat + '&lon=' + lon;

    console.log("travel()");
    console.log("token:" + token);
    console.log("lat:" + lat);
    console.log("lon:" + lon);
    console.log("travel_id:" + travel_id);

    $.ajax({
        headers: {
            Authorization: 'Bearer ' + token
        },
        url: path + '/api/route-save',
        type: 'POST',
        data: data,
        success: function (res) {
            console.log(res);
            $("#success").html(res.tarif);
            console.log(res.tarif);
            console.log(res.status);
            console.log(res.lastRoute);
            console.log(path);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err.statusText);
            console.log(err);
        },
        complete:function(){ 
            // setTimeout(travel, 10000);
        } 
    });
}

function login() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const token = document.getElementById("token").value;
    
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
            $("#token").val(response.access_token);
            console.log(response.access_token);
            console.log(path);
        },
        error: function(err) {
            console.log(err);
            $("#error").html(err.statusText);
            console.log(err);
        }
    });
}

function finish() {
    alert('finish');
}