<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>M'S Taxi</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center mh-100" style="height: 800px; flex-direction: column;">
    
        <label for="username">username</label>
        <input type="text" id="username">
        
        <label for="password">password</label>
        <input type="password" id="password">

        <button class="btn btn-primary m-3" onclick="login()">Login</button>
        
        <label for="token">token</label>
        <input type="text" id="token" style="width: 500px;">

        <hr />

        <button class="btn btn-success w-25 m-3" onclick="start()">Start</button>

        <button class="btn btn-danger w-25 m-3" onclick="finish()">Finish</button>
        
        <input type="text" name="lat" id="lat">

        <input type="text" name="lon" id="lon">

        <p id="location">Location</p>

        <p style="color: green;" id="success"></p>
        
        <p style="color: red;" id="error"></p>

        <div>
            <h1>HTML Geolocation</h1>
            <p>Click the button to get your coordinates.</p>

            <button onclick="getLocation()">Try It</button>

            <p id="demo"></p>
        </div>
    </div>

    

    <script src="{{ asset('metronic-template/v7/assets/js/ajax/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>