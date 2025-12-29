# Req-U - Student Event & Recruitment Platform

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.0-cyan)

## 📋 Overview

**Req-U** adalah platform manajemen event dan rekrutmen untuk mahasiswa. Sistem ini memungkinkan organisasi, kepanitiaan, dan laboratorium untuk mempublikasikan kegiatan mereka, sementara mahasiswa dapat dengan mudah menemukan dan mendaftar ke berbagai kesempatan yang tersedia.

### ✨ Key Features

#### 🎯 For Students & Organizers

-   **Dashboard dengan Grid View**: Tampilan poster kegiatan yang rapi dan menarik
-   **Advanced Filtering**: Filter berdasarkan kategori (Kepanitiaan, Organisasi, Laboratorium)
-   **Smart Search**: Pencarian berdasarkan judul dan deskripsi
-   **Deadline Sorting**: Urutkan berdasarkan deadline terdekat/terjauh
-   **CRUD Posts**: Buat, edit, update, dan hapus postingan (setelah approval admin)
-   **Bookmark System**: Simpan postingan favorit untuk akses cepat
-   **My Posts Management**: Lihat status postingan (Pending, Approved, Rejected)
-   **Archive**: Akses postingan yang sudah expired
-   **Real-time Notifications**: Notifikasi untuk approval/rejection postingan
-   **Report System**: Laporkan postingan yang tidak sesuai

#### 👨‍💼 For Admins

-   **Post Verification**: Approve atau reject postingan dengan pesan
-   **User Management**: Kelola dan hapus user yang tidak bertanggung jawab
-   **Report Management**: Tinjau dan selesaikan laporan dari user
-   **Archive Management**: Filter arsip berdasarkan tahun/bulan
-   **Full CRUD Access**: Akses penuh ke semua postingan (kecuali edit)

### 🎨 UI/UX Highlights

-   **Modern Gradient Design**: Gradient indigo-purple yang eye-catching
-   **Responsive Layout**: Optimal di desktop, tablet, dan mobile
-   **Smooth Animations**: Transisi dan hover effects yang halus
-   **Role-based Navigation**: Menu yang disesuaikan dengan role user
-   **Notification Dropdown**: Akses cepat ke notifikasi terbaru

## 🚀 Installation

### Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/PostgreSQL
-   Laragon/XAMPP/Valet (recommended)

### Setup Steps

```bash
# 1. Clone repository
git clone <repository-url>
cd requ_tubes

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
copy .env.example .env
php artisan key:generate

# 4. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=requ_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Run migrations and seed
php artisan migrate:fresh --seed

# 6. Create storage link
php artisan storage:link

# 7. Build assets
npm run build

# 8. Start development server
php artisan serve
```

## 👥 Default Accounts

After seeding, you can login with:

| Role      | Email            | Password |
| --------- | ---------------- | -------- |
| Admin     | admin@requ.com   | password |
| Organizer | hima@requ.com    | password |
| Student   | student@requ.com | password |

## 🌿 Git Branching Strategy

### Branch Structure

```
main (production-ready code)
├── develop (integration branch)
main (production-ready code)
├── develop (integration branch)
│   ├── feature/dashboard-controller    (Person 1)
│   ├── feature/post-controller         (Person 2)
│   ├── feature/bookmark-controller     (Person 3)
│   ├── feature/admin-moderation        (Person 4)
│   ├── feature/admin-system            (Person 5)
│   └── feature/notification-controller (Person 6)
```

### Team Workflow (6 Members Collaboration)

#### Person 1: Dashboard Controller

```bash
git checkout -b feature/dashboard-controller
# Work on:
# - app/Http/Controllers/DashboardController.php
# - resources/views/dashboard.blade.php
# - resources/views/post/show.blade.php

git add .
git commit -m "feat: implement dashboard with filtering and search"
git push origin feature/dashboard-controller
# Create Pull Request to develop
```

#### Person 2: Post Controller

```bash
git checkout -b feature/post-controller
# Work on:
# - app/Http/Controllers/PostController.php
# - resources/views/post/create.blade.php
# - resources/views/post/edit.blade.php
# - resources/views/post/my-posts.blade.php
# - resources/views/post/archive.blade.php

git add .
git commit -m "feat: implement post CRUD operations"
git push origin feature/post-controller
# Create Pull Request to develop
```

#### Person 3: Bookmark Controller

