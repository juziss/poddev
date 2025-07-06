@extends('layouts.main')

@section('title', 'Sobre o PODDEV - Podcast para Desenvolvedores')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
<div class="about-container">
    
    {{-- Hero Section --}}
    <section class="about-hero">
        <div class="hero-content">
            <h1 class="hero-title">Sobre o PODDEV</h1>
            <p class="hero-subtitle">
                O podcast que conecta desenvolvedores através de histórias, 
                conhecimento e experiências reais do mundo da tecnologia.
            </p>
        </div>
        <div class="hero-stats">
            <div class="stat-card">
                <span class="stat-number">{{ \App\Models\Episode::published()->count() }}+</span>
                <span class="stat-label">Episódios</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ \App\Models\Episode::published()->sum('views_count') }}+</span>
                <span class="stat-label">Visualizações</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ \App\Models\Category::active()->count() }}</span>
                <span class="stat-label">Categorias</span>
            </div>
        </div>
    </section>

    {{-- Missão e Visão --}}
    <section class="mission-section">
        <div class="mission-grid">
            <div class="mission-item">
                <div class="mission-icon">🎯</div>
                <h3>Nossa Missão</h3>
                <p>
                    Democratizar o conhecimento em tecnologia, criando conteúdo acessível 
                    que inspira e capacita desenvolvedores de todos os níveis a crescerem 
                    em suas carreiras e projetos.
                </p>
            </div>
            <div class="mission-item">
                <div class="mission-icon">👁️</div>
                <h3>Nossa Visão</h3>
                <p>
                    Ser a principal referência em conteúdo de qualidade para desenvolvedores 
                    no Brasil, promovendo uma comunidade forte, colaborativa e sempre 
                    em constante aprendizado.
                </p>
            </div>
            <div class="mission-item">
                <div class="mission-icon">💎</div>
                <h3>Nossos Valores</h3>
                <p>
                    Transparência, qualidade, inclusão e paixão pela tecnologia. 
                    Acreditamos que o conhecimento compartilhado é a base para 
                    a evolução de toda a comunidade tech.
                </p>
            </div>
        </div>
    </section>

    {{-- O que você vai encontrar --}}
    <section class="content-section">
        <h2 class="section-title">O que você vai encontrar</h2>
        <div class="content-grid">
            <div class="content-card frontend">
                <div class="card-icon">⚛️</div>
                <h4>Frontend</h4>
                <p>React, Vue, Angular, JavaScript moderno, CSS avançado e muito mais.</p>
                <ul>
                    <li>Frameworks modernos</li>
                    <li>Boas práticas de UI/UX</li>
                    <li>Performance web</li>
                </ul>
            </div>
            
            <div class="content-card backend">
                <div class="card-icon">⚙️</div>
                <h4>Backend</h4>
                <p>APIs robustas, arquitetura de software, bancos de dados e escalabilidade.</p>
                <ul>
                    <li>Node.js, PHP, Python</li>
                    <li>Design de APIs</li>
                    <li>Microserviços</li>
                </ul>
            </div>
            
            <div class="content-card devops">
                <div class="card-icon">🚀</div>
                <h4>DevOps</h4>
                <p>Docker, Kubernetes, CI/CD, cloud computing e automação.</p>
                <ul>
                    <li>Containerização</li>
                    <li>Deploy automatizado</li>
                    <li>Monitoramento</li>
                </ul>
            </div>
            
            <div class="content-card mobile">
                <div class="card-icon">📱</div>
                <h4>Mobile</h4>
                <p>React Native, Flutter, desenvolvimento nativo e cross-platform.</p>
                <ul>
                    <li>Apps multiplataforma</li>
                    <li>Performance mobile</li>
                    <li>Publicação nas stores</li>
                </ul>
            </div>
            
            <div class="content-card career">
                <div class="card-icon">💼</div>
                <h4>Carreira</h4>
                <p>Dicas de crescimento profissional, entrevistas e mercado de trabalho.</p>
                <ul>
                    <li>Como crescer na carreira</li>
                    <li>Soft skills importantes</li>
                    <li>Networking efetivo</li>
                </ul>
            </div>
            
            <div class="content-card community">
                <div class="card-icon">🤝</div>
                <h4>Comunidade</h4>
                <p>Open source, eventos, comunidades tech e networking.</p>
                <ul>
                    <li>Contribuições open source</li>
                    <li>Eventos e meetups</li>
                    <li>Mentoria</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- História --}}
    <section class="story-section">
        <div class="story-content">
            <h2 class="section-title">Nossa História</h2>
            <div class="story-text">
                <p>
                    O PODDEV nasceu da paixão por compartilhar conhecimento e da percepção de que 
                    o mundo da tecnologia evolui rapidamente, mas nem sempre as informações chegam 
                    de forma acessível a todos os desenvolvedores.
                </p>
                <p>
                    Fundado em 2024, nosso podcast começou com conversas simples entre desenvolvedores 
                    que queriam compartilhar suas experiências, erros, acertos e aprendizados. 
                    Com o tempo, percebemos que essas conversas poderiam ajudar muito mais pessoas.
                </p>
                <p>
                    Hoje, o PODDEV é uma plataforma completa de conteúdo para desenvolvedores, 
                    com episódios semanais, artigos, dicas de carreira e uma comunidade ativa 
                    que cresce a cada dia.
                </p>
            </div>
        </div>
        <div class="story-timeline">
            <div class="timeline-item">
                <div class="timeline-date">2024</div>
                <div class="timeline-content">
                    <h4>O Início</h4>
                    <p>Primeiro episódio gravado e publicado</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">2024</div>
                <div class="timeline-content">
                    <h4>Crescimento</h4>
                    <p>{{ \App\Models\Episode::published()->count() }}+ episódios publicados</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">Hoje</div>
                <div class="timeline-content">
                    <h4>Comunidade</h4>
                    <p>Milhares de desenvolvedores ouvindo nosso conteúdo</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="cta-section">
        <div class="cta-content">
            <h2>Junte-se à nossa comunidade!</h2>
            <p>
                Não perca nenhum episódio e faça parte de uma comunidade de 
                desenvolvedores apaixonados por tecnologia.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('episodes.index') }}" class="btn-primary">
                    Explorar Episódios
                </a>
                <a href="{{ route('contact') }}" class="btn-secondary">
                    Entrar em Contato
                </a>
            </div>
        </div>
        
        <div class="platforms-section">
            <h3>Ouça onde preferir</h3>
            <div class="platform-links">
                <a href="https://open.spotify.com/" target="_blank" class="platform-link spotify">
                    <img src="{{ asset('img/spotify.svg') }}" alt="Spotify">
                    Spotify
                </a>
                <a href="https://www.youtube.com/" target="_blank" class="platform-link youtube">
                    <img src="{{ asset('img/youtube.svg') }}" alt="YouTube">
                    YouTube
                </a>
                <a href="https://podcasts.apple.com/" target="_blank" class="platform-link apple">
                    <img src="{{ asset('img/applepodcasts.svg') }}" alt="Apple Podcasts">
                    Apple Podcasts
                </a>
            </div>
        </div>
    </section>
</div>
@endsection