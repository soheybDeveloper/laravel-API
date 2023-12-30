<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Simple API using Laravel

## API Routes Overview

This document provides information about the API routes for the application. These routes are designed to handle various actions related to users and orders.

## Endpoints doc [Postman]

https://documenter.getpostman.com/view/31193805/2s9YsDkEqB

## Prerequisites

- PHP installed
- Composer installed
- Database configured

## Installation

1. Clone the repository: `git clone [https://github.com/soheybDeveloper/laravel-API.git]`
2. Install dependencies: `composer install`
3. Configure the database connection in the `.env` file
4. Run migrations: `php artisan migrate`
## Authenticated Routes

**Base URL:** `/api/v1`

**Authentication:**

- **Login:** `POST /users/login`
- **Logout:** `POST /users/logout` (requires authentication)

**User Routes:**

- **Create User:** `POST /users`

**Order Routes (requires authentication):**

- **Create Order:** `POST /orders`
- **Get All Orders:** `GET /orders`
- **Get Single Order:** `GET /orders/{id}`
- **Update Order:** `PUT /orders/edit/{id}`
- **Delete Order:** `DELETE /orders/delete/{id}`
- **Search Orders:** `POST /orders/search`
