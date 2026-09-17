# Gestão Advocacia

Um sistema prático e eficiente de gestão para escritórios de advocacia, construído em **PHP** com banco de dados **SQLite** e arquitetura **MVC**.

O projeto funciona de forma isolada (Multi-Tenant), permitindo que cada advogado gerencie sua própria carteira de clientes, processos, agenda e setor financeiro, tudo com base no seu e-mail de acesso.

---

## 📱 Responsividade & Experiência Mobile (App-Like)
O sistema foi desenvolvido com abordagem mobile-first, proporcionando uso fluido em celulares, tablets e computadores:
- **Menu Lateral Offcanvas (Gaveta):** Acesso rápido e intuitivo a todos os módulos através do botão hambúrguer (☰).
- **Barra de Navegação Inferior Fixa:** Atalhos na parte inferior da tela do celular (Início, Clientes, Processos, Prazos e Mais), semelhante a um aplicativo nativo.
- **Tabelas Touch-Friendly:** Rolagem horizontal suave em telas menores, mantendo os botões de ação organizados e acessíveis.
- **Login e 2FA Mobile:** Layout adaptável para teclados virtuais de smartphones (Android e iOS) sem cortes de tela.
- **Formulários Responsivos:** Alinhamento automático dos campos e botões para facilitar o preenchimento com uma única mão.

---

## 🚀 Principais Funcionalidades
- **Gestão de Clientes:** Cadastro e acompanhamento de clientes (Nome, E-mail, Telefone/WhatsApp, CPF/CNPJ).
- **Gestão de Processos:** Controle de andamentos, tribunais, varas e notificações automáticas via WhatsApp.
- **Prazos e Agenda:** Acompanhamento de datas importantes, audiências e reuniões com alerta de proximidade.
- **Módulo Financeiro:** Controle de fluxo de caixa, honorários advocatícios e custas/indenizações de clientes.
- **Gestão de Documentos:** Armazenamento seguro de arquivos para clientes e processos.
- **Autenticação Segura (2FA):** Proteção extra no login via código enviado por e-mail (SMTP).
- **Multi-Tenant:** Isolamento total de dados para cada conta cadastrada.

---

## 💻 Como Executar o Projeto

1. Clone o repositório em seu servidor web (ex: WAMP, XAMPP, Laragon):
   ```bash
   git clone https://github.com/seu-usuario/gestao-advogados.git
   ```

2. Configure o caminho base do projeto no arquivo `config.php`:
   ```php
   define('BASE_URL', 'http://localhost/Gestaoadvocacia'); // Altere se necessário
   ```

3. **Banco de Dados:** O sistema utiliza **SQLite**. Nenhuma configuração extra de SGBD é necessária. O arquivo `database.sqlite` é gerado/lido automaticamente na pasta `db/`.

4. **Configuração de E-mail:** Para ativar o envio de código 2FA, configure as credenciais SMTP no arquivo `app/controllers/AuthController.php`.

5. Acesse no navegador: `http://localhost/Gestaoadvocacia`

---

## 🛠 Tecnologias
- **Backend:** PHP 8 (MVC / Orientação a Objetos)
- **Banco de Dados:** SQLite (via PDO)
- **Frontend:** HTML5, CSS3, Bootstrap 5 e Bootstrap Icons
- **Dependências de Terceiros:** PHPMailer