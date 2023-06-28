<p align="center"><img src="https://raw.githubusercontent.com/danisec/ereport-erenos/b1dfa7b84a460863b9de7dc814816f15dc69014b/public/images/logo/logo.svg" width="200"></p>

## About E-Report Erenos

Erenos E-Report is a web application built using the Laravel 9 framework. This application provides features for managing student data, teachers, subjects, attendance, grades, and final student report results.

## Installation

To install and set up E-Report Laravel 9, follow the steps below:

### Prerequisites

-   PHP 8.0 or higher
-   Node.js 16.xx or higher
-   NPM or YARN
-   Composer
-   MySQL
-   Web server (e.g., Apache or Nginx)

### Step 1: Clone the repository

Clone the E-Report Erenos repository from GitHub by running the following command:

```
https://github.com/danisec/ereport-erenos.git
```

### Step 2: Install dependencies

Navigate to the project directory and install the required dependencies:

Using Composer

```
composer install
```

Using NPM or YARN

```
npm install
```

```
yarn install
```

### Step 3: Configure the environment

Rename the `.env.example` file to `.env` and update the necessary configuration settings such as the database connection details.

```
cp .env.example .env
```

### Step 4: Generate application key

Generate a new application key using the following command:

```
php artisan key:generate
```

### Step 5: Run database migrations

Run the database migrations to create the required tables:

```
php artisan migrate --path="database/migrations/*"
```

### Step 6: Start the development server

You can start the development server using the following command:

```
php artisan serve
```

```
npm run dev
```

or

```
yarn dev
```

The application should now be running on http://localhost:8000 or http://127.0.0.1:8000. You can access this URL in your web browser to start using E-Report Erenos.

## Bugs and Issues

Have a bug or an issue with this E-Report Erenos? [Open a new issue](https://github.com/danisec/ereport-erenos/issues/new) here on Github.
