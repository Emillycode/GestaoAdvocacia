# Gestão Advocacia - Documentação Completa

Bem-vindo à documentação detalhada do **Gestão Advocacia**. Este documento foi criado para orientar desenvolvedores em futuras atualizações, manutenções e escalabilidade do projeto.

---

## 🏗 Arquitetura do Sistema

O projeto adota a arquitetura **MVC (Model-View-Controller)** pura em PHP, sem frameworks de terceiros, priorizando a leveza e a velocidade:

- **`/app/controllers`**: Contém a lógica de negócio e as regras da aplicação. Responsáveis por intermediar o que vem da view e o que vai para o model. (Ex: `ClienteController.php`, `ProcessoController.php`).
- **`/app/models`**: Interagem com o banco de dados. Os models não possuem lógica de exibição, apenas manipulação de dados (Ex: Cadastro, Leitura, Atualização, Deleção - CRUD).
- **`/app/views`**: Arquivos responsáveis pela interface com o usuário. Utilizam PHP apenas para exibir variáveis e laços de repetição básicos. Estruturadas com Bootstrap 5.
- **`/db`**: Diretório onde reside o banco de dados `database.sqlite` e possíveis scripts de inicialização (como `setup.php`).
- **`/public`**: Arquivos acessíveis publicamente como imagens, CSS (assets gerais) e bibliotecas de front-end.
- **`index.php`**: Ponto único de entrada (Front Controller) para todo o roteamento do sistema, onde ocorre a validação de sessão e o direcionamento para o respectivo Controller.

---

## 📱 Interface Responsiva e Mobile (App-Like)

O front-end conta com adaptações específicas para dispositivos móveis:
- **Offcanvas Sidebar:** No mobile (`d-md-none`), a barra lateral se converte em gaveta deslizante ativada pelo menu hambúrguer.
- **Bottom Navigation Bar:** Barra inferior fixa inspirada em aplicativos de smartphones para navegação rápida entre os módulos principais.
- **Tabelas Touch-Friendly:** Tabelas com scroll horizontal suave (`table-responsive`) para evitar quebra de layout em telas pequenas.
- **Campos e Botões Otimizados:** Alvos de toque com área mínima de 44px e quebra flexível de colunas em formulários.

---

## 🗄️ Estrutura de Banco de Dados (SQLite)

Optou-se por **SQLite** por não exigir servidor dedicado, facilitando a distribuição e deploy em plataformas como Render e hospedagens compartilhadas. A conexão é garantida pela classe PDO instanciada na função `getDB()` do `config.php`.

**Tabelas Principais:**
- `usuarios`: Autenticação e isolamento multi-tenant (dados atrelados ao usuário).
- `clientes`: Informações de clientes (vinculados ao usuário).
- `processos`: Dados dos processos judiciais (vinculados aos clientes e usuários).
- `prazos`: Prazos, datas de audiências e tarefas (vinculadas aos processos ou clientes).
- `financeiro`: Registro de receitas, honorários e despesas (fluxo de caixa do advogado).
- `documentos`: Links ou caminhos de arquivos anexados (petições, CNH, procurações, etc).

> **Aviso Multi-Tenant:** Todas as queries em Models **devem obrigatoriamente** incluir o `user_id` na cláusula `WHERE` para garantir que um advogado não acesse dados de outro.

---

## 🔐 Autenticação e Segurança

- **2FA (Two-Factor Authentication):** O sistema utiliza o envio de código (OTP - One Time Password) para o e-mail do usuário assim que ele digita a senha correta. Somente com a inserção desse código a sessão é dada como válida.
- **SMTP PHPMailer:** Para enviar os e-mails, o sistema faz uso do PHPMailer.
- **Roteamento Protegido:** O arquivo `index.php` atua como barreira: se `isLoggedIn()` retornar false e a rota não for pública, força o redirecionamento.

---

## 🧭 Roteamento

Toda requisição passa pelo `index.php`. O PHP `parse_url` lê o caminho, e um switch/case roteia para o controlador correspondente. 

**Como criar uma nova rota:**
1. No arquivo `index.php`, adicione um novo `case` ao `switch`.
2. Inclua o respectivo arquivo em `app/controllers`.
3. Instancie a classe e chame o método (Ex: `(new NovoRecursoController())->index();`).

---

## 🚀 Guia de Contribuição e Expansão

1. **Migração de Banco de Dados:** Para adotar MySQL ou PostgreSQL no futuro, basta alterar a string DSN na função `getDB()` no arquivo `config.php`.
2. **Centralização de Assets:** Centralize o CSS e JS customizados na pasta `/public` quando necessário.
3. **Hospedagem em Nuvem:** O sistema está preparado para deploy no Render (via verificação de variáveis de ambiente no `config.php`).