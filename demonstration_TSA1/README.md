# Cornerstone POS

A four-page Point-of-Sale foundation project built with CodeIgniter 4. It demonstrates routing, controllers, views, shared navigation, and temporary data handling through static PHP arrays.

## Pages

- `/` - landing page
- `/about` - project overview
- `/customers` - five customer account records
- `/users` - five user/staff account records

## Local setup with XAMPP

1. Place the project at `C:\xampp\htdocs\IT0049_PROJECTS\demonstration_TSA1`.
2. Enable the PHP `intl` and `mbstring` extensions in `C:\xampp\php\php.ini`.
3. Start Apache from the XAMPP Control Panel.
4. Open `http://localhost/IT0049_PROJECTS/demonstration_TSA1/`.

No database is required for this activity. Customer and user records are currently stored as static arrays inside their controllers.

## Project structure

- `app/Config/Routes.php` registers all four routes.
- `app/Controllers/Pages.php` handles the landing and about pages.
- `app/Controllers/Customers.php` supplies temporary customer data.
- `app/Controllers/Users.php` supplies temporary user data.
- `app/Views/` contains the shared layout and four page views.

## Verification

Run these commands from the project directory:

```powershell
C:\xampp\php\php.exe spark routes
C:\xampp\php\php.exe spark serve
```

When using `spark serve`, update `app.baseURL` in `.env` to `http://localhost:8080/` for that session.

## Deploying to Render

This repository includes a Docker deployment for Render. Create a Docker Web Service from the repository, use `demonstration_TSA1` as the Root Directory, and deploy the `master` branch. Apache serves the CodeIgniter `public` directory on port 10000.