# Laravel Simple E-Commerce API

A RESTful API for basic e-commerce operations built with Laravel 10+ and Sanctum authentication.

## ✅ Implemented Features

### Authentication

-   User registration (`POST /api/register`)
-   User login with Sanctum tokens (`POST /api/login`)
-   Protected logout endpoint (`POST /api/logout`)

### Products

-   List all products (`GET /api/products`)
-   View single product details (`GET /api/products/{id}`)

### Orders

-   Create new orders (`POST /api/orders`)
-   View order history (`GET /api/orders`)

## 🚀 Quick Setup

```bash
# 1. Clone and enter project
git clone https://github.com/yourusername/laravel-ecommerce-api.git
cd laravel-ecommerce-api

# 2. Install dependencies
composer install

# 3. Configure environment
cp .env.example .env
php artisan key:generate

# 4. Setup database (edit .env first)
php artisan migrate --seed

# 5. Start server
php artisan serve
```
