# Laravel HRM System - Human Resource Management

A comprehensive Human Resource Management System built with Laravel MVC, featuring employee management, department/skill tracking, and dynamic AJAX functionality.

## Features

###  Core Functionality
- **User Authentication** - Secure login/registration using Laravel Auth
- **Employee Management** - Full CRUD operations for employees
- **Department Management** - Create and list departments
- **Skill Management** - Create and list skills
- **Eloquent Relationships** - Proper database relationships

### Advanced Features
- **Dynamic Skill Selection** - Add/remove skills dynamically using jQuery
- **AJAX Filtering** - Filter employees by department without page reload
- **Real-time Validation** - Email uniqueness check via AJAX
- **Active Navigation** - Highlight active menu items
- **Employee Counts** - Show counts in departments/skills pages

### Technical Features
- Laravel MVC Architecture
- Blade Templating Engine
- Bootstrap 5 UI with Icons
- jQuery for dynamic interactions
- Server-side validation
- Database relationships (One-to-Many, Many-to-Many)

## 🚀 Installation Guide

### Step 1: Prerequisites
Ensure you have installed:
- PHP 8.0 or higher
- Composer
- Node.js & NPM
- MySQL Database

### Step 2: Clone/Download Project
git clone <your-repository-url>
cd hrm-system

### Step 3: Install Dependencies
composer install
npm install

### Step 4: Environment Setup
cp .env.example .env
php artisan key:generate

### Step 5: Configure Database
Edit .env file:
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hrm_system
DB_USERNAME=root
DB_PASSWORD=your_password


### Step 6: Database Migration & Seeding
php artisan migrate --seed

### Step 7: Compile Assets
npm run dev
# or for production:
# npm run build

### Step 8: Run Development Server
php artisan serve
Visit: http://localhost:8000

### You can use this Default Login Credentials
Email: admin@hrm.com
Password: password

