# Req-U System Architecture

## 🏗️ System Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                         REQ-U PLATFORM                          │
│                  Student Event & Recruitment System              │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                          USER ROLES                              │
├─────────────────────────────────────────────────────────────────┤
│  👨‍💼 ADMIN          👥 ORGANIZER          👨‍🎓 STUDENT          │
│  - Verify posts    - Create posts       - Browse posts         │
│  - Manage users    - Edit own posts     - Bookmark posts       │
│  - Handle reports  - Delete own posts   - Report posts         │
│  - View archive    - View analytics     - Register events      │
└─────────────────────────────────────────────────────────────────┘
```

## 📊 Database Schema

```
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│    USERS    │         │    POSTS    │         │  BOOKMARKS  │
├─────────────┤         ├─────────────┤         ├─────────────┤
│ id          │────┐    │ id          │    ┌────│ id          │
│ name        │    │    │ user_id     │────┤    │ user_id     │
│ email       │    └────│ judul       │    │    │ post_id     │
│ password    │         │ deskripsi   │    │    │ created_at  │
│ role        │         │ kategori    │    │    └─────────────┘
│ created_at  │         │ poster_path │    │
└─────────────┘         │ deadline    │    │    ┌─────────────┐
                        │ status      │    │    │NOTIFICATIONS│
                        │ link_pend.. │    │    ├─────────────┤
                        │ pesan_admin │    │    │ id          │
                        │ created_at  │    └────│ user_id     │
                        └─────────────┘         │ type        │
                                                │ title       │
                        ┌─────────────┐         │ message     │
                        │   REPORTS   │         │ is_read     │
                        ├─────────────┤         │ created_at  │
                        │ id          │         └─────────────┘
                        │ user_id     │
                        │ post_id     │
                        │ reason      │
                        │ status      │
                        │ created_at  │
                        └─────────────┘
```

## 🔄 Application Flow

### Student/Organizer Flow
```
┌──────────┐     ┌──────────┐     ┌──────────┐     ┌──────────┐
│ Register │────▶│  Login   │────▶│Dashboard │────▶│View Post │
│with Role │     │          │     │ (Browse) │     │ Details  │
└──────────┘     └──────────┘     └──────────┘     └──────────┘
                                        │                 │
                                        ▼                 ▼
                                   ┌──────────┐     ┌──────────┐
                                   │  Create  │     │ Bookmark │
                                   │   Post   │     │  / Report│
                                   └──────────┘     └──────────┘
                                        │
                                        ▼
                                   ┌──────────┐
                                   │  Pending │
                                   │  Review  │
                                   └──────────┘
                                        │
                        ┌───────────────┼───────────────┐
                        ▼               ▼               ▼
                   ┌─────────┐    ┌─────────┐    ┌─────────┐
                   │Approved │    │Rejected │    │ Deleted │
                   │(Public) │    │(Private)│    │(Notify) │
                   └─────────┘    └─────────┘    └─────────┘
```

### Admin Flow
```
┌──────────┐     ┌──────────┐     ┌──────────────────────────┐
│  Login   │────▶│  Admin   │────▶│  Verification Panel      │
│ as Admin │     │Dashboard │     │  - Pending Posts         │
└──────────┘     └──────────┘     │  - Approved Posts        │
                      │            │  - Rejected Posts        │
                      │            │  - Reports               │
                      │            └──────────────────────────┘
                      │                       │
                      │            ┌──────────┼──────────┐
                      │            ▼          ▼          ▼
                      │       ┌────────┐ ┌────────┐ ┌────────┐
                      │       │Approve │ │ Reject │ │ Delete │
                      │       │  Post  │ │  Post  │ │  Post  │
                      │       └────────┘ └────────┘ └────────┘
                      │            │          │          │
                      │            └──────────┼──────────┘
                      │                       ▼
                      │                  ┌──────────┐
                      │                  │  Notify  │
                      │                  │   User   │
                      │                  └──────────┘
                      ▼
              ┌───────────────┐
              │ User Management│
              │ - View Users   │
              │ - Delete Users │
              └───────────────┘
```

## 🎯 Controller Responsibilities

```
┌────────────────────────────────────────────────────────────────┐
│                    CONTROLLER ARCHITECTURE                      │
└────────────────────────────────────────────────────────────────┘

┌──────────────────────┐
│ DashboardController  │ (Person 1)
├──────────────────────┤
│ • index()            │ ──▶ Show all approved posts
│ • show($id)          │ ──▶ Show post details
│                      │
│ Features:            │
│ - Category filtering │
│ - Search             │
│ - Deadline sorting   │
│ - Pagination         │
└──────────────────────┘

