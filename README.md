# 🔐 Laravel Google Authentication

> **Google Login, Register & Logout using Gmail (OAuth 2.0) in Laravel**

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![Google](https://img.shields.io/badge/Google-OAuth%202.0-blue?logo=google)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php)

---

## 📌 Overview

This project demonstrates **Google Authentication (Login, Register, Logout)** using **Google Gmail (OAuth 2.0)** in a **Laravel** application.

Users can:

* Sign in with their **Google account**
* Automatically **register** if they are new
* **Logout** securely

Authentication is handled via **Laravel Socialite** following best practices.

---

## 🧩 Tech Stack

* **Laravel 12+**
* **PHP 8.2+**
* **Laravel Socialite**
* **Google OAuth 2.0**
* **MySQL / PostgreSQL**

---

## 🖼️ Architecture Flow

```text
User → Google Login → Google OAuth → Laravel Callback
     → Create / Update User → Login Session / Token
```

---

## 🚀 Features

* ✅ Google Login with Gmail
* ✅ Auto user registration
* ✅ Secure logout
* ✅ Clean controller & service structure
* ✅ Environment-based configuration

---

## 📦 Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/your-username/laravel-google-auth.git
cd laravel-google-auth
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

---

## 🔑 Google OAuth Setup

### Step 1: Create Google App

1. Go to **Google Cloud Console**
2. Create a new project
3. Enable **Google+ / People API** (if required)
4. Configure **OAuth Consent Screen**
5. Create **OAuth Client ID**

### Step 2: Authorized Redirect URI

```text
http://localhost:8000/auth/google/callback
```

---

## ⚙️ Environment Variables

Add the following to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

---

## 📚 Configuration

### config/services.php

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
```

---

## 🛣️ Routes

### routes/web.php

```php
use App\Http\Controllers\Auth\GoogleAuthController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
Route::post('/logout', [GoogleAuthController::class, 'logout']);
```

---

## 🧠 Controller Logic

### GoogleAuthController.php

**Main Responsibilities:**

* Redirect to Google
* Handle callback
* Register or login user
* Logout

```php
Socialite::driver('google')->redirect();
```

```php
$user = Socialite::driver('google')->user();
```

---

## 🗄️ Database

### users table fields

| Column    | Type              |
| --------- | ----------------- |
| name      | string            |
| email     | string            |
| google_id | string (nullable) |
| avatar    | string (nullable) |

Run migrations:

```bash
php artisan migrate
```

---

## 🔐 Authentication Logic

* If email exists → **Login user**
* If email does not exist → **Register + Login**
* Google ID stored for future logins

---

## 🚪 Logout

```php
Auth::logout();
request()->session()->invalidate();
request()->session()->regenerateToken();
```

---

## 🧪 Testing

```bash
php artisan serve
```

Visit:

```text
http://localhost:8000/auth/google
```

---

## 📸 Screenshots (Optional)

```md
![Google Login](docs/images/google-login.png)
![Laravel Dashboard](docs/images/dashboard.png)
```

---

## 🛡️ Security Best Practices

* Store secrets in `.env`
* Use HTTPS in production
* Validate Google user email
* Regenerate session on login

---

## 📄 License

This project is open-source and available under the **MIT License**.

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first.

---

## ✨ Author

**Isuru**
Laravel & Full-Stack Developer
🇱🇰 Sri Lanka

---

> ⭐ If this project helps you, please give it a star on GitHub!