```bash
git checkout -b feature/bookmark-controller
# Work on:
# - app/Http/Controllers/BookmarkController.php
# - resources/views/bookmarks/index.blade.php

git add .
git commit -m "feat: implement bookmark functionality"
git push origin feature/bookmark-controller
# Create Pull Request to develop
```

#### Person 4: Admin Moderation

```bash
git checkout -b feature/admin-moderation
# Work on:
# - app/Http/Controllers/AdminController.php (Approve/Reject logic)
# - resources/views/admin/index.blade.php
# - resources/views/admin/reports.blade.php

git add .
git commit -m "feat: implement admin moderation and verification"
git push origin feature/admin-moderation
# Create Pull Request to develop
```

#### Person 5: Admin System & User Management

```bash
git checkout -b feature/admin-system
# Work on:
# - app/Http/Controllers/AdminController.php (User & Archive management)
# - resources/views/admin/users.blade.php
# - resources/views/admin/archive.blade.php

git add .
git commit -m "feat: implement user management and archive filters"
git push origin feature/admin-system
# Create Pull Request to develop
```

#### Person 6: Notification & Report Controllers

```bash
git checkout -b feature/notification-controller
# Work on:
# - app/Http/Controllers/NotificationController.php
# - app/Http/Controllers/ReportController.php
# - resources/views/notifications/index.blade.php
# - resources/views/reports/create.blade.php

git add .
git commit -m "feat: implement notifications and reports"
git push origin feature/notification-controller
# Create Pull Request to develop
```

### Merging Strategy

```bash
# After all features are reviewed and approved:

# 1. Merge all feature branches to develop
git checkout develop
git merge feature/dashboard-controller
git merge feature/post-controller
git merge feature/bookmark-controller
git merge feature/admin-moderation
git merge feature/admin-system
git merge feature/notification-controller

# 2. Test on develop branch
# Run tests, check for conflicts, verify functionality

# 3. Merge develop to main
git checkout main
git merge develop
git push origin main
```

## 📁 Project Structure

```
requ_tubes/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php      # Person 1
│   │       ├── PostController.php           # Person 2
│   │       ├── BookmarkController.php       # Person 3
│   │       ├── AdminController.php          # Person 4 
│   │       ├── NotificationController.php   # Person 5
│   │       └── ReportController.php         # Person 6
│   └── Models/
│       ├── User.php
│       ├── Post.php
│       ├── Bookmark.php
│       ├── Notification.php
│       └── Report.php
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_posts_table.php
│   │   ├── create_bookmarks_table.php
│   │   ├── create_notifications_table.php
│   │   └── create_reports_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── post/
│       ├── bookmarks/
│       ├── notifications/
│       ├── reports/
│       └── admin/
└── routes/
    └── web.php
```

## 🔧 Key Technologies

-   **Backend**: Laravel 11
-   **Frontend**: Blade Templates, TailwindCSS, Alpine.js
-   **Database**: MySQL
-   **Authentication**: Laravel Breeze
-   **File Storage**: Laravel Storage (public disk)

## 📝 Database Schema

### Users Table

-   id, name, email, password, role (admin/organizer/student), timestamps

### Posts Table

-   id, user_id, judul, deskripsi, kategori, poster_path, deadline, status, link_pendaftaran, pesan_admin, timestamps

### Bookmarks Table

-   id, user_id, post_id, timestamps

### Notifications Table

-   id, user_id, type, title, message, is_read, timestamps

### Reports Table

-   id, user_id, post_id, reason, status, timestamps

## 🎯 Features Checklist

-   [x] Authentication with role selection
-   [x] Dashboard with grid view
-   [x] Category filtering
-   [x] Search functionality
-   [x] Deadline sorting
-   [x] Post CRUD operations
-   [x] Image upload for posters
-   [x] Admin approval system
-   [x] Bookmark system
-   [x] Notification system
-   [x] Report system
-   [x] User management (admin)
-   [x] Archive functionality
-   [x] Responsive design

## 🤝 Contributing

1. Create a feature branch from `develop`
2. Make your changes
3. Write/update tests if needed
4. Create a Pull Request to `develop`
5. Wait for code review
6. After approval, merge to `develop`

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 👨‍💻 Development Team

-   Person 1: Dashboard & Post Detail
-   Person 2: Post Management
-   Person 3: Personalization & Profile
-   Person 4: Content Moderation (Admin)
-   Person 5: System Admin & Users (Admin)
-   Person 6: Notifications & Reports

---

**Made with ❤️ for Telyutizen**
