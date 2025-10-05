# 🎓 Student Portal Project

A web-based **Student Portal** system built with PHP (XAMPP), JSON (for local data storage), and basic frontend technologies.
It provides a landing page for all users, with dedicated dashboards for **students**, **faculties**, and **administrators**.

---

## 🚀 Features

### Public

* **Landing Page** – accessible to all visitors
* Overview of the portal and login options

### Student

* Secure login with unique credentials
* Access to assigned tasks, coursework, and notices
* Mark tasks as complete

### Faculty

* Faculty login with individual credentials
* View and manage student tasks
* Upload assignments or updates

### Admin

* Admin dashboard with extended privileges
* Add/edit/remove students and faculties
* Manage overall portal data

---

## 🛠️ Tech Stack

* **Frontend**: HTML, CSS, JavaScript
* **Backend**: PHP (via XAMPP)
* **Database/Storage**: JSON files (local)
* **Server**: Apache (XAMPP stack)

---

## 📂 Project Structure

```
/myproject
│
├── index.php              # Landing page
├── login.php              # Login handler
├── dashboard.php          # Shared dashboard logic
├── admin/                 # Admin dashboard & management tools
├── student/               # Student-specific pages
├── faculty/               # Faculty-specific pages
└── json/                  
    └── student.json       # Student data
    └── faculty.json       # Faculty data
```

---

## ⚙️ Installation & Setup

1. Install [XAMPP](https://www.apachefriends.org/) on your system.
2. Place the project folder inside the `htdocs` directory:

   ```
   C:\xampp\htdocs\myproject
   ```
3. Start **Apache** from the XAMPP Control Panel.
4. Access the project in your browser:

   ```
   http://localhost/myproject
   ```
5. JSON files are located under `/json/` and act as the storage layer for users and tasks.

---

## 🔑 Default Roles

* **Student** → Can log in and manage assigned tasks
* **Faculty** → Can log in, view, and assign work to students
* **Admin** → Can add/remove users and oversee portal

*(Default credentials can be defined in JSON files for testing.)*

---

## 📌 Future Enhancements

* Replace JSON storage with MySQL database
* Role-based access control (RBAC) with tokens
* Notification system for task updates
* Enhanced UI/UX with Bootstrap or React

---

## 🤝 Contributing

Contributions are welcome!

* Fork the repo
* Create a new branch (`feature/new-feature`)
* Commit changes and push
* Create a Pull Request

---

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).
