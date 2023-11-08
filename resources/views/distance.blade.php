<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://api/mapbox.com/mapbox-gl-js/v1.8.0/mapbox-gl.css">
    <title>Map</title>
    <style>
        body {
            margin: 0;
        }
        #map {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
    
    <div id="map2"></div>

    <script src="{{ asset('map.js') }}" type="module"></script>
</body>
</html>