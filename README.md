# Human Resources Management System (HRMS)

A lightweight workforce and leave management web application built with vanilla PHP, SQLite, and JavaScript.

---

## Key Features

- **Role-Based Access Control (RBAC):** Distinct permission tiers for system administrators, HR managers, and employees.
- **Employee Directory:** Full CRUD operations for company personnel records.
- **Leave Request Management:** JSON-based API workflow for requesting, tracking, and approving employee vacation leaves.
- **Audit Tracking:** Session-based authentication logging user access timestamps.

---

## Tech Stack

- **Backend:** PHP (PDO / SQLite3)
- **Database:** SQLite
- **Frontend:** Vanilla JavaScript (ES6+), HTML5, CSS3, Google Material Symbols
- **Environment:** Apache / XAMPP / Native PHP CLI Server

---

## Database Setup

1. Initialize the SQLite database schema:
   ```bash
   sqlite3 database/dados.db < database/dados.sql
