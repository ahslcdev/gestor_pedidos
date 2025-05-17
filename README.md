# README - Projeto Laravel Completo

## Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Git

---

## Passo 1: Clonar o projeto

```bash
git clone https://github.com/ahslcdev/gestor_pedidos
cd gestor_pedidos
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