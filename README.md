<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://opensource.org/licenses/MIT">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# 🧱 Laravel Base Project

A **clean, scalable, and ready-to-use Laravel 12 base project** designed to help you kickstart new web applications with best practices and pre-configured essentials.

This base includes the most popular and production-tested packages used in professional Laravel projects.

---

## 🚀 Features

- Laravel **12.x** (PHP ^8.2)
- Authentication with **Sanctum**
- Roles & Permissions using **Spatie**
- Multi-language support via **Astrotomic Translatable**
- Slug management via **Cviebrock Eloquent Sluggable**
- Datatables ready via **Yajra**
- Breadcrumbs system with **Diglactic Breadcrumbs**
- Image processing using **Intervention Image**
- Google API integration via **Google Auth**
- Developer-friendly tools like Pint, Sail, Pail, and Collision

---

## 📦 Composer Dependencies

### Required
| Package | Description |
|----------|-------------|
| `laravel/framework` | Laravel core framework |
| `laravel/sanctum` | API authentication |
| `spatie/laravel-permission` | Role & Permission system |
| `astrotomic/laravel-translatable` | Multilingual support |
| `cviebrock/eloquent-sluggable` | Auto slug generator |
| `diglactic/laravel-breadcrumbs` | Breadcrumbs for navigation |
| `yajra/laravel-datatables-oracle` | Datatables integration |
| `intervention/image` | Image manipulation |
| `google/auth` | Google API support |

### Dev Dependencies
| Package | Purpose |
|----------|----------|
| `laravel/pint` | Code style fixer |
| `laravel/sail` | Local dev environment |
| `laravel/pail` | Real-time logging |
| `nunomaduro/collision` | Error reporting |
| `phpunit/phpunit` | Unit testing |
| `fakerphp/faker` | Dummy data |
| `mockery/mockery` | Mocking for tests |

---

## 🧩 Project Setup

### 1️⃣ Clone the repository
```bash
git clone https://github.com/ahmed-abdulraziq/base.git
cd laravel-base
```

### 2️⃣ Install dependencies
```bash
composer install
npm install && npm run dev
```

### 3️⃣ Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Run migrations
```bash
php artisan migrate --seed
```

### 5️⃣ Start the app
```bash
php artisan serve
```

---

## 🧰 Developer Commands

| Command | Description |
|----------|-------------|
| `composer dev` | Runs all dev services (server, queue, logs, Vite) concurrently |
| `composer test` | Runs all Laravel tests |
| `php artisan pail` | Real-time log stream |
| `php artisan queue:listen` | Queue listener |

---

## 🗂️ Recommended Folder Structure

```
app/
 ├── Http/
 │    ├── Controllers/
 │    │    ├── Api/
 │    │    └── Dashboard/
 │    ├── Middleware/
 │    └── Requests/
 ├── Models/
 ├── Traits/
 └── Services/

config/
database/
resources/
routes/
 ├── api.php
 └── web.php
```

---

## 🧭 Trello Workflow

If you’re managing the project with Trello, here’s the suggested **Kanban structure**:

- 📁 **Files & Links** – Docs, repo, setup notes  
- 📝 **To-Do** – Planned tasks  
- ⚡ **Do Today** – Tasks for the current day  
- 🛠️ **In Progress** – Active work  
- 🔍 **Review** – Pending testing or approval  
- ✅ **Done** – Completed features

---

## 👤 Author

**Ahmed Abdulraziq**  
Backend Laravel Developer  
[GitHub Profile](https://github.com/ahmed-abdulraziq)

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

> 🧠 Tip: Use this base as a template for new Laravel projects. It includes most of the setup you’ll need for APIs, dashboards, and multilingual apps.
