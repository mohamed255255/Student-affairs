# Student Affairs Project

A **mini student affairs system** built with **Laravel**.  
This project was developed as part of my learning journey to explore Laravel’s ecosystem and apply different concepts in practice.  

It is still a **work-in-progress (MVP)**, with around **60% completed**, but it already demonstrates key features like authentication, multi-guards, CRUD operations, and real-time notifications.

---

## 🚀 Features Implemented

- **Authentication & Authorization**
  - Implemented with [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze).
  - Multi-guard setup for different roles (Admin, Student, etc.).

- **CRUD Operations**
  - Manage **students** and **courses** with create, read, update, and delete actions.

- **Real-Time Notifications (ITS WORKS FINE BUT NOT COMPLETED)**
  - Laravel Broadcasting with listeners to send notifications to students in real time.

- **Localization (Multi-Language Support)**
  - Ability to switch between languages.

- **Email Notifications**
  - Configured email controller and mailables for system notifications.

- **Error Handling**
  - Custom exception handling structure.

- **Unit Testing**
  - Wrote initial tests for validation and functionality.

---

## 📚 What I Learned

- Setting up and customizing **Laravel Breeze** for authentication.
- How to use **multi-guards** to handle multiple roles.
- Basics of **Laravel Broadcasting** for real-time features.
- Creating and handling **Laravel notifications** and **mail**.
- Structuring **CRUD controllers** and validation.
- Implementing **localization** in Laravel.
- Writing **unit tests** for better code reliability.

---

## 🛠 Tech Stack

- **Framework:** Laravel  
- **Frontend:** Bootstrap  
- **Database:** MySQL  
- **Authentication:** Laravel Breeze (multi-guard setup)  
- **Real-Time:** Laravel Broadcasting  
- **Testing:** PHPUnit (basic unit tests)  

---

## 📌 What’s Left / To-Do

- Refactor some methods and controllers for better code quality.
- apply service layer and move validations to seperate form request
- Complete pending CRUD operations and notifications implementation.
- put more test classes.  
- some blade files are not completed.  
- Finish language translations.  
- Implement **Laravel Sanctum** for token-based authentication to secure API access
- Refactor routes to use **API routes (api.php)** instead of web routes, making the system stateless and more scalable for larger applications.
- containerize the project

## ✅ Status

This is an **MVP project** — not yet fully completed, but demonstrates the core concepts of authentication, role management, notifications, and CRUD functionality on a small scale in order to learn.
