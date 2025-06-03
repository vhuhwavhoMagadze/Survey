1. Install and Launch XAMPP**

- Download and install XAMPP from https://www.apachefriends.org.
- Open the **XAMPP Control Panel**.
- Start the following services:
   - **Apache** (required to run PHP)
   - **MySQL** (required if your application uses a database)


2. Place Your PHP Project in the `htdocs` Directory**

- Navigate to the XAMPP installation folder on your computer.  
   Example path: `C:\xampp\htdocs\`
- Copy your PHP project folder into the `htdocs` directory.  
   Example: `C:\xampp\htdocs\



3. Set Up the Database (Required)

- Open your browser and go to:http://localhost/phpmyadmin
- Click on New to create a new database.
- go to section database and copy database.sql file and run it


4. Access the Application in Your Web Browser

- Open your preferred web browser.
- In the address bar, type the following URL and press Enter:  http://localhost/survey/index.php
- If your project contains an `index.php` file, it will load automatically.
