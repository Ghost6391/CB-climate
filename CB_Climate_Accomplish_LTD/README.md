# CB Climate Accomplish LTD Management System

A PHP + MySQL business management website for:
- Air conditioner sales
- AC installation
- AC repair
- AC maintenance
- CCTV installation and services
- Customer requests and service jobs
- Admin dashboard
- Customer management
- Service/job tracking
- File/document organization
- Database export

## Requirements
- XAMPP (Apache + MySQL)
- PHP 8+
- MySQL/MariaDB

## Installation
1. Copy the `cb_climate` folder to `C:\xampp\htdocs\`
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin: http://localhost/phpmyadmin
4. Create/import the database using `database/cb_climate.sql`
5. Open: http://localhost/cb_climate/

Default admin:
- Email: admin@cbclimate.rw
- Password: admin123

Change the password after first login.

## Database backup
Admin dashboard includes an Export Database button. It downloads a SQL backup.

## Project structure
- public/        Frontend pages
- admin/         Admin dashboard
- api/           PHP backend endpoints
- config/        Database configuration
- database/      SQL schema
- uploads/       Customer/job documents and images
- assets/        CSS and JavaScript
