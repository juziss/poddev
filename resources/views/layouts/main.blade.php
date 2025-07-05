<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Fontes do Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="/" class="logo-link" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <img src="img/poddev_logo.png" alt="Poddev Logo" class="logo">
                    <p class="logo-title">PODDEV</p>
                </a>
                <ul class="nav-links">
                    <li><a href="">Sobre</a></li>
                    <li><a href="">Episódios</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
            </div>

            <div class="nav-right">
                <div class="search-box">
                    <input type="text">
                    <span class="search-icon">
                        <img src="img/search.svg" alt="Ícone de pesquisa">
                    </span>
                </div>
                <button type="submit">Cadastrar</button>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="main-footer">
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    © {{ date('Y') }} PODDEV. Todos os direitos reservados.
                </p>
                <p class="footer-credits">
                    Desenvolvido com ❤️ por <strong>Julia Coutinho</strong>
                </p>
            </div>
        </div>
    </footer>
</body>

</html>