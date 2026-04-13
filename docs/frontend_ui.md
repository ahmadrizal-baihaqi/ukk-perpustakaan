# Frontend UI & Views Documentation

This document provides a comprehensive overview of the frontend structure, views, and Blade templates used in the Libera School Library web application. The frontend uses **Tailwind CSS** for styling, structured with Laravel Blade.

## View Ecosystem Structure

The standard view files are located in the `resources/views` directory:

```text
resources/views/
├── welcome.blade.php       # Landing Page
├── dashboard.blade.php     # User (Siswa) main interface
├── layouts/                # Shared layout wrappers
│   ├── app.blade.php       # Main wrapper (authenticated)
│   ├── guest.blade.php     # Main wrapper (unauthenticated/auth pages)
│   └── navigation.blade.php# Top/Side navigation menus
├── admin/                  # Admin exclusive views
│   ├── dashboard.blade.php # Admin statistics
│   ├── books.blade.php     # Manage Book Inventory
│   ├── categories.blade.php# Manage Book Categories
│   ├── users.blade.php     # Manage Application Users
│   └── reports.blade.php   # View Borrowing Transaction History
└── auth/                   # Laravel Breeze built-in auth views
    ├── login.blade.php
    └── register.blade.php
```

## Primary Layouts

The application utilizes the DRY (Don't Repeat Yourself) principle by wrapping pages in predefined layout views:

- **`layouts.app`**: The standard authenticated shell. Contains the `<html>`, `<head>`, body structure, and includes the `navigation.blade.php` component. Used by wrapping content in `@extends('layouts.app')` or `<x-app-layout>`.
- **`layouts.guest`**: The unauthenticated shell. Used mostly for the login, register, forgot password, and reset password screens. Minimal formatting.

## Role-based User Interfaces

### 1. Guest / Landing
**View**: `welcome.blade.php`
- Displays library statistics anonymously (Total Books, Users, and Current Loans).
- Provides Call-to-Action (CTA) buttons to `Log in` or `Register`.

### 2. User (Student/Siswa)
**View**: `dashboard.blade.php`
- Displays a grid/list of all **Books** along with their **Categories**.
- Allows filtering books by category.
- Books display stock status. Books with `0` stock remain visible but borrowing is disabled.
- **My Loans Section**: Displays a table array of the user's current and past borrowed books along with the borrowing `status`, `batas_kembali` (due date), and a button to `Kembalikan` (return) if still borrowed.

### 3. Administrator Dashboard
**Views**: `admin/*`

- **`dashboard.blade.php`**: Presents top-line metric cards (Total Books, Active Users, Books Currently Borrowed) and a table of the 10 most recent loans.
- **`books.blade.php`**: CRUD interface for Books. Incorporates a modal or form mechanism to add new titles, upload cover images, and update quantities.
- **`categories.blade.php`**: CRUD interface for Categories. Simplifies grouping mechanics for books.
- **`users.blade.php`**: Administrative view to see registered users, add accounts manually, update emails, or delete unwanted accounts. Admin roles themselves are typically shielded from standard deletion to prevent lockout.
- **`reports.blade.php`**: Read-only tracking page that lists ALL loan records across ALL users, useful for generating library audits or chasing overdue items.

## Interactions & UI State

- **Flash Messages**: Application actions (`store`, `update`, `delete`, `borrow`, `returnBook`) redirect back with `success` or `error` session flashes. These are usually intercepted in Blade via `session('success')` and displayed as toast notifications or alert banners.
- **Styling**: Relies entirely on Tailwind utility classes. The design favors responsive containers (`max-w-7xl mx-auto`), rounded corners (`rounded-lg`), shadows (`shadow-sm`), and distinct background segments (`bg-white dark:bg-gray-800`).
