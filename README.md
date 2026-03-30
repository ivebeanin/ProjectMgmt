# Mini Task Management System

**Developer:** Hanif Haqiemy  
**Company:** Telediant Engineering Sdn. Bhd.  
**Framework:** Laravel (latest stable version)  
**Database:** MySQL  
**Frontend:** Blade Templates with Tailwind CSS  
**Authentication:** Laravel Breeze

---

## Project Description

This is a simple **web-based Task Management System** built using Laravel. It allows users to:

- Register, log in, and manage their account securely.
- Create, edit, and delete projects.
- Add, edit, delete, and filter tasks under specific projects.
- View a dashboard summarizing projects and tasks by status.
- Ensure users can only access their own projects and tasks.

---

## Features

### User Authentication

- Registration, login, and logout
- Password hashing (Laravel default)
- Each user only sees their own projects and tasks

### Project Management

- Create, edit, delete projects
- View list of projects
- Projects belong to a single user

### Task Management

- Create, edit, delete tasks under projects
- Filter tasks by status
- Tasks belong to a project, and cannot exist independently

### Dashboard

- Total project count
- Total task count
- Tasks count by status (To Do, In Progress, Done)

---

## Database Setup

The database uses **MySQL** and is managed with Laravel migrations.

### Tables and Relationships

- `users` → hasMany → `projects`
- `projects` → hasMany → `tasks`
- Foreign keys and proper normalization are applied.

### Steps to Setup Database

1. Create a MySQL database:
    ```sql
    CREATE DATABASE projectmanagement;
    ```
