# OmniCare – Hospital Appointment Booking System

OmniCare is a hospital appointment booking system built with CakePHP 5.x. It provides a modern, corporate, and responsive web interface for managing hospital appointments, patients, doctors, and departments.

## Key Features

-   **User Roles:** Admin, Doctor, Patient (with access control and restrictions)
-   **Authentication & Authorization:** Secure login, registration, and role-based access
-   **Appointment Management:** Book, view, edit, and cancel appointments
-   **Dashboards:** Custom dashboards for Admins, Doctors, and Patients
-   **Patient & Doctor Management:** CRUD operations for patients and doctors
-   **Department Management:** Organize doctors by departments
-   **Reports:** (Future release) Generate and print appointment and patient reports (feature not yet available)
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

## Usage

-   **Login/Register:** Patients can register; Admins/Doctors are created by admin.
-   **Book Appointments:** Patients can book with available doctors.
-   **Manage Data:** Admins manage users, doctors, departments, and appointments.
-   **Dashboards:** Each role sees relevant stats and quick actions.
-   **Reports:** Admins and doctors can generate printable reports.

## Access & Restrictions

-   **Patients:** Can only view and manage their own data/appointments.
-   **Doctors:** Can only view their own schedule and patients.
-   **Admins:** Full access to all features and data.

## Dependencies

-   CakePHP 5.x
-   Bootstrap 5
-   FontAwesome
-   MySQL

---

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=5.x)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
