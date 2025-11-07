# PHP Modern Classic MVC (No Composer, No Framework)

This is a lightweight **classic MVC** structure inspired by early PHP frameworks, but simplified to be readable and easy to extend.  
It uses:

- A single **front controller** (`public/index.php`)
- **Pretty URLs** via Nginx (Herd) routing
- **Controllers** that respond to routes
- **Models** that talk to the database using PDO
- **Views** as plain PHP templates

---

## 🚧 Project Structure

root/
├── app/
│ │
│ ├─┬ controllers/ 				# Controllers (handle requests)
│ │ │
│ │ ├── Home.php                # Default Controller
│ │ │
│ │ └── Home.php                # Default Controller
│ │ 				
│ ├── models/ 					# Models (database queries)
│ │
│ └─┬ views/ 					# Views (HTML templates)
│   │
│   ├─┬ home                
│   │ │
│   │ └── index.php
│   │
│   └─┬  about
│     │
│     └── index.php
│ 
├─┬ core/
│ │
│ ├── App.php 					# Router: maps URL -> controller/action/params
│ │
│ ├── Controller.php 			# Base controller (render, redirect, model loader)
│ │
│ └── Model.php 				# Base model (PDO connection)
│ 
├─┬ public/ 					# Web root served by Herd/Nginx
│ │
│ └── index.php 				# Front controller (bootstraps App)
│
├─┬ system/
│ │
│ └── config.php 				# App + database configuration
│
└── init.php 					# Autoload + loads core + loads config


---

## ⚙️ How Routing Works

The URL structure looks like:


Examples:

| URL            | Controller | Method    | Notes                     |
|----------------|------------|-----------|---------------------------|
| `/`            | Home       | index()   | Default route             |
| `/about`       | About      | index()   | Auto-detected action      |

---

## 🧱 Controllers

Controllers live in `app/controllers` and **must** use the namespace:

```php
<?php
namespace App\Controllers;

use Core\Controller;

class About extends Controller
{
    public function index(): void
    {
        $this->render('about/index', ['title' => 'About Page']);
    }
}
```

## 💾 Models

Models live in `app/models` and extend `Core\Model`.

Each model writes its own queries:

```php
<?php
namespace App\Models;

use Core\Model;

class Post extends Model
{
    public function getAll(): array
    {
        return $this->db->query("SELECT * FROM posts ORDER BY id DESC")->fetchAll();
    }

    public function create(string $title, string $body): bool
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
        return $stmt->execute(['title' => $title, 'body' => $body]);
    }
}

```

## 🎨 Views

Views live in `app/views/<controller>/<view>.php`.

They receive data as variables:

```php
<h1><?= htmlspecialchars($title) ?></h1>
<p>This is the about page.</p>
```

## 🗄 Database Configuration

Set database connection details in:

`system/config.php`

```php
'db' => [
    'dsn'  => 'mysql:host=localhost;dbname=app;charset=utf8mb4',
    'user' => 'root',
    'pass' => 'password',
]
```

*Make sure your database exist*

--

# 🏁 Running the App (Herd / Nginx)

In Herd, set your document root to:

`public/`

Then visit:

`http://php-modern-mvc.test/`


# ✅ Adding a New Page

1. Create controller: `app/controllers/Contact.php`

2. Add view folder: `app/views/contact/index.php`

3. Visit: `http://php-modern-mvc.test/contact`