# Human Resources Management System (HRMS)

A lightweight workforce and leave management web application built with vanilla PHP, SQLite, and JavaScript. Designed to streamline employee data administration, role-based access control, and internal leave approval workflows.

---

## Architecture & Key Features

- **Role-Based Access Control (RBAC):** Distinct permission tiers for System Administrators, HR Specialists, and Employees.
- **Employee Directory:** Full lifecycle CRUD operations for managing company personnel records (`funcionarios.php`).
- **Leave Request Pipeline:** Asynchronous JSON-based endpoints for submitting, tracking, and updating employee vacation and absence requests (`ferias.html`, `adicionar_pedido_ferias.php`).
- **Access & Audit Logging:** Session-based authentication tracking active users and recording login timestamps (`ultimos_acessos.php`).
- **Interactive Calendar:** Visual scheduling interface for tracking team availability and approved leaves (`calendar.php`).

---

## Tech Stack

- **Backend:** PHP 8+ (PDO & SQLite3 native extensions)
- **Database:** SQLite (`database/dados.sql`)
- **Frontend:** Vanilla JavaScript (ES6+), HTML5, CSS3, Google Material Symbols
- **Server Environment:** Apache (XAMPP) or PHP Built-in CLI Web Server

---

## Project Structure

```text
hr-management-system/
├── database/
│   └── dados.sql                 # SQLite database schema and seed structure
├── images/
│   └── Login_background.jpg      # UI static assets
├── scripts/
│   ├── adicionar_pedido_ferias.php
│   ├── adicionar_permissoes.php
│   ├── adicionarfuncionario.php
│   ├── atualizar_estado_ferias.php
│   ├── calendar.php
│   ├── dashboard.js
│   ├── editar_permissoes.php
│   ├── funcionariosAtivos.php
│   ├── funcionariosDropdown.js
│   ├── infoprojeto.js
│   ├── lista_funcionarios.php
│   ├── lista_permissoes.php
│   ├── login.php
│   ├── removerfuncionario.php
│   ├── valida_login.js
│   └── validapopup.js
├── styles/
│   ├── dashboard.css
│   ├── ferias.css
│   ├── funcionarios.css
│   ├── index.css
│   ├── permissoes.css
│   ├── relatorios.css
│   └── ultimos_acessos.css
├── dashboard.php                 # Main application portal
├── ferias.html                   # Leave request management view
├── funcionarios.php              # Employee directory view
├── index.html                    # Authentication entry point
├── permissoes.php                # RBAC management interface
├── relatorios.html               # HR reporting view
└── ultimos_acessos.php           # Audit log interface
```

---

## User Roles & Capabilities

| Role | Key Capabilities |
| :--- | :--- |
| **Administrator** | Create, edit, and remove employee records; assign and modify module access permissions; audit system access logs. |
| **HR Specialist** | Review and process pending leave requests; update employee profiles; generate attendance and workforce reports. |
| **Employee** | View and maintain personal profile information; submit vacation or absence requests; track real-time request status. |

---

## Local Development Setup

### Prerequisites
- **PHP 8.1+** with `pdo_sqlite` and `sqlite3` extensions enabled.
- **SQLite3** CLI tool (optional, for schema initialization).

### 1. Clone the Repository
```bash
git clone https://github.com/Phenriques36/hr-management-system.git
cd hr-management-system
```

### 2. Initialize the Database
Create the local SQLite database file from the provided SQL schema:
```bash
sqlite3 database/dados.db < database/dados.sql
```

Ensure the web server has write permissions to the `database/` directory and database file:
```bash
chmod 775 database/
chmod 664 database/dados.db
```

### 3. Run the Application
Start the built-in PHP development server from the project root:
```bash
php -S localhost:8000
```
Open `http://localhost:8000` in your browser.

---

## Project Roadmap & Ongoing Development

- [ ] **Security Hardening:** Migrate legacy plaintext credential matching in `scripts/login.php` to `password_hash()` and `password_verify()`.
- [ ] **Database Layer Unification:** Refactor remaining `SQLite3` class instances into a single centralized `PDO` connection wrapper.
- [ ] **Session & RBAC Middleware:** Enforce server-side session and role validation across all state-changing POST endpoints (`removerfuncionario.php`, `adicionar_permissoes.php`).
- [ ] **CSRF Protection:** Implement anti-CSRF token generation and verification across all forms and asynchronous fetch requests.
- [ ] **Automated Testing:** Introduce PHPUnit test suites for authentication flows, permission checks, and leave date validation.
- [ ] **API Standardization:** Standardize legacy Portuguese script filenames and routes into RESTful English endpoints.
