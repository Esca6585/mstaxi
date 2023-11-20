<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mstaxi/vip_tarif.svg') }}" />
    <title>M'S Taxi</title>
</head>
<body>
    <div class="d-flex align-items-center mh-100" style="flex-direction: column;">
    
        <label for="username">username</label>
        <input type="text" id="username">
        
        <label for="password">password</label>
        <input type="password" id="password">
        
        <button class="btn btn-primary m-3" onclick="login()">Login</button>
        
        <label for="token">token</label>
        <input type="text" id="token" class="w-25 m-3">

        <button class="btn btn-success w-25 m-3" onclick="start()">Start</button>
        
        <button class="btn btn-warning w-25 m-3" onclick="travel()">Travel</button>

        <button class="btn btn-danger w-25 m-3" onclick="finish()">Finish</button>
        
        <label for="Latitude">Latitude:</label>
        <input type="text" name="lat" id="lat" class="w-25 m-3">

        <label for="Longitude">Longitude:</label>
        <input type="text" name="lon" id="lon" class="w-25 m-3">

        <p id="location">Location</p>

        <p style="color: green;" id="success"></p>
        
        <p style="color: red;" id="error"></p>

        <h1>HTML Geolocation</h1>
        <p>Click the button to get your coordinates.</p>

        <button class="btn btn-secondary w-25 m-3" onclick="getLocation()">getLocation</button>

        <p id="demo"></p>

        <label for="tarif_id">tarif_id</label>
        <input type="text" id="tarif_id" class="w-25 m-3" value="1">

        <label for="travel_id">travel_id</label>
        <input type="text" id="travel_id" class="w-25 m-3" value="1">
        
    </div>

    

    <script src="{{ asset('metronic-template/v7/assets/js/ajax/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>