<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>yupekyoly.com</title>
  <script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js"
        integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD"
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="{{ asset('index/style.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container noselect">
  <div class="wrapper">
    <button id="replay">
      <i class="fas fa-play"></i>
      RESTART
    </button>
    <div id="canvas">

    </div>
    <div id="ui">
      <h2>SCORE
      </h2>
      <span id="score">00</span>
    </div>
  </div>
  <div id="author">
    <h1>SNAKE</h1> <span>by yupekyoly.com</span>
  </div>
</div>
<!-- partial -->
  <script  src="{{ asset('index/script.js') }}"></script>

</body>
</html>
