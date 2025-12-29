# 📋 Perencanaan Tim Req-U (Team Planning)

Dokumen ini berisi pembagian tugas yang jelas untuk tim pengembang yang terdiri dari 5 orang. Fokus utama adalah menyelesaikan fitur core Req-U.

---

## 👥 1. Struktur Peran & Tanggung Jawab

| Peran | Fokus Utama | PIC |
| :--- | :--- | :--- |
| **Project Manager** | Integrasi, Git Master, & Admin Panel | (Nama Anda/PIC 4) |
| **Frontend Dev 1** | Dashboard & Landing Page (Visual) | (PIC 1) |
| **Backend Dev 1** | Post Management (CRUD & Upload) | (PIC 2) |
| **Fullstack Dev 1** | Bookmark & Archive System | (PIC 3) |
| **Fullstack Dev 2** | Notification & Report System | (PIC 5) |

---

## 📅 2. Pembagian Tugas Detail (Task Division)

### **PIC 1: Dashboard & View Experience**
**Fokus**: Memastikan user nyaman mencari informasi.
- **File Utama**:
  - `app/Http/Controllers/DashboardController.php`
  - `resources/views/dashboard.blade.php`
  - `resources/views/post/show.blade.php`
- **Tugas**:
  - Implementasi Filter (Kategori, Search, Deadline).
  - Tampilan kartu postingan yang premium.
  - Halaman detail postingan lengkap.

### **PIC 2: Post & Media Engine**
**Fokus**: Mesin utama pembuatan postingan.
- **File Utama**:
  - `app/Http/Controllers/PostController.php`
  - `resources/views/post/create.blade.php`
  - `resources/views/post/edit.blade.php`
- **Tugas**:
  - Sistem Upload Gambar (Poster) dengan Drag & Drop.
  - Form validasi yang ketat.
  - Fitur Edit & Hapus postingan oleh pemilik.

### **PIC 3: Bookmark & Personalization**
**Fokus**: Fitur simpan-menyimpan untuk user.
- **File Utama**:
  - `app/Http/Controllers/BookmarkController.php`
  - `app/Models/Bookmark.php`
  - `resources/views/bookmarks/index.blade.php`
- **Tugas**:
  - Fitur "Simpan Postingan" (Toggle Bookmark).
  - Halaman daftar bookmark pribadi.
  - Sistem pengarsipan postingan lama secara otomatis.

### **PIC 4: Admin Oversight & Quality Control**
**Fokus**: Keamanan platform dan verifikasi konten.
- **File Utama**:
  - `app/Http/Controllers/AdminController.php`
  - `resources/views/admin/index.blade.php`
  - `resources/views/layouts/navigation.blade.php`
- **Tugas**:
  - Sistem Verifikasi Postingan (Approve/Reject).
  - Manajemen User.
  - Notifikasi badge angka untuk Admin di Navbar.

### **PIC 5: Communication & Safety**
**Fokus**: Interaksi antar user dan admin.
- **File Utama**:
  - `app/Http/Controllers/NotificationController.php`
  - `app/Http/Controllers/ReportController.php`
  - `resources/views/notifications/index.blade.php`
- **Tugas**:
  - Sistem Notifikasi (Real-time atau Database).
  - Sistem Pelaporan Postingan (Report) yang melanggar aturan.
  - Integrasi pesan alasan penolakan dari Admin ke User.

---

## 🛠️ 3. Alur Koordinasi (Workflow)

1.  **Senin - Selasa**: Setiap PIC mengerjakan *Logic Controller* dan *View* di branch masing-masing sesuai panduan di `GIT_WORKFLOW.md`.
2.  **Rabu**: Sesi pengetesan API menggunakan Postman (Panduan di `API_GUIDE.md`).
3.  **Kamis**: Proses *Merge* semua fitur ke branch `develop` oleh Admin (PIC 4). Semuanya harus bebas konflik!
4.  **Jumat**: *UAT (User Acceptance Testing)* bersama-sama untuk mengecek bug.

---

## 💡 Tips untuk Anggota:
- Jika bingung dengan kode teman, cek folder `brain` atau file `ARCHITECTURE.md`.
- **Komunikasi adalah kunci**: Gunakan grup chat jika ingin mengubah rute atau desain keseluruhan.
- Jangan lupa jalankan `npm run dev` saat mendesain agar Tailwind berjalan otomatis.
