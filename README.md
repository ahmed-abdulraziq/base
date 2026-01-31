<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

---

# Laravel Base Project

A **clean, scalable, and ready-to-use Laravel 12 base project** designed to kickstart new web applications with best practices and pre-configured essentials.

This base includes popular, production-tested packages and a structured codebase for APIs, dashboards, and multilingual apps.

---

## Features

- **Laravel 12.x** (PHP ^8.2)
- **Authentication**: Sanctum (API) + session (Dashboard)
- **Roles & Permissions**: Spatie Laravel Permission
- **Activity Log**: Spatie Activity Log
- **Multi-language**: Astrotomic Translatable (see [docs/LOCALIZATION.md](docs/LOCALIZATION.md))
- **Slug management**: Cviebrock Eloquent Sluggable
- **Datatables**: Yajra Laravel Datatables
- **Breadcrumbs**: Diglactic Breadcrumbs
- **Image processing**: Intervention Image
- **Google API**: Google Auth
- **Social login**: Laravel Socialite
- **Debug & monitoring**: Laravel Telescope
- **Developer tools**: Pint, Sail, Pail, Collision

---

## Composer Dependencies

### Required

| Package | Description |
|---------|-------------|
| `laravel/framework` | Laravel core |
| `laravel/sanctum` | API authentication |
| `laravel/socialite` | OAuth / social login |
| `laravel/telescope` | Debug & monitoring |
| `spatie/laravel-permission` | Roles & permissions |
| `spatie/laravel-activitylog` | Activity logging |
| `astrotomic/laravel-translatable` | Multilingual models |
| `cviebrock/eloquent-sluggable` | Auto slugs |
| `diglactic/laravel-breadcrumbs` | Breadcrumbs |
| `yajra/laravel-datatables-oracle` | Datatables |
| `intervention/image` | Image manipulation |
| `google/auth` | Google API |

### Dev

| Package | Purpose |
|---------|---------|
| `laravel/pint` | Code style |
| `laravel/sail` | Docker dev environment |
| `laravel/pail` | Real-time logs |
| `nunomaduro/collision` | Error reporting |
| `phpunit/phpunit` | Testing |
| `fakerphp/faker` | Fake data |
| `mockery/mockery` | Mocking |

---

## Project Setup

### 1. Clone

```bash
git clone https://github.com/ahmed-abdulraziq/base.git
cd base
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database

```bash
php artisan migrate --seed
```

### 5. Run

```bash
php artisan serve
```

---

## Developer Commands

| Command | Description |
|--------|-------------|
| `composer dev` | Server + queue + pail + Vite together |
| `composer test` | Run tests |
| `php artisan pail` | Real-time log stream |
| `php artisan queue:listen` | Queue worker |
| `php artisan telescope:install` | Publish Telescope assets (if needed) |

---

## Project Structure

```
app/
├── Console/Commands/
├── Exceptions/
├── Helpers/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   └── Dashboard/
│   ├── Middleware/
│   ├── Requests/
│   │   ├── Api/
│   │   └── Dashboard/
│   └── Resources/
├── Jobs/
├── Models/
├── Notifications/
├── Observers/
├── Providers/
├── Services/
│   ├── Api/
│   └── Dashboard/
└── Traits/

config/
database/
docs/           # e.g. LOCALIZATION.md
resources/
routes/
├── api.php
├── web.php
├── dashboard.php
├── Breadcrumbs.php
└── console.php
```

---

## Included Functionality

- **Dashboard**: Auth, users, roles, permissions, settings
- **API**: Auth (login, register, profile), base controllers, JSON responses
- **Attachments**: Model, observer, service, `HasAttachments` trait
- **Notifications**: Base notification, jobs, password reset, user registered
- **Localization**: RTL/LTR, session/cookie, docs in `docs/LOCALIZATION.md`

---

## Trello Workflow (optional)

Suggested Kanban columns:

- **Files & Links** – Docs, repo, setup
- **To-Do** – Backlog
- **Do Today** – Daily focus
- **In Progress** – Active work
- **Review** – Testing / QA
- **Done** – Completed

---

## Author

**Ahmed Abdulraziq**  
Backend Laravel Developer  
[GitHub](https://github.com/ahmed-abdulraziq)

---

## License

MIT — see [LICENSE](https://opensource.org/licenses/MIT).

---

> Use this base as a template for new Laravel projects. It covers APIs, dashboards, permissions, and multilingual apps out of the box.
