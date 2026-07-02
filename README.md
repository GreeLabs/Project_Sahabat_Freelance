<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  <br>
  <h1>🚀 RemakeFreelance Platform</h1>
  <p>
    <strong>A Modern, Scalable Freelance Marketplace Built with Laravel 11</strong>
  </p>
  <p>
    <a href="#key-features">Features</a> •
    <a href="#tech-stack">Tech Stack</a> •
    <a href="#architecture">Architecture</a> •
    <a href="#getting-started">Getting Started</a> •
    <a href="#testing">Testing</a>
  </p>
  <p>
    <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
    <img src="https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
  </p>
</div>

---

## 📖 About The Project

**RemakeFreelance** is a robust, full-featured freelance marketplace designed to connect clients (Mitra) with skilled professionals (Users). Built on top of **Laravel 11**, it emphasizes clean architecture, real-time interactivity, and scalable design patterns. 

Whether it's processing background jobs, managing role-based access control, or delivering real-time notifications via WebSockets, this platform is engineered to demonstrate enterprise-grade development practices.

---

## ✨ Key Features

- **🔐 Multi-Role Architecture (RBAC)**: Distinct dashboards and permissions for **Admin**, **Mitra** (Clients/Freelancers), and **User**. Protected by custom middleware.
- **⚡ Real-Time Notifications**: Instant updates using Pusher and Laravel Echo for seamless user communication.
- **🛠️ Background Processing**: Asynchronous queue workers handling heavy tasks for optimal performance.
- **🌐 Google OAuth Integration**: Frictionless one-click authentication out of the box.
- **🎨 Modern UI/UX**: Responsive, accessible frontend styled with **Tailwind CSS** and bundled via **Vite**.
- **📊 Comprehensive Data Models**: Structured relational database handling Users, Jobs (Pekerjaan), Applications (Lamaran), Services, Messages, and Ratings.

---

## 🛠️ Tech Stack

### Core
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** SQLite (Configured for immediate out-of-the-box development, easily switchable to MySQL/PostgreSQL)

### Frontend
- **Styling:** Tailwind CSS
- **Build Tool:** Vite
- **Templating:** Blade

### Services & Tooling
- **Real-Time:** Pusher / Laravel Echo
- **Testing:** PHPUnit
- **Code Formatting:** Laravel Pint

---

## 🏗️ Architecture & Design Patterns

This project adheres to modern Laravel best practices:
- **Middleware & Route Grouping** for secure role-based access.
- **Database Session & Cache** drivers for horizontal scalability readiness.
- **Event-Driven Architecture** for decoupling notifications and background tasks.

---

## 🚀 Getting Started

Follow these instructions to get a local copy up and running in minutes.

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/RemakeFreelance.git
   cd RemakeFreelance
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   By default, the project uses SQLite for zero-config setup.
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

6. **Start the Development Servers**
   To run the PHP server, Vite, logs viewer, and Queue workers simultaneously via the custom dev script:
   ```bash
   composer run dev
   ```
   *(Alternatively, run `php artisan serve`, `npm run dev`, and `php artisan queue:listen` in separate terminals).*

---

## 🧪 Testing & Code Quality

The project maintains high code quality standards and includes a comprehensive test suite.

- **Run Unit & Feature Tests:**
  ```bash
  php artisan test
  # or
  phpunit
  ```

- **Run Code Linter / Formatter:**
  ```bash
  ./vendor/bin/pint
  ```

---

## 📞 Contact

**My Name** - [sahrulcc07@gmail.com](mailto:sahrulcc07@gmail.com)

Project Link: [https://github.com/GreeLabs/Project_Sahabat_Freelance](https://github.com/GreeLabs/Project_Sahabat_Freelance)

---
<div align="center">
  <i>If you found this project interesting, please consider giving it a ⭐!</i>
</div>
