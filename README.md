# Leads API - Laravel Project

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Laravel 11.x

## Installation Steps

### 1. Clone the Repository
```bash
git clone <repository-url>
cd leads-api
```

### 2. Install Dependencies
```bash
composer install

```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file and set your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leads_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders
```bash
# Run migrations
php artisan migrate

# Seed the database with initial data
php artisan db:seed
```

### 6. Build Frontend Assets
```bash
npm run build
# or for development with hot reload
npm run dev
```

### 7. Start the Application


```bash
php artisan serve
```
The application will be available at `http://localhost:8000`

## Default Credentials

After seeding, you can login with:

**Admin User:**
- Email: `admin@leads.app`
- Password: `password123`

**Regular User:**
- Email: `user@leads.app`
- Password: `password123`

## API Documentation

### Authentication
- Login: `POST /api/login`
- Register: `POST /api/register`
- Logout: `POST /api/logout` (requires auth)

### Leads Endpoints
- List leads: `GET /api/leads`
- Create lead: `POST /api/leads`
- Show lead: `GET /api/leads/{id}`
- Update lead: `PUT /api/leads/{id}`
- Delete lead: `DELETE /api/leads/{id}`
- Update status: `PUT /api/leads/{id}/status`
- Update info: `PUT /api/leads/{id}/info`

### Users Endpoints (Admin Only)
- List users: `GET /api/users`
- Create user: `POST /api/users`
- Show user: `GET /api/users/{id}`
- Update user: `PUT /api/users/{id}`
- Delete user: `DELETE /api/users/{id}`

### List of Values (LOV)
- Provinces: `GET /api/lov/provinces`
- Cities: `GET /api/lov/cities/{province_code}`
- Districts: `GET /api/lov/districts/{city_code}`
- Villages: `GET /api/lov/villages/{district_code}`
- Products: `GET /api/lov/products`



## Troubleshooting

### Database Connection Issues
- Ensure MySQL is running
- Verify credentials in `.env`
- Check MySQL port (default: 3306)

### Permission Issues
- Clear config cache: `php artisan config:clear`
- Clear app cache: `php artisan cache:clear`
- Clear routes cache: `php artisan route:clear`

