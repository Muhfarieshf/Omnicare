# OmniCare – Hospital Appointment Booking System

OmniCare is a hospital appointment booking system built with CakePHP 5.x. It provides a modern, corporate, and responsive web interface for managing hospital appointments, patients, doctors, and departments.

## Key Features

-   **User Roles:** Admin, Doctor, Patient (with access control and restrictions)
-   **Authentication & Authorization:** Secure login, registration, and role-based access
-   **Appointment Management:** Book, view, edit, and cancel appointments
-   **Dashboards:** Custom dashboards for Admins, Doctors, and Patients
-   **Patient & Doctor Management:** CRUD operations for patients and doctors
-   **Department Management:** Organize doctors by departments
-   **Role-Based Search:** Powerful, role-aware search for patients, doctors, appointments, and more. Includes a main search widget and a topbar quick search with AJAX dropdown results.
-   **Reports:** Generate and print appointment and patient reports. Includes monthly, daily, and doctor-specific report templates for admins and doctors.
-   **Flash Messaging:** User feedback for actions (success, error, etc.)
-   **Responsive UI:** Bootstrap-based, clean, and professional design

## Architecture

-   **Backend:** CakePHP 5.x MVC framework (PHP 8+)
-   **Frontend:** Bootstrap 5, FontAwesome, custom CSS
-   **Database:** MySQL (see `hospital_appointment_system.sql` for schema)
-   **Testing:** PHPUnit, CakePHP test suite

## Setup & Installation

1. Clone the repository and install dependencies:
    ```bash
    composer install
    ```
2. Configure your database in `config/app_local.php`.
3. Import the schema from `hospital_appointment_system.sql`.
4. Start the server:
    ```bash
    bin/cake server -p 8765
    ```
5. Visit [http://localhost:8765](http://localhost:8765) in your browser.

## Installation (OmniCare)

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Muhfarieshf/Omnicare.git
    cd Omnicare
    ```
2. **Install PHP dependencies:**
    ```bash
    composer install
    ```
3. **Configure your environment:**
    - Copy `config/app_local.example.php` to `config/app_local.php`.
    - Edit `config/app_local.php` and set your database credentials and other settings.
4. **Import the database schema:**
    - Create a MySQL database (e.g., `hospital_appointment_system`).
    - Import `hospital_appointment_system.sql` into your database.
5. **Start the CakePHP server:**
    ```bash
    bin/cake server -p 8765
    ```
6. **Access the app:**
    - Open [http://localhost:8765](http://localhost:8765) in your browser.

> For more details, see the CakePHP documentation below.

## Usage

-   **Login/Register:** Patients can register; Admins/Doctors are created by admin.
-   **Book Appointments:** Patients can book with available doctors.
-   **Manage Data:** Admins manage users, doctors, departments, and appointments.
-   **Dashboards:** Each role sees relevant stats and quick actions.
-   **Reports:** Admins and doctors can generate printable reports, including:
    - Monthly appointment reports
    - Daily schedule printouts
    - Doctor-specific patient lists
  Access these from the Reports section in the navigation bar.

-   **Search:**
    - Use the main search bar (on dashboard/content pages) to search for patients, doctors, appointments, and departments.
    - The topbar quick search (always visible) provides instant AJAX-powered results as you type.
    - Search results are filtered based on your role (admin, doctor, patient) and permissions.
    - Click results to view details or take action.

## Access & Restrictions

-   **Patients:** Can only view and manage their own data/appointments.
-   **Doctors:** Can only view their own schedule and patients.
-   **Admins:** Full access to all features and data.

## Dependencies

-   CakePHP 5.x
-   Bootstrap 5
-   FontAwesome
-   MySQL

## New Features

### Role-Based Search

OmniCare now includes a robust, role-aware search system:

- **Main Search Widget:**
  - Located on key dashboard and content pages.
  - Lets you search for patients, doctors, appointments, and departments.
  - Results are filtered by your user role and permissions.

- **Topbar Quick Search:**
  - Always visible in the top navigation bar.
  - AJAX-powered: see instant results in a dropdown as you type.
  - Click a result to jump directly to the relevant record or page.

### Reporting Templates

- **Monthly Report:** View and print monthly appointment statistics.
- **Daily Schedule Print:** Print a daily schedule for doctors or departments.
- **Doctor Index:** Doctors can view and print their patient lists.

All report templates are accessible from the Reports menu. Reports are printable and styled for clarity.

---
