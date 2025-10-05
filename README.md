## 🧾 README — Student Portal Project (XAMPP Setup Guide)

### 📁 Project Overview

The **Student Portal** is a web-based system designed for managing student information, academic resources, and admin functionalities. It includes sections for students, administrators, and course-related data.

### 🧩 Tech Stack

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Server:** Apache (via XAMPP)

---

## ⚙️ Installation & Setup (For Any Machine)

### Step 1: Install XAMPP

1. Download **XAMPP** from the official website:
   👉 [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
2. Install it using the default options.
3. After installation, open the **XAMPP Control Panel** and start:

   * **Apache**
   * **MySQL**

---

### Step 2: Move Project to `htdocs`

1. Locate your XAMPP installation folder (usually `C:\xampp\` on Windows).
2. Open the `htdocs` folder.
3. Copy the folder:

   ```
   StudentPortal 4/StudentPortal
   ```

   into:

   ```
   C:\xampp\htdocs\
   ```
4. You should now have:

   ```
   C:\xampp\htdocs\StudentPortal
   ```

---

### Step 3: Set Up the Database

1. In your browser, go to:

   ```
   http://localhost/phpmyadmin
   ```
2. Click **New** on the left sidebar to create a new database.
3. Name it (for example):

   ```
   student_portal
   ```
4. Click **Create**.
5. Import the provided SQL file:

   * Go to the **Import** tab.
   * Click **Choose File**.
   * Locate the `.sql` file (if present in the `Project Report` or root directory).
   * Click **Go** to import the database structure and data.

---

### Step 4: Configure Database Connection

If the project uses a configuration file (usually named `config.php`, `dbconnect.php`, or similar), make sure it contains the correct credentials:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_portal"; // match your phpMyAdmin DB name

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

---

### Step 5: Run the Project

Open your browser and go to:

```
http://localhost/StudentPortal/
```

If you have an admin panel, it might be located at:

```
http://localhost/StudentPortal/admin panel/
```

---

### 🧠 Troubleshooting Tips

* **Apache won’t start:** Check if Skype or another app is using port 80. Change Apache port to 8080 in XAMPP settings.
* **Database errors:** Make sure your MySQL service is running and credentials match the config file.
* **Missing assets:** Ensure paths in your HTML/CSS/JS files are relative (`./CSS/style.css`) and not absolute.

---

### 📄 Folder Structure

```
StudentPortal/
│
├── admin panel/        # Admin pages and dashboards
├── CSS/                # Stylesheets
├── Font/               # Font resources
├── HTML/               # Main HTML files
├── Icons/              # Icon assets
├── Images/             # Images and media
├── JS/                 # JavaScript files
├── json/               # Data or configuration JSON files
├── Project Report/     # Documentation and SQL (if provided)
└── README.md           # Project documentation
```

---

### 👨‍💻 Author / Contributors

Deepak D Nayak, MIT 
Aman J Sonal, MIT
Sadanand, MIT
