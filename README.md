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

git clone https://github.com/ebucodes/losode_technical_test.git
cd losode_technical_test

### 2. Install Dependencies

composer install

### 3. Configure Environment

cp .env.example .env

### 4. Generate Application Key

php artisan key:generate

### 5. Run Migrations and Seeders

php artisan migrate --seed

## 6. Start the application

php artisan serve
