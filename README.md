# Gestão Advogados

Um sistema de gestão de escritórios de advocacia leve e prático, construído em **PHP** com **SQLite** (Arquitetura MVC). O sistema funciona de forma isolada (Multi-Tenant), permitindo que cada advogado tenha sua própria carteira de clientes, processos, agenda e financeiro, com base no e-mail de acesso.

## Funcionalidades
- **Gestão de Clientes:** Cadastro completo com nome, e-mail, telefone, CPF/CNPJ.
- **Gestão de Processos:** Controle de status, tribunal, vara, e parte contrária. Permite notificar clientes automaticamente via WhatsApp sobre andamentos processuais.
- **Agenda (Prazos):** Controle de audiências, prazos e reuniões.
- **Financeiro:** Fluxo de caixa com controle de receitas e despesas por advogado.
- **Documentos:** Armazenamento seguro de arquivos atrelados a cada processo/cliente.
- **Multi-Tenant:** Isolamento completo de dados. Cada conta criada possui seu próprio banco de informações.
- **Autenticação Segura (2FA):** Sistema de login com validação em duas etapas enviando um código para o e-mail via SMTP do Gmail.

## Como Instalar

1. Clone o repositório no seu servidor ou ambiente local (ex: WAMP, XAMPP):
   ``bash
   git clone https://github.com/seu-usuario/gestao-advogados.git
   ``
2. O sistema não requer configuração de MySQL. Ele utiliza um banco de dados **SQLite** \database.sqlite\ localizado na pasta \db/\. O banco será criado automaticamente (se houver o arquivo \setup.php\) ou você pode utilizar a versão já inclusa.
3. Acesse a pasta do projeto e abra o arquivo \config.php\. Verifique a constante \BASE_URL\ para garantir que aponta para o diretório correto:
   ``php
   define('BASE_URL', 'http://localhost/Gestaoadvocacia');
   ``
4. **Configuração de E-mail (Opcional):** Para que o sistema de login 2FA envie e-mails corretamente, configure as credenciais SMTP no arquivo \pp/controllers/AuthController.php\ com seu e-mail e senha de aplicativo (App Password).

## Tecnologias Utilizadas
- **Backend:** PHP 8 (Orientado a Objetos / MVC)
- **Banco de Dados:** SQLite
- **Frontend:** HTML5, CSS3, Bootstrap 5 e Bootstrap Icons
- **Envio de E-mails:** PHPMailer