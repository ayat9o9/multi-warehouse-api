
# 📦 Multi-Warehouse Inventory Management API

A Laravel 12 RESTful API backend for managing products, warehouses, suppliers, and inventory across multiple locations. Includes authentication, low-stock reporting, product transfers, and a clean architecture using Repository and Service layers.

---

## 🚀 Features

- JWT Authentication (Login, Register, Logout, Me)
- Role-ready structure (RBAC optional)
- Product, Supplier, Country, Warehouse CRUD
- Inventory CRUD with transfer between warehouses
- Global Inventory View
- Inventory Transactions (IN/OUT)
- Low-Stock Report (API + Daily Email)
- Clean Architecture: Service + Repository Pattern
- Swagger API Documentation
- Fully testable: Unit Tests + `.env.testing`

---

## 🛠 Tech Stack
- Laravel 12
- MySQL
- PHPUnit
- JWTAuth (Tymon)
- Swagger UI (via annotations or YAML)

---

## 📁 Installation

```bash
git clone https://github.com/your-username/multi-warehouse-api.git
cd multi-warehouse-api
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` to match your DB:
```env
DB_DATABASE=multi_warehouse_api
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

Then:
```bash
php artisan migrate --seed
php artisan jwt:secret
php artisan serve
```

---

## 🔐 Authentication (JWT)

| Endpoint      | Method | Description      |
|---------------|--------|------------------|
| /api/register | POST   | User Registration|
| /api/login    | POST   | User Login       |
| /api/me       | GET    | Get current user |
| /api/logout   | POST   | Logout JWT Token |

Use the returned token in Authorization headers:
```
Authorization: Bearer {token}
```

---

## 📦 Inventory Endpoints

| Endpoint                                  | Method | Description                          |
|-------------------------------------------|--------|--------------------------------------|
| /api/inventory                            | GET    | List all inventory                   |
| /api/inventory                            | POST   | Create inventory                     |
| /api/inventory/{id}                       | GET    | Show inventory                       |
| /api/inventory/{id}                       | PUT    | Update inventory                     |
| /api/inventory/{id}                       | DELETE | Delete inventory                     |
| /api/inventory/transfer                   | POST   | Transfer between warehouses          |
| /api/inventory/global-view                | GET    | Global inventory summary             |

---

## 📊 Reporting

### Low Stock
- **GET** `/api/reports/low-stock` — Return products below minimum stock

### Transaction Report
- **GET** `/api/transactions/report?from=2024-01-01&to=2024-02-01` — Filters by date/product/warehouse/type

---

## 📨 Daily Low Stock Email

Runs via command:
```bash
php artisan report:low-stock
```

```php
$schedule->command('report:low-stock')->dailyAt('08:00');
```

Set your email config in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@gmail.com
MAIL_FROM_NAME="Warehouse System"
```

---

## 🧪 Testing

```bash
cp .env .env.testing
php artisan key:generate --env=testing
php artisan migrate:fresh --env=testing
php artisan test
```

To run a specific test:
```bash
php artisan test --filter=CountryServiceTest
```

Tested modules:
- AuthService
- CountryService
- WarehouseService
- InventoryService

---

## 🧾 Swagger API Docs

Open `/api/documentation` after running:
```bash
php artisan l5-swagger:generate
```
