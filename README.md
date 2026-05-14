# laravel13

Custom Laravel 13 module generator with complete CRUD scaffolding.

---

# Features

✅ Generate complete module using one command  
✅ Resource Controller generation  
✅ Form Request generation  
✅ Service layer generation  
✅ Repository layer generation  
✅ Blade view generation  
✅ Module remove command  
✅ Clean scalable architecture  

---

# Commands

## Create Module

```bash
php artisan make:module Customer
```

Creates:

```text
Model
Migration
Resource Controller
Store Request
Update Request
Service
Repository
Views
```

---

## Remove Module

```bash
php artisan remove:module Customer
```

Removes:

```text
Model
Migration
Controller
Requests
Service
Repository
Views
```

---

# Generated Structure

```text
app/
├── Models/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Services/
├── Repositories/
```

```text
resources/views/admin/
```

---

# Architecture

```text
Controller
   ↓
Form Request
   ↓
Service
   ↓
Repository
   ↓
Model
```

---

# Installation

Clone repository:

```bash
git clone https://github.com/Dvs149/laravel13.git
```

Go to project:

```bash
cd laravel13
```

Install dependencies:

```bash
composer install
```

---

# Push Existing Project To GitHub

```bash
echo "# laravel13" >> README.md

git init

git add README.md

git commit -m "first commit"

git branch -M main

git remote add origin https://github.com/Dvs149/laravel13.git

git push -u origin main
```

---

# Requirements

- PHP 8+
- Laravel 13

---

# Future Improvements

- Auto route generation
- API module support
- DTO support
- Interface repositories
- Policy generation
- Test generation
- DataTable integration

---

# Author

Divyesh Lunagariya# laravel13
