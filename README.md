

🍔 Sistema de Delivery

Aplicação web desenvolvida em Laravel 11 para gerenciamento de pedidos de delivery, com painel administrativo e controle de acesso por usuários.

🚀 Tecnologias

Laravel 11

PHP 8+

MySQL (RDS ou local)

Tailwind CSS (front-end)

Docker (Laradock, opcional)

⚙️ Funcionalidades

✅ Cadastro e gerenciamento de produtos (lanches, combos, porções e bebidas)

✅ Sistema de carrinho e finalização de pedidos

✅ Controle de acesso (admin e usuários)

✅ Painel administrativo para gerenciar pedidos em tempo real

✅ Impressão automática de pedidos em impressora térmica (RawBT / Iffod)

✅ Armazenamento de dados no banco (migrations organizadas)

📦 Instalação
# Clone o repositório
git clone https://github.com/alexandre945/dougao-lanches.git

# Acesse a pasta
cd sistema-delivery

# Instale as dependências
composer install
npm install && npm run dev

# Configure o .env
cp .env.example .env
php artisan key:generate

# Execute as migrations
php artisan migrate

# Inicie o servidor
php artisan serve

👨‍💻 Acesso

Admin: login e senha configurados no banco

Usuário comum: acesso limitado para pedidos

📬 Contato

Autor: Alexandre


- WhatsApp: [Clique aqui](https://wa.me/5535998464219)
