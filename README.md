
# 🚀posts mangement

This is a simple front-end project that includes two separate login systems: one for administrators and one for regular users. After logging in, both users and admins can create and view all posts. However, only the admin has the ability to edit or delete any post, while regular users can only edit or delete their own posts.

## 🚀 Features

- User & Admin authentication
- Role-based access control
- CRUD operations for posts
- API endpoints 

## 🧰 Tech Stack

- **Framework:** Laravel 
- **Database:** MySQL
- **Authentication:**  Sanctum 

## 🛠️ Installation and Setup Instructions

 **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
```

 **install dependencies**
- composer install

 **run migration**
- php artisan migrate

**Set Up Environment File**
   ```bash
  cp .env.example .env
```

**Generate App Key**
  ```bash
 php artisan key:generate
```
- **seeder**
-php artisan db:seed

 **run migration**
 ```bash
 php artisan migrate
```
**start server**
 - php artisan ser
