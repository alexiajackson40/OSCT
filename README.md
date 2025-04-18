# Senior Capstone Project 2025 - Operación Salud Colima Tamizaje

## 📋 Prerequisites  
Before starting the website setup, make sure all required tools and environments are properly installed and configured. Follow the steps below to prepare your system for running the project locally.

### Project Setup Instructions (for Windows)

### **Step 1: Install MySQL**

1. Go to the official MySQL website: (https://dev.mysql.com/downloads/mysql/)

2. Choose the Windows (x86, 64-bit), MSI Installer and follow the installer prompts:
   - Set a root password and remember it.
   - Choose the option to start MySQL automatically on system boot.

3. To verify that MySQL is downloaded, open the **Commant Prompt** or **Powershell** and run:
   ```
   mysql --version
   ```

**NOTE:** If the above command doesn’t work, you may need to add the MySQL bin directory to your system PATH:
   - The bin directory is usually located at:
      ```
      C:\Program Files\MySQL\MySQL Server X.X\bin
      ```
   - To add it to your system PATH:
      1. Search for Environment Variables in the Start menu.
      2. Under System Variables, find and edit the Path variable. 
      3. Click New and paste the MySQL bin directory path.
      4. Click OK to save and close all dialogs.

---

### **Step 2: Set Up SQLTools in VS Code**

1. Open Visual Studio Code.

2. Go to the Extensions view `Ctrl + Shift + X`.

3. Search for and install the following extensions:
   - `SQLTools` by Matheus Teixeira
   - `SQLTools MySQL/MariaDB Driver`

4. Once installed, open the SQLTools tab (cylinder icon on the left sidebar).

5. Click "Add New Connection" and follow these steps:
   - Select MySQL as the driver.
   - Enter the connection details (host, user, password, database name) from your settings.json file.
   - Click Test Connection to verify.
   - If successful, click Save Connection.

6. Your connection will now appear under the Connections section in the SQLTools tab.

7. To connect to the database in the future, click the plug icon next to your saved connection.

---

### **Step 3: Install PHP**

1. Go to the official PHP downloads page: (https://windows.php.net/download/)

2. Download version PHP 8.4, VS17 x64 Non Thread Safe, ZIP file

3. Extract the ZIP file and place it in a convenient location (e.g., `C:\php`).

4. Open the extracted folder and find the php.ini-development file. Rename it to:
   ```
   php.ini
   ```

5. Open the new php.ini file in a text editor (like VS Code or Notepad).

6. Enable the `fileinfo` and the `pdo_sql` extensions
   - Find the lines:
      ```
      ;extension=fileinfo
      ;extension=pdo_mysql
      ```
   - Remove the semicolon `;` so it becomes:
      ```
      extension=fileinfo
      extension=pdo_mysql
      ```
   Save the file.

7. Add the PHP directory to your System PATH:
   - Open the Start Menu and search for Environment Variables.
   - Under System Variables, find and edit the Path variable.
   - Click New and enter:
   ```
   C:\php
   ```
   - Click OK to save and close.

8. Open Command Prompt and run the following command to confirm installation:
   ```
   php --version
   ```
   You should see the installed PHP version in the output.

---

### **Step 4: Install Composer (PHP dependency manager)**

1. Download Composer for Windows from the official website: (https://getcomposer.org/Composer-Setup.exe)

2. Run the installer and follow the prompts. During the installation process:
   - Make sure to select the correct PHP installation (C:\php\php.exe), which should be automatically detected.
   - Continue with the default options and complete the installation.

3. Once installed, verify Composer by opening **Command Prompt** and running:
   ```
   composer --version
   ```
   This should display the installed version of Composer.
---

## 🚀 Starting the Website
Once all prerequisites are set up, follow these steps to run the Laravel web application locally.
1. Open Visual Studio Code and navigate to your Laravel project folder:
   ```
   cd laravel-app
   ```
2. Run the following command to install all project dependencies:
   ```
   composer install
   ```
3. Start the Laravel development server:
   ```
   php artisan serve
   ```
This will return a local server URL (usually http://127.0.0.1:8000). Open it in your browser to view the website.

⚠️ **Important:**
The development server must remain running in the terminal while you use the website.
If you need to run other commands, open a new terminal tab or window.