# Subnest – Subscription Manager

Subnest is a web application built with Laravel that helps users manage their subscriptions in one place. Users can keep track of their subscription services, organise them into categories, monitor payments and receive reminders about upcoming renewals.

## Features

- **User authentication:** Register and log in to a personal account.
- **Subscription management:** Create, view, edit and delete subscriptions.
- **Categories:** Organise subscriptions into different categories.
- **Payment history:** Record and manage subscription payments, including payment dates, amounts and statuses.
- **Dashboard:** View active subscriptions, estimated monthly and yearly spending, spending by category and upcoming payments.
- **Reminders:** Create reminders for upcoming subscription payments and manage their read status.
- **Email notifications:** Receive email notifications for due reminders.
- **Subscription logos:** Display service logos alongside subscriptions.

## Technologies Used

- PHP 8.5
- Laravel 13
- SQLite
- Blade
- Tailwind CSS
- Vite
- Mailtrap (email testing)

## Installation

Follow these steps to run Subnest locally.

### 1. Clone the repository

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
cd subnest
```

Replace `YOUR_GITHUB_REPOSITORY_URL` with the URL of your GitHub repository.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Create the environment file

```bash
cp .env.example .env
```

On Windows PowerShell, you can use:

```powershell
Copy-Item .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Configure the database

Subnest uses SQLite.

Create the database file if it does not already exist:

```bash
New-Item database/database.sqlite -ItemType File
```

Make sure your `.env` contains:

```env
DB_CONNECTION=sqlite
```

### 7. Run migrations and seed the database

```bash
php artisan migrate:fresh --seed
```

This creates the database tables and inserts the initial sample data.

### 8. Create the storage link

```bash
php artisan storage:link
```

### 9. Start the application

In one terminal:

```bash
npm run dev
```

In another terminal:

```bash
php artisan serve
```

Open the local address shown by Laravel in your browser.

## Database Structure

Subnest uses the following main models:

| Model | Description |
|---|---|
| User | Stores registered user accounts |
| Subscription | Stores users' subscription information |
| Category | Groups subscriptions into categories |
| Payment | Stores payment records |
| Reminder | Stores subscription reminders |

The models use Eloquent relationships to connect related records. For example, a user can have multiple subscriptions, and a subscription can have multiple payments and reminders.

## Testing Data

The application uses Laravel factories and seeders to generate sample data.

To reset the database and recreate the sample data:

```bash
php artisan migrate:fresh --seed
```

**Important:** This command deletes existing database records before recreating the tables.

If the database seeder creates the required administrator account, the credentials are:

- Email: `admin@admin.com`
- Password: `password`

## Project Purpose

The purpose of Subnest is to make subscription management easier by giving users one place to organise their services, monitor recurring expenses, keep track of payment history and remember upcoming renewal dates.

The project was developed as a Laravel web application to practise backend development concepts such as MVC architecture, database migrations, Eloquent relationships, authentication, validation, CRUD operations, factories and seeders.
