<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- font do google -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&family=Lavishly+Yours&family=Monsieur+La+Doulaise&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Oswald:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset ('js/scripts.js') }}"></script>
</head>

    <body>

        @yield('content')

        <footer>
            <div>
                <img src="/public/img/poddev_logo.png" alt="logo poddev">
                <p>poddev</p>
            </div>
            <div>
                <p>Ouça em</p>
                <img src="" alt="logo spotify">
                <img src="" alt="logo youtube">
                <img src="" alt="logo google podcasts">
            </div>
        </footer>
    </body>

</html>