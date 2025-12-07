# OmniCare – Modern Hospital Appointment System

OmniCare is a robust, enterprise-grade hospital appointment booking system built with **CakePHP 5.x**. It features a state-of-the-art **Glassmorphism UI** (inspired by Windows 11), a smart conflict detection engine, and comprehensive workflow management for patients, doctors, and administrators.

## 🚀 Key Features

### 📅 Advanced Appointment Management

-   **Smart Booking:** Real-time slot availability checking via AJAX.
-   **Conflict Detection:** Prevents double-booking by analyzing doctor schedules and existing appointments.
-   **Flexible Duration:** Support for variable appointment lengths (15 to 480 minutes).
-   **Status Workflow:** robust state machine handling transitions (_Scheduled → Confirmed → In Progress → Completed_).
-   **Cancellation Logic:**
    -   Patients can "Withdraw" pending requests instantly.
    -   Confirmed appointments require Doctor/Admin approval for cancellation.
    -   Doctors can decline or cancel appointments directly with reason tracking.

### 👨‍⚕️ Doctor Schedule & Availability

-   **Opt-Out Logic:** Doctors are available M-F, 9-5 by default.
-   **Schedule Management:** Doctors can override default hours or mark specific days as "Unavailable" (Off-duty).
-   **Department Filtering:** Patients can find doctors by department with bi-directional filtering.

### ⏳ Smart Waiting List

-   **Auto-Prompt:** Automatically offers the "Join Waiting List" option when a preferred slot is unavailable.
-   **Priority System:** High/Normal/Low priority queuing for critical cases.
-   **Management:** Doctors can view patients waiting specifically for their department.

### 🎨 Modern UI/UX (Glassmorphism)

-   **Windows 11 Theme:** "Mica" design language with acrylic blur effects, soft shadows, and rounded corners.
-   **Role-Based Dashboards:**
    -   **Admin:** System-wide stats, user management, and reporting.
    -   **Doctor:** Today's schedule, upcoming appointments, and quick actions.
    -   **Patient:** My appointments, history, and profile management.
-   **Responsive:** Fully optimized for mobile, tablet, and desktop views.

### 📊 Reporting & Search

-   **Search Widget:** Global search for patients, doctors, and appointments.
-   **Reports:** Generate monthly appointment summaries and printable daily schedules.

---

## 🛠 Technology Stack

-   **Framework:** CakePHP 5.x (PHP 8.1+)
-   **Database:** MySQL
-   **Frontend:** Bootstrap 5, Custom CSS (Glassmorphism/Acrylic)
-   **Icons:** FontAwesome 6
-   **Scripting:** JavaScript (Vanilla + AJAX)

---

## ⚙️ Installation

1.  **Clone the repository:**

    ```bash
    git clone [https://github.com/Muhfarieshf/Omnicare.git](https://github.com/Muhfarieshf/Omnicare.git)
    cd Omnicare
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    ```

3.  **Database Setup:**

    -   Create a MySQL database (e.g., `hospital_appointment_system`).
    -   Import the provided schema: `hospital_appointment_system.sql`.
    -   Configure your database credentials in `config/app_local.php`.

4.  **Start the Server:**

    ```bash
    bin/cake server -p 8765
    ```

5.  **Access the Application:**
    Open [http://localhost:8765](http://localhost:8765) in your browser.

---

## 👥 User Roles & Demo Credentials

| Role        | Username     | Password   | Access Level                                       |
| :---------- | :----------- | :--------- | :------------------------------------------------- |
| **Admin**   | `admin`      | `password` | Full system access, User/Dept management           |
| **Doctor**  | `dr_ahmad`   | `password` | Schedule management, Patient records, Appointments |
| **Patient** | `john_smith` | `password` | Book appointments, View history, Join waiting list |

---

## 📖 Usage Guide

### For Patients

1.  **Register/Login** to access your dashboard.
2.  Click **"Book Appointment"** to find a doctor.
3.  If your preferred time is full, click **"Join Waiting List"** to be queued.
4.  View your appointment status in **"My Appointments"**.

### For Doctors

1.  **Login** to view your "Today's Schedule" on the dashboard.
2.  Go to **"My Schedule"** to set your working hours or mark days off.
3.  Go to **"Waiting List"** to see patients queuing for your department.
4.  Use the **"View"** action on appointments to Confirm, Start, or Complete them.

### For Admins

1.  Manage **Users**, **Doctors**, and **Departments** via the sidebar.
2.  Generate reports from the **Reports** section.
3.  Oversee the entire **Waiting List** and **Appointment** flow.

---

## 📂 Project Structure

-   `src/Controller`: Handles request logic (Appointments, Doctors, WaitingList, etc.).
-   `src/Service`: Contains business logic (Conflict Detection, Smart Scheduling, Workflow).
-   `templates`: View files (Standardized with `modern-dashboard.css`).
-   `webroot/css`: Contains the global theme (`modern-dashboard.css`).

---

&copy; 2025 OmniCare Hospital Management System.
