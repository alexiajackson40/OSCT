# Team5
For Senior Design Project

**Project Setup Instructions**
Prerequisites

Ensure you have the following installed on your system: Homebrew (https://brew.sh/) for macOS users and Git (https://git-scm.com/).

Step 1: Install MySQL

To install MySQL, open the terminal and run the command _brew install mysql_. After the installation, start the MySQL service using brew services start mysql. Secure your MySQL installation by running the command _mysql_secure_installation_ and following the prompts. Finally, verify the installation by typing _mysql --version_.

You can also go to the MySQL website and download the MySQL Community Server (https://dev.mysql.com/downloads/mysql/).

Step 2: Install MySQL Workbench

Download MySQL Workbench from the MySQL Downloads page at https://dev.mysql.com/downloads/workbench/. Follow the installation instructions provided by the installer. After installation, open MySQL Workbench and create a connection with the following details: Hostname: 127.0.0.1, Port: 3306, Username: root, and Password: (set during MySQL installation).

Step 3: Install PHP

To install PHP, use Homebrew by running the command _brew install php_. Once installed, start the PHP service with _brew services start php_. Verify the installation by typing _php --version_ in the terminal.

Step 4: Install Laravel

First, ensure you have Composer, the dependency manager for PHP, installed. Install Composer by running _brew install composer_ and verify the installation with _composer --version_. To create a new Laravel project, use the command composer _create-project --prefer-dist laravel/laravel project-name_, replacing project-name with the desired name of your project. Navigate to the project directory using _cd project-name_ and start the Laravel development server by typing _php artisan serve_. The application will be accessible in your browser at the localhost which is http://127.0.0.1:8000.

Step 5: Run Migrations

Ensure your .env file is properly configured with your database credentials. Then, run the command _php artisan migrate_ to set up your database schema.