┌──────────────────────┐
│   PostController     │ (Person 2)
├──────────────────────┤
│ • create()           │ ──▶ Show create form
│ • store()            │ ──▶ Save new post
│ • edit($id)          │ ──▶ Show edit form
│ • update($id)        │ ──▶ Update post
│ • destroy($id)       │ ──▶ Delete post
│ • myPosts()          │ ──▶ Show user's posts
│ • archive()          │ ──▶ Show expired posts
│                      │
│ Features:            │
│ - Image upload       │
│ - Validation         │
│ - Authorization      │
│ - Status tracking    │
└──────────────────────┘

┌──────────────────────┐
│ BookmarkController   │ (Person 3)
├──────────────────────┤
│ • toggle($postId)    │ ──▶ Add/remove bookmark
│ • index()            │ ──▶ Show bookmarks
│                      │
│ Features:            │
│ - Toggle bookmark    │
│ - List bookmarks     │
└──────────────────────┘

┌──────────────────────┐
│   AdminController    │ (Person 4)
├──────────────────────┤
│ • index()            │ ──▶ Verification panel
│ • approve($id)       │ ──▶ Approve post
│ • reject($id)        │ ──▶ Reject post
│ • users()            │ ──▶ User management
│ • deleteUser($id)    │ ──▶ Delete user
│ • reports()          │ ──▶ View reports
│ • resolveReport($id) │ ──▶ Resolve report
│ • archive()          │ ──▶ View archive
│ • deletePost($id)    │ ──▶ Delete any post
│                      │
│ Features:            │
│ - Post verification  │
│ - User management    │
│ - Report handling    │
│ - Archive filtering  │
└──────────────────────┘

┌──────────────────────┐
│NotificationController│ (Person 5)
├──────────────────────┤
│ • index()            │ ──▶ Show notifications
│ • markAsRead($id)    │ ──▶ Mark as read
│ • markAllAsRead()    │ ──▶ Mark all as read
└──────────────────────┘

┌──────────────────────┐
│  ReportController    │ (Person 5)
├──────────────────────┤
│ • create($postId)    │ ──▶ Show report form
│ • store($postId)     │ ──▶ Submit report
└──────────────────────┘
```

## 🔐 Security Layers

```
┌─────────────────────────────────────────────────────────────┐
│                      SECURITY LAYERS                         │
└─────────────────────────────────────────────────────────────┘

Layer 1: Authentication
├─ Laravel Breeze
├─ Session-based auth
└─ Password hashing (bcrypt)

Layer 2: Authorization
├─ Middleware checks
├─ Role-based access control
├─ Owner verification (edit/delete own posts)
└─ Admin-only routes

Layer 3: Input Validation
├─ Form request validation
├─ File upload validation
├─ CSRF protection
└─ XSS prevention (Blade escaping)

Layer 4: Database Security
├─ Eloquent ORM (SQL injection prevention)
├─ Foreign key constraints
└─ Cascade deletes

Layer 5: File Security
├─ Image validation (type, size)
├─ Storage in public disk
└─ Secure file naming
```

## 📱 UI Component Hierarchy

```
┌─────────────────────────────────────────────────────────────┐
│                        APP LAYOUT                            │
│  ┌───────────────────────────────────────────────────────┐  │
│  │                    NAVIGATION                          │  │
│  │  Logo | Dashboard | My Posts | Bookmarks | Archive    │  │
│  │  [Role Badge] [Notifications 🔔] [User Dropdown ▼]    │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                              │
│  ┌───────────────────────────────────────────────────────┐  │
│  │                    PAGE CONTENT                        │  │
│  │                                                         │  │
│  │  Dashboard:                                            │  │
│  │  ┌─────────┐  ┌─────────┐  ┌─────────┐               │  │
│  │  │ Post    │  │ Post    │  │ Post    │               │  │
│  │  │ Card 1  │  │ Card 2  │  │ Card 3  │               │  │
│  │  └─────────┘  └─────────┘  └─────────┘               │  │
│  │                                                         │  │
│  │  My Posts:                                             │  │
│  │  [All] [Pending] [Approved] [Rejected] ← Tabs         │  │
│  │  ┌──────────────────────────────────────┐             │  │
│  │  │ Post Item with Status Badge          │             │  │
│  │  │ [View] [Edit] [Delete]                │             │  │
│  │  └──────────────────────────────────────┘             │  │
│  │                                                         │  │
│  │  Admin Panel:                                          │  │
│  │  [Pending] [Approved] [Rejected] [Reports] ← Tabs     │  │
│  │  ┌──────────────────────────────────────┐             │  │
│  │  │ Post with Actions                     │             │  │
│  │  │ [View] [✓ Approve] [✗ Reject]        │             │  │
│  │  └──────────────────────────────────────┘             │  │
│  └───────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

## 🎨 Design System

