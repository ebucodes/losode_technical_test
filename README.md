# Losode Backend Developer Assessment

A RESTful API for a Micro Job Board built with Laravel. This API allows businesses to manage job listings and guests to browse, search, and apply for jobs.

---

## Requirements

- PHP >= 8.1
- Composer
- MySQL
- Laravel Sanctum (for authentication)

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/ebucodes/losode_technical_test.git
cd losode_technical_test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
