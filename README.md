# Operación Salud Colima Tamizaje

## Senior Capstone: Software Design Project 2025

### Prerequisites  
add prerequisites here


### Project Setup Instructions (for Windows + VS Code)

---

### **Step 1: Install MySQL**

Go to the official MySQL website and download the **MySQL Community Server** for Windows:  
(https://dev.mysql.com/downloads/mysql/)

Download Windows (x86, 64-bit), MSI Installer. Then run the installer and follow the prompts.

During installation:
- Set the **root password** (you’ll need it later).
- Ensure MySQL Server is configured to start automatically.

After installation, verify it's working:
1. Open the **Command Prompt** or **PowerShell**.
2. Run:
   ```
   mysql --version
   ```

To access MySQL from the command line, you may need to add the MySQL `bin` directory (usually `C:\Program Files\MySQL\MySQL Server X.X\bin`) to your system's **PATH** environment variable.

---

### **Step 2: Set Up SQLTools in VS Code (Alternative to MySQL Workbench)**

Open Visual Studio Code.

Go to the Extensions view (Ctrl+Shift+X).

Search for and install:
- SQLTools by Matheus Teixeira
- SQLTools MySQL/MariaDB Driver (you’ll need this to connect to MySQL)

 - Click on SQLTools extension (left side of screen, cylinder symbol) then click Add New connection
 - In the Connection Assistant, click MySQL as the driver.
 - Enter all the information found in the settings.json file, after the correct information is entered,
   click, test connection. IF connection is successful, save connection.
- The connection will now be visible in the Connections section of the SQLTools extention tab. Click the plug
  symbol to connect to the databse from now on.
---

### **Step 3: Install PHP**

1. Download PHP for Windows from:  
   (https://windows.php.net/download/)

   Download version PHP 8.4, VS17 x64 Non Thread Safe, ZIP

3. Extract the downloaded ZIP and place it in a directory like `C:\php`.

4. Add that directory to your **System PATH** environment variable.

5. To verify installation, open **Command Prompt** and run:
   ```
   php --version
   ```

---

### **Step 4: Install Composer (PHP dependency manager)**

1. Download and install Composer for Windows from:  
   (https://getcomposer.org/Composer-Setup.exe)

2. Add that directory to your **System PATH** environment variable.
   (Example: C:\ProgramData\ComposerSetup\bin)

4. After installation, verify Composer by running:
   ```
   composer --version
   ```

---

### **Step 5: Accessing the Website**

1. Navigate to the laravel-app directory in the frontend-backend-implementation branch

2. Start the Laravel development server:
   In the terminal, run the command:
   ```
   php artisan serve
   ```
  A link should pop up that you can follow to the website. This server must always
  be running to access the website. You must create a new terminal if you need to run
  and further commands.

---

## Jira Integration 
To use Jira's Integration, you need to use an issue key to sync progress to Jira's Board.
Issue keys are just special tags that are tied to any element we track in the app(Our to do tasks).
Issue keys are displayed on the task card.

---

### Branching with Jira issue keys
When creating your working branch, include the issue key for the task you are going to work on in order to sync with Jira Board.
```sh
git checkout -b issue-key-<branch-name>
```
---

### Committing with Jira issue keys
When committing from your working branch, include the issue key for the task you were working on to update Jira's Board.
```sh
git commit -m "issue-key <summary of commit>"
```
---

### Commit Resolved Issue When Pushing New Branch
If you receive the error "fatal: The current branch <issue-key-<branch-name>> has no upstream branch.",
run the following:
```sh
git push --set-upstream origin issue-key-<branch-name>
```
