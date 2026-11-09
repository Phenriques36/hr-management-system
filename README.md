# Human Resources Management System (HRMS)

A lightweight workforce and leave management web application built with vanilla PHP, SQLite, and JavaScript.

---

## Architecture & Features

- **Employee Directory:** Full CRUD operations for company personnel records.
- **Role-Based Access Control (RBAC):** Distinct permission tiers for system administrators, HR managers, and employees.
- **Leave Request Management:** JSON-based API workflow for requesting, tracking, and approving employee vacations.
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
   sqlite3 database/dados.db < database/schema.sql
