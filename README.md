#  GadgetsTech – Laravel E-Commerce Platform

A modern **mini e-commerce web application** built with **Laravel** and **MySQL**, designed to sell custom **tech gadgets**.  
The platform supports full product management, shopping cart functionality, secure checkout, and an AJAX-powered live search for an interactive user experience.

---

##  Overview

**GadgetsTech** is a Laravel-based CRUD web application that simulates a small online store.  
It was developed to practice **MVC design**, **database management**, and **frontend-backend integration** using **Blade, Bootstrap**, and **AJAX**.

Visitors can browse gadgets, registered users can place orders, and admins can manage products and monitor all incoming orders.

---

##  Core Features

###  Product Management (CRUD)
- Add, edit, delete, and view products with fields:
  - `name`, `category`, `description`, `price`, `stock`, and `image`.
- Image upload and display handled with Laravel’s storage system.
- Only authenticated admins can access product management routes.

###  Authentication System
- Implemented with **Laravel Breeze / UI**.
- Role-based access for `admin` and `customer`.
- Secure session handling and CSRF protection.

###  Shopping Cart
- Session-based cart system with quantity updates and item removal.
- Cart summary and dynamic total calculation.
- Clear layout using **Bootstrap cards** and modals.

###  Order Placement
- Checkout form collects:
  - Customer name, email, address, payment method.
- Orders saved with relational tables (`orders`, `order_items`, `users`).
- Confirmation email sent upon order placement.

###  Admin Dashboard
- View all orders with customer info and ordered items.
- Order status tracking (e.g., pending, shipped).
- Pagination for large order lists.

###  AJAX Live Search
- Real-time product filtering by **name** or **category**.
- Implemented with `axios` and Laravel JSON endpoints.
- Updates product cards instantly without reloading the page.

---

##  Bonus Enhancements
-  Pagination for both user product list and admin order table.  
-  Stock reduction after checkout.  
-  Form validation using Laravel’s `Request` class.  
-  Image uploads using Laravel Filesystem.  
-  Clean UI with Material Design Bootstrap (MDB).  

---

##  Technologies Used

| Category | Tool / Framework |
|-----------|------------------|
| Backend | Laravel 11 (PHP 8.2) |
| Frontend | Blade, Bootstrap 5, MDB UI Kit |
| Database | MySQL |
| AJAX | Axios / jQuery |
| Auth | Laravel Breeze / UI |
| Mail | Laravel Mailer |
| Deployment | Localhost (XAMPP / Artisan Serve) |
| Version Control | Git + GitHub |

---

##  Database Structure

**Tables:**
- `users` – stores admin and customer accounts  
- `products` – gadget data  
- `orders` – main order info (customer, total, date)  
- `order_items` – details of each product in an order  

All models are connected using **Eloquent ORM** with proper relationships (`hasMany`, `belongsTo`).

---

##  How to Run Locally

```bash
# 1️) Clone the repository
git clone https://github.com/<your-username>/GadgetsTech.git
cd GadgetsTech

# 2️) Install dependencies
composer install
npm install && npm run dev

# 3️) Set up environment
cp .env.example .env
php artisan key:generate

# 4️) Configure database (MySQL)
# Update DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
php artisan migrate --seed

# 5️) Start the app
php artisan serve
