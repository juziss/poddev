# 🎧 PODDEV

Uma plataforma de podcast para desenvolvedores construída com Laravel. 

> **⚠️ Aviso:** O foco foi o backend, então o frontend era só para ter uma interface funcional.

## 🛠️ Tecnologias

- **Laravel 11** + **PHP 8.1+**
- **mySQL**
- **Blade Templates**

## ✨ Funcionalidades

- ✅ Sistema de episódios com categorias e tags
- ✅ Busca e filtros funcionais
- ✅ Páginas de episódios individuais
- ✅ Interface responsiva (tosca, mas funciona)
- ✅ Models com relacionamentos
- ✅ Seeders com dados de exemplo

## 🚀 Como rodar

```bash
# Clone o projeto
git clone [url-do-repo]
cd poddev

# Instale dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Rode as migrations e seeders
php artisan migrate --seed

# Inicie o servidor
php artisan serve
```

## 📝 Observações

- O foco era estudar Laravel
- Dados de exemplo incluídos nos seeders
- Responsivo funciona, mas design é bem simples
- Projeto finalizado para portfólio de backend
