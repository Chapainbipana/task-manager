# 📝 Laravel Task Management System

A simple and intuitive task management application built with Laravel and Bootstrap. Users can create, edit, assign, and track tasks across various statuses like "To Do", "In Progress", and "Done".

---

## 🚀 Features

- User Authentication (Register/Login/Logout)
- Role-Based Access Control (Admin & User)
- Task CRUD (Create, Read, Update, Delete)
- Task Status Tracking (Drag & Drop using SortableJS)
- Image/File Attachment with Task
- Profile Edit and Secure Logout
- Responsive Design with Bootstrap 5

---

## 🛠 Tech Stack

- Laravel 10+
- PHP 8+
- Bootstrap 5
- MySQL/MariaDB
- JavaScript (SortableJS)
- Blade Templating Engine

---



## 📥 Installation & Setup

Follow the steps below to set up the project locally:

### 1. Clone the repository

```bash
git clone https://github.com/your-username/laravel-task-manager.git
cd laravel-task-manager
'''bash

### 2. Install Dependencies
'''bash
composer install
npm install
'''bash
### 3.Create Environment Filet
'''bash
cp .env.example .env
php artisan key:generate
'''bash

 ### 4. Run Migrations and Seeders
'''bash
php artisan migrate --seed
'''bash
### 5. Serve the Project
'''bash
php artisan serve
'''bash

### 6. (Optional) Compile Assets
'''bash
npm run dev
 
'''bash

