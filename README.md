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

2️⃣ Install Dependencies
composer install
npm install
3️⃣ Create Environment Filet
cp .env.example .env
php artisan key:generate
4️⃣ Configure Database in .env
Open .env and update the following:
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
5️⃣ Run Migrations and Seeders

php artisan migrate --seed
6️⃣ Serve the Project

php artisan serve
Visit: http://localhost:8000

7️⃣ (Optional) Compile Assets

npm run dev
 


