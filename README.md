# Sistema de Gerenciamento de Contatos

Sistema CRUD para gerenciamento de contatos desenvolvido em Laravel.

## 🚀 Funcionalidades

### Acesso Público
- **Lista de Contatos**: Qualquer pessoa pode visualizar a lista de contatos
- **Detalhes do Contato**: Visualização individual de cada contato

### Acesso Autenticado
- **Criar Contato**: Formulário para adicionar novos contatos
- **Editar Contato**: Modificar informações existentes
- **Excluir Contato**: Remoção com soft delete
- **Lixeira**: Visualizar contatos excluídos
- **Restaurar Contato**: Recuperar contatos da lixeira

### Funcionalidades Extras
- **Paginação**: Navegação entre páginas de resultados
- **Pesquisa**: Busca por nome ou email
- **Validação**: Formulários com validação robusta
- **Interface Responsiva**: Design adaptável usando Tailwind CSS

## 🛠️ Tecnologias

- **Laravel 10**: Framework PHP
- **Laravel Breeze**: Sistema de autenticação
- **Tailwind CSS**: Framework CSS
- **Alpine.js**: JavaScript reativo
- **MySQL**: Banco de dados

## 📋 Pré-requisitos

- PHP 8.1+
- Composer
- MySQL
- Node.js (para compilar assets)

## ⚙️ Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/walisonvini/alfasoft-laravel-test.git
cd alfasoft-laravel-test
```

2. **Instale as dependências**
```bash
composer install
npm install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**
```bash
# Edite o arquivo .env com suas credenciais do banco
php artisan migrate
```

5. **Compile os assets**
```bash
npm run dev
```

6. **Execute o seeder (opcional)**
```bash
php artisan db:seed
```

7. **Inicie o servidor**
```bash
php artisan serve
```

## 🔐 Credenciais de Login

Após executar o seeder, você pode fazer login com:
- **Email**: test@example.com
- **Senha**: password

## 🧪 Testes

### Configuração para Testes
Para não modificar seu arquivo `.env` local, você pode usar um arquivo `.env.testing`:

```bash
cp .env .env.testing
```

Edite o `.env.testing` com configurações específicas para testes (banco de dados de teste, etc.).

### Executar Testes
```bash
php artisan test
```

### Testes Implementados
- **Teste de Acesso**: Verifica permissões públicas vs autenticadas
- **Teste de Validação**: Verifica erros de formulário
- **Teste de Funcionalidades**: CRUD completo
