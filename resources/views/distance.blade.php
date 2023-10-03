<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distance</title>
</head>
<body>
    
    <button id="start">Start</button>
    <button id="stop">Stop</button>

    <script>
        const start = document.querySelector("#start");
        const stop = document.querySelector("#stop");

        const coordinates = [];

        start.addEventListener("click", () => {
            navigator.geolocation.watchPosition(
                data => {
                    console.log(data);

                    coordinates.push([data.coords.latitude, data.coords.longitude]);
                    window.localStorage.setItem(
                        "coordinates",
                        JSON.stringify(coordinates)
                    );
                },
                error => console.log(error),
                {
                    enableHighAccuracy: true
                }
            )
        });
    </script>

</body>
</html>