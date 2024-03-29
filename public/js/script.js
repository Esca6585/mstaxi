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
            $("#success").html('travel_id = ' + res.travel.id);
            console.log(res.travel.id);
            $("#travel_id").val(res.travel.id);
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

const coordinates = [
    37.91276288885965, 58.35814118385315,
    37.91258936670235, 58.35819482803345,
    37.91257666994307, 58.358269929885864,
    37.91260206345944, 58.35859715938568,
    37.91277135334466, 58.35970222949982,
    37.91416798003319, 58.35942327976227,
    37.9150101754325, 58.36507201194763,
    37.91577195191051, 58.37014138698578,
    37.91590314595206, 58.37030231952667,
    37.91595393067954, 58.37134838104248,
    37.91595393067954, 58.371477127075195,
    37.915970858914214, 58.37154150009155,
    37.91647447211442, 58.371976017951965,
    37.91793027575645, 58.37291479110718,
    37.91964419369461, 58.373998403549194,
    37.920871419037994, 58.37460994720459,
    37.922915338550254, 58.37558627128601,
    37.92437947785409, 58.376208543777466,
    37.924726466132824, 58.3766108751297,
    37.92478993942129, 58.37683081626892,
    37.92482379181941, 58.37707757949829,
    37.92481532872133, 58.37743163108826,
    37.923977477191194, 58.38117599487305,
    37.923816676310686, 58.38135302066803,
    37.923740507349834, 58.38164806365967,
    37.92360509566906, 58.38214159011841,
    37.923456988857716, 58.382753133773804,
    37.92341890420087, 58.38302135467529,
    37.92334273482802, 58.38313937187195,
    37.92332157665488, 58.38327348232269,
    37.92330465011199, 58.383461236953735,
    37.92337658789235, 58.38352560997009,
    37.92347391536555, 58.38358461856842,
    37.923622022142794, 58.38358998298645,
    37.923748970571594, 58.38357925415039,
    37.923926698003754, 58.38362216949463,
    37.924404867295856, 58.383724093437195,
    37.925217324803896, 58.383997678756714,
    37.92744730526719, 58.38490962982178,
    37.92979569355008, 58.38582694530487,
    37.92986762498018, 58.385998606681824,
    37.92999879387742, 58.386229276657104,
    37.93002418137889, 58.38640630245209,
    37.929943787594176, 58.386738896369934,
    37.929791462287305, 58.38728606700897,
    37.92922023957577, 58.38935673236847,
    37.92891135433481, 58.39049935340881,
    37.928674400393696, 58.39136838912964,
    37.928555923136756, 58.39151859283447,
    37.92846283372952, 58.39159369468689,
    37.92839090092502, 58.391674160957336,
    37.928352818823555, 58.39179217815399,
    37.92834012478536, 58.39189410209656,
    37.92838666958138, 58.39203894138336,
    37.928610930458376, 58.392194509506226,
    37.928716713653486, 58.392205238342285,
    37.92879710877997, 58.392221331596375,
    37.92886057855458, 58.39225351810455,
    37.92954181735194, 58.3925861120224,
    37.930493848574734, 58.39307963848114,
    37.930739259069185, 58.39312255382538,
    37.93127662056694, 58.393428325653076,
    37.93300292069048, 58.394672870635986,
    37.93458955784577, 58.39608371257782,
    37.935681144322864, 58.39702785015106,
    37.936789638032074, 58.39801490306854,
    37.93981887145132, 58.40062737464905,
    37.94231070311088, 58.402714133262634,
    37.94415096596886, 58.40433418750763,
    37.94613924415671, 58.40610980987549,
    37.94728988270089, 58.40714514255524,
    37.9488423701194, 58.40856671333313,
    37.9511477745577, 58.41062128543854,
    37.954079129298556, 58.4132444858551,
    37.95601638179641, 58.414961099624634,
    37.95816929460673, 58.416892290115356,
    37.9603390623295, 58.41881811618805,
    37.96104961560313, 58.41933846473694,
    37.96192510928972, 58.42004656791687,
    37.96326159160063, 58.42111945152283,
    37.96417089319235, 58.421666622161865,
    37.96461073736345, 58.421908020973206,
    37.96499559885192, 58.42211186885834,
    37.96655617036763, 58.42254102230072,
    37.969089385213685, 58.422642946243286,
    37.96949113913728, 58.42276096343994,
    37.96975756421107, 58.4228253364563,
    37.96983791444038, 58.42277705669403,
    37.96991403562913, 58.422675132751465,
    37.96993940934117, 58.42252492904663,
    37.969956325144324, 58.422439098358154,
    37.970057819881426, 58.42224061489105,
    37.97060335168932, 58.42138230800629,
    37.973711536965766, 58.41684937477112,
    37.97629524795407, 58.41331958770752,
    37.97882812674226, 58.40997755527496,
    37.98093385925555, 58.407171964645386,
    37.983411611701634, 58.403969407081604,
    37.98363570464036, 58.40385138988495,
    37.983779462014304, 58.403921127319336,
    37.983914762814855, 58.40404450893402,
    37.98457857875293, 58.40455412864685,
    37.98478152764995, 58.404709696769714,
    37.984959107474374, 58.40486526489258,
    37.986033033444336, 58.406222462654114,
    37.98748323136431, 58.40801954269409,
    37.98807091273872, 58.40858817100525,
    37.98872200746968, 58.40906023979187,
    37.989791650555, 58.40961813926697,
    37.99034971901719, 58.40985953807831,
    37.99072599005387, 58.409950733184814,
    37.991634951449804, 58.41010093688965,
    37.992818698243276, 58.4100741147995,
    37.99338942647917, 58.40998291969299,
    37.99392632972887, 58.40984880924225,
    37.994949394333645, 58.409425020217896,
    37.99506353702042, 58.40948402881622,
    37.995351006703814, 58.40933382511139,
    37.995811801345845, 58.40909242630005,
    37.99639941600158, 58.40879201889038,
    37.9977352706519, 58.40808928012848,
    37.999020373681866, 58.407407999038696,
    37.99915987364273, 58.40782105922699,
    37.99935855494708, 58.408437967300415,
    37.9999038689525, 58.41003656387329,
    38.000973348986825, 58.413147926330566,
    38.00157783080264, 58.41489136219025,
    38.00209353862267, 58.41461777687073,
    38.00213158249855, 58.41477334499359,
];


function routeSave()
{
    var path = window.location.origin;
    const token = document.getElementById("token").value;
    const tarif_id = document.getElementById("tarif_id").value;
    
    console.log("token:" + token);

    for (let i = 0; i < coordinates.length; i+=2) {
        var data = 'lat=' + coordinates[i] + '&lon=' + coordinates[i+1] + '&tarif_id=' + tarif_id;
        
        console.log(data);

        $.ajax({
            headers: {
                Authorization: 'Bearer ' + token
            },
            url: path + '/api/route-save',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log(res);
                $("#success").html('travel_id = ' + res.travel.id);
                console.log(res.travel.id);
                $("#travel_id").val(res.travel.id);
            },
            error: function(err) {
                console.log(err);
            }
        });
    };
}