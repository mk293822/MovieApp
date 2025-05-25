# 🎬 MovieApp

A modern **Movie Management Application** built with **Laravel 12** (API backend) and **React + TypeScript** (frontend). This system allows users to browse, search, and manage movies efficiently with a powerful admin panel.

---

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![React](https://img.shields.io/badge/React-TypeScript-61DAFB?logo=react)
![License](https://img.shields.io/badge/License-MIT-blue)
![Status](https://img.shields.io/badge/status-active-success)

---

## 🚀 Features

- 🔐 Secure user authentication with Laravel Breeze and Sanctum  
- 🎥 Full movie CRUD management with detailed movie info  
- 🛠️ Admin panel powered by Filament for easy resource management  
- 🔍 Advanced fuzzy search powered by Fuse.js and Laravel Scout  
- 🌐 Single Page Application experience with Inertia.js and React  
- 🎨 Responsive UI styled with Tailwind CSS  
- 📹 Video processing support using PHP-FFMpeg  
- 🧪 Comprehensive testing with PestPHP and PHPUnit  
- ⚡ Optimized performance with caching and queue processing  
- 🔄 Real-time updates and notifications (planned)  

---

## 🛠️ Tech Stack

### 🔧 Backend

- [Laravel 12](https://laravel.com/docs/12.x)  
- Laravel Sanctum (SPA Authentication)  
- Laravel Breeze (Authentication scaffolding)  
- Filament Admin Panel  
- Laravel Scout with TNTSearch driver (Search)  
- PHP-FFMpeg (Video processing)  
- MySQL or compatible database  
- RESTful API with validation and resource controllers  

### 🎨 Frontend

- [React](https://react.dev/) + [TypeScript](https://www.typescriptlang.org/)  
- [Inertia.js](https://inertiajs.com/) (SPA framework)  
- [Tailwind CSS](https://tailwindcss.com/)  
- Fuse.js (Fuzzy search)  
- Axios (API communication)  
- ESLint & Prettier (Linting and formatting)  
- Vite (Build tool)  

---

## ⚙️ Installation

### 📦 Requirements

- PHP >= 8.2  
- Composer  
- Node.js >= 18  
- MySQL or compatible DB  
- Laravel CLI  

---

### 🔧 Step-by-step Setup

1. **Clone the repository**

```bash
git clone https://github.com/mk293822/MovieApp.git
cd MovieApp
```

2. **Install backend dependencies**

```bash
composer install
```

3. **Copy and setup environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database in `.env`**

```bash
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run database migrations and seeders**

```bash
php artisan migrate --seed
```

6. **Install frontend dependencies**

```bash
npm install
```

7. **Start the development servers**

```bash
npm run dev
php artisan serve
```

---

## 📝 License

This project is licensed under the [MIT License](./LICENSE).
