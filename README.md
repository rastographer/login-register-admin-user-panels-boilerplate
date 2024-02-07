# login-register-admin-user-panels-boilerplate
 PHP framework with user panel, admin panel and authentication done with core PHP 8.3
 
# PHP User Management Boilerplate

This repository contains a boilerplate for a user management system built with pure core PHP. It includes features such as user registration, login authentication, user panels, and an admin panel. This boilerplate serves as a foundation for building web applications that require user management functionality.

## Features

- User Registration: Allow users to create new accounts by providing basic information.
- User Login: Authenticate users with their credentials to access protected areas of the application.
- User Panels: Provide users with personalized dashboards or panels to manage their profiles and settings.
- Admin Panel: Enable administrators to manage user accounts, view user data, and perform administrative tasks.
- Core PHP: Built using core PHP without relying on any frameworks, making it lightweight and flexible.

## Getting Started

1. Clone the repository to your local machine:

```
git clone https://github.com/rastographer/login-register-admin-user-panels-boilerplate.git

```

## Configure the database settings in admin/db.php:

```
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'your_database_name');
```
Import the database schema from database.sql to set up the required tables.

## Start the PHP server:

```php -S localhost:8000```

Access the application in your browser at http://localhost:8000.

## Usage

Register as a new user to create an account.
- Log in with your credentials to access your user panel. Demo user: [user@example.com / 12345678]
- Admins can log in to the admin panel using the url: yourdomain.com/admin. Demo admin: [admin@example.com / 12345678]
- Manage user accounts, view user data, and perform administrative tasks from the admin panel.

## Contributing
Contributions are welcome! Feel free to open issues or submit pull requests to improve this boilerplate and add new features.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments
Special thanks to open-source projects that inspired this boilerplate.