```
┌─────────────────────────────────────────────────────────────┐
│                      COLOR PALETTE                           │
└─────────────────────────────────────────────────────────────┘

Primary Gradient:  Indigo-600 ──▶ Purple-600
                   #4F46E5        #9333EA

Status Colors:
├─ Success:  Green-600   (#16A34A)
├─ Warning:  Yellow-500  (#EAB308)
├─ Danger:   Red-600     (#DC2626)
└─ Info:     Blue-600    (#2563EB)

Category Colors:
├─ Kepanitiaan:    Blue-500    (#3B82F6)
├─ Organisasi:     Green-500   (#22C55E)
└─ Laboratorium:   Purple-500  (#A855F7)

Role Badge Colors:
├─ Admin:      Red-500     (#EF4444)
├─ Organizer:  Green-500   (#22C55E)
└─ Student:    Blue-500    (#3B82F6)

┌─────────────────────────────────────────────────────────────┐
│                     TYPOGRAPHY SCALE                         │
└─────────────────────────────────────────────────────────────┘

Headings:
├─ H1: 4xl (2.25rem) - Bold
├─ H2: 3xl (1.875rem) - Bold
├─ H3: 2xl (1.5rem) - Bold
└─ H4: xl (1.25rem) - Semibold

Body:
├─ Large: base (1rem) - Regular
├─ Normal: sm (0.875rem) - Regular
└─ Small: xs (0.75rem) - Regular

┌─────────────────────────────────────────────────────────────┐
│                     SPACING SYSTEM                           │
└─────────────────────────────────────────────────────────────┘

Padding/Margin Scale:
├─ xs:  0.5rem (8px)
├─ sm:  1rem (16px)
├─ md:  1.5rem (24px)
├─ lg:  2rem (32px)
└─ xl:  3rem (48px)

Border Radius:
├─ Small:  0.375rem (rounded-md)
├─ Medium: 0.5rem (rounded-lg)
└─ Large:  0.75rem (rounded-xl)
```

## 🔄 Data Flow

```
┌─────────────────────────────────────────────────────────────┐
│                    POST CREATION FLOW                        │
└─────────────────────────────────────────────────────────────┘

User Action          Controller              Model/DB
───────────          ──────────              ────────

[Create Post] ──▶ PostController.create() ──▶ Show Form
                                                  │
[Fill Form]                                       │
[Upload Image]                                    │
[Submit] ─────────▶ PostController.store() ──────┤
                         │                        │
                         ├─ Validate Input        │
                         ├─ Upload Image          │
                         └─ Save to DB ──────────▶ Post::create()
                                                   status: 'pending'
                                                        │
                                                        ▼
                                                   [Database]
                                                        │
Admin Reviews ◀──────────────────────────────────────┘
     │
     ├─ Approve ──▶ AdminController.approve() ──▶ Post::update()
     │                    │                         status: 'approved'
     │                    └─ Create Notification ──▶ Notification::create()
     │                                                    │
     │                                                    ▼
     │                                              User Notified
     │
     └─ Reject ───▶ AdminController.reject() ───▶ Post::update()
                        │                         status: 'rejected'
                        │                         pesan_admin: '...'
                        └─ Create Notification ──▶ Notification::create()
                                                        │
                                                        ▼
                                                  User Notified
```

## 📦 File Structure

```
requ_tubes/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php    ← Person 1
│   │   │   ├── PostController.php         ← Person 2
│   │   │   ├── BookmarkController.php     ← Person 3
│   │   │   ├── AdminController.php        ← Person 4
│   │   │   ├── NotificationController.php ← Person 5
│   │   │   └── ReportController.php       ← Person 5
│   │   └── Middleware/
│   │       └── (Laravel defaults)
│   └── Models/
│       ├── User.php
│       ├── Post.php
│       ├── Bookmark.php
│       ├── Notification.php
│       └── Report.php
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_posts_table.php
│   │   ├── create_bookmarks_table.php
│   │   ├── create_notifications_table.php
│   │   └── create_reports_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── navigation.blade.php
│       ├── dashboard.blade.php
│       ├── post/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── show.blade.php
│       │   ├── my-posts.blade.php
│       │   └── archive.blade.php
│       ├── bookmarks/
│       │   └── index.blade.php
│       ├── notifications/
│       │   └── index.blade.php
│       ├── reports/
│       │   └── create.blade.php
│       └── admin/
│           ├── index.blade.php
│           ├── users.blade.php
│           ├── reports.blade.php
│           └── archive.blade.php
│
├── routes/
│   └── web.php
│
├── public/
│   └── storage/ (symlink)
│
├── storage/
│   └── app/
│       └── public/
│           └── posters/
│
├── .env
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
├── README.md
├── GIT_WORKFLOW.md
└── PROJECT_SUMMARY.md
```

---

**This architecture ensures:**
- ✅ Clear separation of concerns
- ✅ Easy team collaboration
- ✅ Scalable and maintainable code
- ✅ Secure and robust system
- ✅ Beautiful and responsive UI
