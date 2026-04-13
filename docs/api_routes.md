# Application Routes & Backend Logic

This document details the application routes and backend logic for the Libera Library System.

## Public Routes

| Method | Endpoint | Description | Return |
| --- | --- | --- | --- |
| GET | `/` | Guest Welcome Page. Shows metrics (Total Books, Users, Loans) | `view('welcome')` |

*(Note: Auth routes are managed by Laravel Breeze via `require __DIR__.'/auth.php';`)*

## Admin Routes
**Middleware**: `auth`, `role:admin`
**Controller**: `AdminController`

| Method | Endpoint | Action | Description |
| --- | --- | --- | --- |
| GET | `/admin/dashboard` | `index()` | Dashboard view with metrics and recent loans. |
| GET | `/admin/categories` | `categories()` | List all categories. |
| POST | `/admin/categories` | `storeCategory()` | Create a new category. Required: `nama_kategori`. |
| PUT | `/admin/categories/{id}` | `updateCategory()` | Update an existing category. |
| DELETE | `/admin/categories/{id}` | `deleteCategory()` | Delete a category. |
| GET | `/admin/books` | `books()` | List all books along with their category. |
| POST | `/admin/books` | `storeBook()` | Create a new book. Uploads `cover` image. |
| PUT | `/admin/books/{id}` | `updateBook()` | Update an existing book with optional new `cover`. |
| DELETE | `/admin/books/{id}` | `deleteBook()` | Delete a book and its associated `cover` image from storage. |
| GET | `/admin/users` | `users()` | List all users (excluding admins). |
| POST | `/admin/users` | `storeUser()` | Creates a new user with default `role: user` and hashed password. |
| PUT | `/admin/users/{id}` | `updateUser()` | Update user details. Password update is optional. |
| DELETE | `/admin/users/{id}` | `deleteUser()` | Delete a user. |
| GET | `/admin/reports` | `reports()` | List all loan transaction histories. |

## User (Siswa) Routes
**Middleware**: `auth`, `role:user`
**Controller**: `UserController`

| Method | Endpoint | Action | Description |
| --- | --- | --- | --- |
| GET | `/dashboard` | `index()` | User dashboard showing all books, categories, and their own loan history. |
| POST | `/borrow` | `borrow()` | Borrow a book. Required: `book_id`, `durasi`. Will deduct stock by 1. Calculates due date automatically based on `durasi` (1-14 days). |
| POST | `/return/{id}` | `returnBook()` | Return a borrowed book. Adds 1 to stock and updates `tanggal_kembali` and `status` to `dikembalikan`. |

## Backend Logic Details

### Book Borrowing Logic
1. User submits a request to `/borrow` with `book_id` and intended `durasi` in days.
2. The `UserController@borrow` checks if stock is `> 0`.
3. If stock is available:
   - A new row is inserted into `loans` with `status = 'dipinjam'`.
   - `batas_kembali` is set to `now() + durasi`.
   - The selected `Book` decrements its `stok` field by `1`.
     
### Book Returning Logic
1. User submits a return request `/return/{loan_id}`.
2. `UserController@returnBook` checks if the loan belongs to the authenticated user.
3. If the book status is not yet `dikembalikan`:
   - Updates `status` to `dikembalikan` and `tanggal_kembali` to `now()`.
   - The `stok` of the `Book` increments by `1`.

### File Upload Handling
- When the Admin adds/edits a book, the `cover` image is uploaded into the `public/covers` directory (`store('covers', 'public')`).
- If a book is deleted or its cover is replaced, the old cover image is deleted using `Storage::disk('public')->delete()`.
