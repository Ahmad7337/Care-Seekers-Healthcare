# Care Seekers Healthcare

A web platform that connects individuals seeking caregiving services with qualified Support Workers. Built as a final year project for the **BS Computer Sciences** degree at Virtual University of Pakistan.

---

## Overview

Care Seekers Healthcare is a service marketplace focused specifically on care-related jobs. Care Seekers can register, post jobs, and hire Support Workers across a range of categories. Support Workers create profiles with their hourly rates, browse available job listings, and communicate with clients through a built-in messaging system before accepting work.

Think of it as a lightweight, care-specific freelance platform — but for babysitters, elder care helpers, personal trainers, domestic assistants, and similar roles.

---

## Service Categories

The platform supports the following types of care services:

- Elder Care
- Sick Care
- Baby Care / Babysitting
- Cooking
- Personal Care
- Animal Care
- Gym Instruction
- Domestic Assistance

---

## Features

### Care Seeker
- Register and manage a personal profile
- Post job listings with service type, details, hourly budget, and preferred time
- Browse and review Support Worker profiles
- Message Support Workers directly to negotiate and finalize terms
- Select and hire a Support Worker for a job
- Leave ratings and reviews after job completion

### Support Worker
- Register with bio-data, profile picture, hourly rate, experience, and references
- Browse available job listings
- Apply for jobs and communicate with Care Seekers via messaging
- Accept or decline job offers

### Admin
- Manage all user accounts
- Verify Support Worker credentials
- Handle reported issues and disputes

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP |
| Web Server | Apache (via XAMPP) |
| Database | MySQL |
| Frontend | HTML, CSS |
| Dev Environment | XAMPP (local) |
| Editor | Notepad++ v8.6 |

---

## System Modules

The application is structured around the following core modules:

1. **User Registration Module** — Handles account creation for both user types
2. **Authentication & Security Module** — Login, session management, and access control
3. **Profile Management Module** — Editable profiles for Care Seekers and Support Workers
4. **Job Posting Module** — Create, publish, and manage job listings
5. **Messaging Module** — In-platform communication between both parties
6. **Job Acceptance Module** — Workflow for applying, reviewing, and confirming jobs
7. **Review & Rating Module** — Post-job feedback system

---

## Project Architecture

The project follows a standard **client-server architecture**:

- The browser (client) sends requests to an Apache web server
- PHP scripts on the server handle business logic and communicate with the MySQL database
- Responses are sent back to the client as rendered HTML pages

The development followed the **VU Process Model** — a hybrid methodology combining the structured phases of **Waterfall** (requirements → design → development → testing) with the iterative risk management cycles of the **Spiral** model.

---

## Design Artifacts

The following diagrams are documented in the project report:

- Use Case Diagram
- Entity-Relationship Diagram (ERD)
- Database Diagram
- Architecture Design Diagram
- Class Diagram
- Sequence Diagrams:
  - Registration Sequence
  - Login Sequence
  - Job Posting Sequence
  - Messaging Sequence

---

## Local Setup

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (includes Apache + MySQL + PHP)
- A web browser

### Steps

1. Clone the repository into your XAMPP `htdocs` folder:
   ```bash
   git clone https://github.com/YOUR_USERNAME/care-seekers-healthcare.git
   cd xampp/htdocs/care-seekers-healthcare
   ```

2. Start **Apache** and **MySQL** from the XAMPP Control Panel.

3. Open your browser and navigate to:
   ```
   http://localhost/care-seekers-healthcare
   ```

---

## Database Setup

> ⚠️ The SQL database is NOT included in this repository.

1. Open **phpMyAdmin** at `http://localhost/phpmyadmin`
2. Create a new database named `webapp`
3. Recreate the schema using the Database Diagram in the project report
4. Update `db.php` with your own credentials:

```php
$dbhost = "localhost:3306"; // Use 3307 if you have a port conflict
$dbuser = "root";           // Your MySQL username
$dbpass = "";               // Your MySQL password
$dbname = "webapp";
```
---

## Project Info

| Field | Detail |
|---|---|
| Author | Muhammad Ahmad |
| Student ID | bc190405120 |
| University | Virtual University of Pakistan |
| Department | Computer Sciences |
| Degree | BS Computer Sciences |
| Supervisor | Faizan Tahir |

---

## License

This project was submitted as academic coursework. Feel free to use it as a reference or learning resource. Attribution is appreciated.