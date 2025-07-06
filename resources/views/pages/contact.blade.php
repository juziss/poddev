@extends('layouts.main')

@section('title', 'Contato - PODDEV')

@section('content')
<div class="contact-container">
    
    {{-- Hero Section --}}
    <section class="contact-hero">
        <div class="hero-content">
            <h1 class="hero-title">Entre em Contato</h1>
            <p class="hero-subtitle">
                Tem uma sugestão de pauta? Quer participar do podcast? 
                Ou apenas bater um papo sobre tecnologia? Adoraríamos ouvir você!
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <div class="contact-main">
        
        {{-- Contact Methods --}}
        <div class="contact-methods">
            <h2>Como falar conosco</h2>
            
            <div class="methods-grid">
                <div class="method-card email">
                    <div class="method-icon">📧</div>
                    <h3>Email</h3>
                    <p>Para propostas, parcerias e feedback</p>
                    <a href="mailto:contato@poddev.com" class="contact-link">
                        contato@poddev.com
                    </a>
                </div>

                <div class="method-card community">
                    <div class="method-icon">👥</div>
                    <h3>Comunidade</h3>
                    <p>Faça parte da nossa comunidade</p>
                    <div class="community-links">
                        <a href="https://discord.gg/poddev" target="_blank" class="community-link discord">
                            🎮 Discord
                        </a>
                        <a href="https://t.me/poddev" target="_blank" class="community-link telegram">
                            ✈️ Telegram
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Suggestions Section --}}
        <div class="suggestions-section">
            <h2>Sugestões e Ideias</h2>
            <div class="suggestions-content">
                <div class="suggestion-item">
                    <h3>💡 Tem uma ideia de pauta?</h3>
                    <p>
                        Adoramos receber sugestões da comunidade! Se você tem uma tecnologia, 
                        ferramenta ou tópico que gostaria de ver no podcast, nos mande um email 
                        com o assunto "Sugestão de Pauta".
                    </p>
                </div>

                <div class="suggestion-item">
                    <h3>🎤 Quer participar como convidado?</h3>
                    <p>
                        Se você é um desenvolvedor experiente, tem uma história interessante 
                        para contar ou trabalha com alguma tecnologia inovadora, adoraríamos 
                        ter você como convidado!
                    </p>
                </div>

                <div class="suggestion-item">
                    <h3>🤝 Parcerias e Colaborações</h3>
                    <p>
                        Representa uma empresa, evento ou comunidade tech? Vamos conversar 
                        sobre possíveis parcerias e como podemos colaborar juntos.
                    </p>
                </div>

                <div class="suggestion-item">
                    <h3>🐛 Reportar problemas</h3>
                    <p>
                        Encontrou algum bug no site ou problema nos episódios? 
                        Nos ajude a melhorar reportando qualquer issue que encontrar.
                    </p>
                </div>
            </div>
        </div>

        {{-- Team Section --}}
        <div class="team-section">
            <h2>Nossa Equipe</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">👨‍💻</div>
                    <h3>Juping Kernel da Silva</h3>
                    <p class="member-role">Host & Fundador</p>
                    <p class="member-bio">
                        Desenvolvedor apaixonado por tecnologia e educação. 
                        Acredita que compartilhar conhecimento é a melhor forma de crescer.
                    </p>
                </div>

                <div class="team-member">
                    <div class="member-avatar">👩‍💻</div>
                    <h3>Julia Coutinho</h3>
                    <p class="member-role">Desenvolvedora & Criadora do Site</p>
                    <p class="member-bio">
                        Responsável pelo desenvolvimento e manutenção da plataforma. 
                        Especialista em Laravel e experiência do usuário.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* =================================
   CONTACT PAGE STYLES
   ================================= */

.contact-container {
    max-width: 1200px;
    margin: 100px auto 0;
    padding: 20px;
}

/* =================================
   HERO SECTION
   ================================= */
.contact-hero {
    text-align: center;
    padding: 60px 0;
    background: linear-gradient(135deg, #2d3250 0%, #676f9d 100%);
    color: white;
    border-radius: 20px;
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(248,177,121,0.1) 0%, transparent 70%);
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
    50% { transform: translate(-50%, -50%) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3rem;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.95;
}

/* =================================
   MAIN CONTENT
   ================================= */
.contact-main {
    display: flex;
    flex-direction: column;
    gap: 60px;
}

.contact-main h2 {
    color: #2d3250;
    font-size: 2rem;
    margin-bottom: 30px;
    text-align: center;
}

/* =================================
   CONTACT METHODS
   ================================= */
.methods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.method-card {
    background: white;
    padding: 30px 25px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease;
    border-left: 4px solid;
}

.method-card:hover {
    transform: translateY(-8px);
}

.method-card.email { border-left-color: #3b82f6; }
.method-card.social { border-left-color: #ef4444; }
.method-card.platforms { border-left-color: #10b981; }
.method-card.community { border-left-color: #8b5cf6; }

.method-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}

.method-card h3 {
    color: #2d3250;
    font-size: 1.3rem;
    margin-bottom: 10px;
}

.method-card p {
    color: #6b7280;
    margin-bottom: 20px;
    line-height: 1.5;
}

.contact-link {
    color: #676f9d;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: #f8b179;
}

/* Social Links */
.social-links,
.platform-links,
.community-links {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.social-link,
.platform-link,
.community-link {
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.social-link:hover,
.platform-link:hover,
.community-link:hover {
    transform: translateY(-2px);
}

/* Specific platform colors */
.twitter { background: #1da1f2; color: white; }
.instagram { background: #e4405f; color: white; }
.linkedin { background: #0077b5; color: white; }
.spotify { background: #1db954; color: white; }
.youtube { background: #ff0000; color: white; }
.apple { background: #a855f7; color: white; }
.discord { background: #5865f2; color: white; }
.telegram { background: #0088cc; color: white; }

.platform-link img {
    width: 20px;
    height: 20px;
}

/* =================================
   SUGGESTIONS SECTION
   ================================= */
.suggestions-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.suggestion-item {
    background: #f9fafb;
    padding: 25px;
    border-radius: 12px;
    border-left: 4px solid #f8b179;
}

.suggestion-item h3 {
    color: #2d3250;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.suggestion-item p {
    color: #4b5563;
    line-height: 1.6;
}

/* =================================
   FAQ SECTION
   ================================= */
.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.faq-item h3 {
    color: #2d3250;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.faq-item p {
    color: #4b5563;
    line-height: 1.6;
}

/* =================================
   TEAM SECTION
   ================================= */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.team-member {
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease;
}

.team-member:hover {
    transform: translateY(-4px);
}

.member-avatar {
    font-size: 4rem;
    margin-bottom: 20px;
}

.team-member h3 {
    color: #2d3250;
    margin-bottom: 8px;
}

.member-role {
    color: #676f9d;
    font-weight: 600;
    margin-bottom: 15px;
}

.member-bio {
    color: #6b7280;
    line-height: 1.5;
    font-size: 14px;
}

/* =================================
   RESPONSIVE
   ================================= */
@media (max-width: 768px) {
    .contact-container {
        margin-top: 80px;
        padding: 15px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .contact-main {
        gap: 40px;
    }
    
    .contact-main h2 {
        font-size: 1.8rem;
    }
    
    .methods-grid {
        grid-template-columns: 1fr;
    }
    
    .suggestions-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .method-card {
        padding: 25px 20px;
    }
    
    .suggestion-item {
        padding: 20px;
    }
    
    .faq-item {
        padding: 20px;
    }
    
    .team-member {
        padding: 25px;
    }
}
</style>
@endsection