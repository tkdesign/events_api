# Conference Website - API

This repository contains the **backend API** for the offline conference website platform.  
The project is built with **Laravel 10** and provides CRUD-based endpoints for managing all entities of an offline conference website.

The related frontend application can be found here:  
[events_front](https://github.com/tkdesign/events_front)

---

## Overview

The API powers a universal platform for managing offline conferences.  
It supports CRUD operations for all main entities of a conference website:

- General information
- Promotional banners for upcoming events
- Participant reviews
- Photo galleries
- Sponsors' logos and information
- Curators' photos and bios
- Map and contact details
- Speaker profiles
- Conference schedule (locations → days → time slots → lectures)
- Informational articles

The system supports **three user roles**:
- **Guest:** can view information and schedule, but cannot register for lectures.
- **Participant:** can register, log in, and book lectures.
- **Administrator:** full CMS-like access (users, sponsors, curators, speakers, schedules, articles, banners, reviews, galleries, etc.).

---

## Technical Stack

- **Language:** PHP 8.1+
- **Framework:** Laravel 10
- **Database:** MariaDB 10.10+ / MySQL 8
- **Package Manager:** Composer 2.2+
- **Authentication:** Laravel Fortify (login & password via API)
- **ORM:** Eloquent
- **Migrations:** for database schema changes
- **Seeders & Factories:** for test data generation
- **Format:** JSON

---

## API Style

This API implements **CRUD operations** to manage site entities.  
The routing structure is based on **actions** (`get`, `create`, `update`, `delete`), which ensures simplicity of integration and support.

> The API does not fully follow the REST style, but it is easily extensible and adaptable to project needs.

---

## Documentation and Database Schema

In the `docs/` folder you can find:
- ER diagram of the database (Workbench format)
- PDF and PNG exports of the ER diagram
- SQL schema

---

## Environment Configuration

1. Copy the example environment file to `.env`:

```bash
cp .env.example .env
```

2. Edit `.env` to match your environment, including domains and database connection.

Essential variables:

```env
APP_URL=https://api.example.com
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=conference_api
DB_USERNAME=your_username
DB_PASSWORD=your_password

CORS_ALLOWED_ORIGINS=https://frontend.example.com
SANCTUM_STATEFUL_DOMAINS=frontend.example.com
SESSION_DOMAIN=.example.com
```

---

## Installation & Setup

1. Clone the repository:

```bash
git clone https://github.com/tkdesign/events_api.git
cd events_api
```

2. Install dependencies:

```bash
composer install
```

3. Create a database in MySQL/MariaDB and update `.env` accordingly.

4. Run migrations and seeders:

```bash
php artisan migrate --seed
```

5. Clear and cache configuration:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

6. Start the development server.

---

## Deployment Notes

- The **public** folder must be the web root (for Apache/Nginx).
- For local development (e.g., XAMPP), you can run the frontend on one port and the API on another.

---

## Related Repository

- **Frontend SPA (Vue 3):** [events_front](https://github.com/tkdesign/events_front)

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

Authors: Petr Kovalenko, Andrei Parfirev
