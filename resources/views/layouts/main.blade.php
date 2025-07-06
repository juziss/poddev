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
                <a href="{{ route('home') }}" class="logo-link" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <img src="{{ asset('img/poddev_logo.png') }}" alt="Poddev Logo" class="logo">
                    <p class="logo-title">PODDEV</p>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('about') }}">Sobre</a></li>
                    <li><a href="{{ route('episodes.index') }}">Episódios</a></li>
                    <li><a href="{{ route('contact') }}">Contato</a></li>
                </ul>
            </div>

            <div class="nav-right">
                {{-- Formulário de busca funcional --}}
                <form method="GET" action="{{ route('episodes.index') }}" class="search-box">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Buscar episódios..."
                        value="{{ request('search') }}"
                        id="navbar-search"
                    >
                    <button type="submit" class="search-icon">
                        <img src="{{ asset('img/search.svg') }}" alt="Ícone de pesquisa">
                    </button>
                </form>
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

    {{-- Script para busca com Enter --}}
    <script>
        // Busca ao pressionar Enter
        document.getElementById('navbar-search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });

        // Busca ao clicar no ícone
        document.querySelector('.search-icon').addEventListener('click', function(e) {
            e.preventDefault();
            this.closest('form').submit();
        });
    </script>

    <style>
        /* Estilos atualizados para o formulário de busca */
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box input {
            width: 220px;
            padding: 8px 40px 8px 10px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-box input:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #f8b179;
            width: 250px;
        }

        .search-icon {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-icon:hover {
            background-color: rgba(248, 177, 121, 0.2);
        }

        .search-icon img {
            width: 16px;
            height: 16px;
            filter: brightness(0) invert(1);
        }

        /* Novo estilo para o botão Spotify */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-spotify {
            background: #1db954;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-spotify:hover {
            background: #1ed760;
            transform: translateY(-1px);
            color: white !important;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .nav-right {
                flex-direction: column;
                gap: 8px;
            }
            
            .search-box input {
                width: 180px;
            }
            
            .search-box input:focus {
                width: 200px;
            }
            
            .btn-spotify {
                font-size: 12px;
                padding: 6px 10px;
            }
        }

        @media (max-width: 480px) {
            .search-box {
                margin-bottom: 5px;
            }
            
            .search-box input {
                width: 160px;
            }
            
            .nav-actions {
                justify-content: center;
            }
        }
    </style>
</body>

</html>