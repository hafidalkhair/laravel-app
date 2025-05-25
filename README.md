# Photography Booking Web Application

A professional web application for booking photography services, built with Laravel 11.x. The application features separate authentication systems for administrators and users, allowing for efficient management of photography services and bookings.

## Features

### Admin Panel
- Dashboard with statistics and overview
- Service management (CRUD operations)
- Booking management with status updates
- User management
- Booking reports and exports

### User Features
- User registration and authentication
- Service browsing and booking
- Booking management
- Profile management
- Booking history and status tracking

## Requirements

- PHP 8.3+
- MySQL 8.0+
- Composer
- Node.js & NPM
- Laravel 11.x

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd laravel-web
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install and compile frontend dependencies:
```bash
npm install
npm run dev
```

4. Create and configure environment file:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

7. Create storage link:
```bash
php artisan storage:link
```

## Default Admin Account

After running the seeders, you can login to the admin panel with:
- Email: admin@example.com
- Password: password

## Development

### Frontend Assets

The application uses:
- Tailwind CSS for styling
- Alpine.js for interactivity
- Laravel Blade for templating

To compile assets during development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### File Permissions

Ensure proper file permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

## Testing

Run the test suite:
```bash
php artisan test
```

## Security

- CSRF protection enabled
- SQL injection prevention
- XSS protection
- Password hashing
- Rate limiting
- Input validation and sanitization

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
