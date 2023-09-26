<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M'S Taxi</title>
</head>
<body>
    <a href="{{ route('admin.dashboard', app()->getlocale() ) }}" class="brand-logo">
        <img alt="{{ asset('mstaxi/mstaxi_logo.svg') }}"
            src="{{ asset('mstaxi/mstaxi_logo.svg') }}" width="70px" />
        
        <img alt="{{ asset('mstaxi/mstaxi_logo_name.svg') }}"
            src="{{ asset('mstaxi/mstaxi_logo_name.svg') }}" width="150px" />
    </a>
</body>
</html>

<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 800px;
        background: gold;
    }

    a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    img {
        margin-top: 20px;
    }
</style>