# README - Projeto Laravel Completo

## Requisitos

- PHP >= 8.0
- Composer
- MySQL (ou outro banco compatível)
- Node.js e npm (para frontend, se usar)
- Git

---

## Passo 1: Clonar o projeto

```bash
git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto
```

## Passo 2: Instalar dependências

```bash
composer install
```

## Passo 3: Popular o banco

```bash
php artisan migrate --seed
```

## Passo 4: Instalar dependências front-end

```bash
npm install
```

## Passo 5: Rodar o projeto

```bash
php artisan serve
```

## Passo 6: Acessar a rota http://localhost:8000/produtos/