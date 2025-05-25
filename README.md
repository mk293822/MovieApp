<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo" />
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://reactjs.org" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg" width="150" alt="React Logo" />
  </a>
</p>

# MovieApp

## Description
MovieApp is a modern web application built with a Laravel backend and a React frontend using TypeScript and Vite. It leverages the power of Laravel for backend API and business logic, and React with Inertia.js for a seamless single-page application experience. The project also integrates Filament for an admin panel, Tailwind CSS for styling, and various other tools to provide a robust and scalable movie management platform.

## Technologies Used
- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** React 18, TypeScript, Vite
- **Styling:** Tailwind CSS
- **Admin Panel:** Filament
- **SPA Framework:** Inertia.js
- **Search:** Laravel Scout with TNTSearch driver
- **Authentication:** Laravel Breeze, Sanctum
- **Video Processing:** PHP-FFMpeg
- **Testing:** PestPHP, PHPUnit
- **Linting & Formatting:** ESLint, Prettier

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or other supported database

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/mk293822/MovieApp.git
   cd MovieApp
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the example environment file and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

## Running the Application

### Development Server
To start the Laravel backend server and Vite development server concurrently, run:
```bash
npm run dev
```
This will start the backend at `http://localhost:8000` and the frontend Vite server.

### Accessing the Application
- Frontend SPA will be accessible via the backend URL.
- Filament admin panel is available for managing movies and users.

## Testing
Run the test suite using:
```bash
php artisan test
```
or
```bash
npm run test
```

## Folder Structure Overview
- `app/` - Laravel backend application code (Controllers, Models, Services, Enums)
- `database/` - Migrations, seeders, and factories
- `resources/js/` - React frontend source code with components, pages, and layouts
- `routes/` - Laravel route definitions
- `public/` - Public assets and entry point
- `tests/` - Backend and frontend tests

## Contributing
Contributions are welcome! Please fork the repository and submit pull requests. Make sure to follow coding standards and include tests for new features.

## License
This project is open-sourced software licensed under the MIT license.
