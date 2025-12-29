# 📋 Perencanaan Tim Req-U (Team Planning)

Dokumen ini berisi pembagian tugas yang jelas untuk tim pengembang yang terdiri dari 6 orang. Fokus utama adalah menyelesaikan fitur core Req-U.

---

## 👥 1. Struktur Peran & Tanggung Jawab

| Peran                  | Fokus Utama                        | PIC     |
| :--------------------- | :--------------------------------- | :------ |
| **Project Manager**    | Integrasi, Git Master, & Discovery | (PIC 1) |
| **Backend Specialist** | Post Management (CRUD & Upload)    | (PIC 2) |
| **Fullstack Dev 1**    | Bookmark & Profile System          | (PIC 3) |
| **Admin Dev 1**        | Content Moderation & Reports       | (PIC 4) |
| **Admin Dev 2**        | User Management & Archive          | (PIC 5) |
| **Fullstack Dev 2**    | Notification & Feedback System     | (PIC 6) |

---

## 📅 2. Pembagian Tugas Detail (Task Division)

### **PIC 1: Dashboard & View Experience**

**Fokus**: Memastikan user nyaman mencari informasi.

-   **File Utama**:
    -   `app/Http/Controllers/DashboardController.php`
    -   `resources/views/dashboard.blade.php`
    -   `resources/views/post/show.blade.php`
-   **Tugas**:
    -   Implementasi Filter (Kategori, Search, Deadline).
    -   Tampilan kartu postingan yang premium.
    -   Halaman detail postingan lengkap.

### **PIC 2: Post & Media Engine**

**Fokus**: Mesin utama pembuatan postingan.

-   **File Utama**:
    -   `app/Http/Controllers/PostController.php`
    -   `resources/views/post/create.blade.php`
    -   `resources/views/post/edit.blade.php`
-   **Tugas**:
    -   Sistem Upload Gambar (Poster) dengan Drag & Drop.
    -   Form validasi yang ketat.
    -   Fitur Edit & Hapus postingan oleh pemilik.

### **PIC 3: Personalization & Profile Master**

**Fokus**: Fitur simpan-menyimpan dan profil user.

-   **File Utama**:
    -   `app/Http/Controllers/BookmarkController.php`
    -   `app/Http/Controllers/ProfileController.php`
    -   `resources/views/bookmarks/index.blade.php`
-   **Tugas**:
    -   Fitur "Simpan Postingan" (Toggle Bookmark).
    -   Halaman daftar bookmark pribadi.
    -   Manajemen profil user (Edit biodata, password, dll).

### **PIC 4: Content Moderator (The Admin)**

**Fokus**: Verifikasi konten dan penanganan laporan.

-   **File Utama**:
    -   `app/Http/Controllers/AdminController.php`
    -   `resources/views/admin/index.blade.php`
    -   `resources/views/admin/reports.blade.php`
-   **Tugas**:
    -   Sistem Verifikasi Postingan (Approve/Reject).
    -   Peninjauan laporan dari user (Reports Management).
    -   Fitur hapus postingan bermasalah.

### **PIC 5: System Admin & Archive**

**Fokus**: Manajemen sistem dan pengarsipan data.

-   **File Utama**:
    -   `app/Http/Controllers/AdminController.php`
    -   `resources/views/admin/users.blade.php`
    -   `resources/views/admin/archive.blade.php`
-   **Tugas**:
    -   Manajemen User (Lihat & Hapus user).
    -   Sistem pengarsipan postingan lama secara otomatis.
    -   Filter arsip berdasarkan bulan/tahun.

### **PIC 6: Communication & Feedback specialist**

**Fokus**: Interaksi antar user dan feedback platform.

-   **File Utama**:
    -   `app/Http/Controllers/NotificationController.php`
    -   `app/Http/Controllers/ReportController.php`
    -   `resources/views/notifications/index.blade.php`
    -   `resources/views/reports/create.blade.php`
-   **Tugas**:
    -   Sistem Notifikasi (Real-time atau Database).
    -   Form Pelaporan Postingan untuk user.
    -   Integrasi pesan alasan penolakan dari Admin ke User.

---

## 🛠️ 3. Alur Koordinasi (Workflow)

1.  **Senin - Selasa**: Setiap PIC mengerjakan _Logic Controller_ dan _View_ di branch masing-masing sesuai panduan di `GIT_WORKFLOW.md`.
2.  **Rabu**: Sesi pengetesan API menggunakan Postman (Panduan di `API_GUIDE.md`).
3.  **Kamis**: Proses _Merge_ semua fitur ke branch `develop` oleh Admin (PIC 4 & 5). Semuanya harus bebas konflik!
4.  **Jumat**: _UAT (User Acceptance Testing)_ bersama-sama untuk mengecek bug.

---

## 💡 Tips untuk Anggota:

-   Jika bingung dengan kode teman, cek folder `brain` atau file `ARCHITECTURE.md`.
-   **Komunikasi adalah kunci**: Gunakan grup chat jika ingin mengubah rute atau desain keseluruhan.
-   Jangan lupa jalankan `npm run dev` saat mendesain agar Tailwind berjalan otomatis.
