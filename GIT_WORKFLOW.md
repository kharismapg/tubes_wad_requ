# 🐙 Git Workflow & Collaboration Guide (VSCode Ready)

Panduan ini dirancang untuk memastikan kolaborasi tim berjalan lancar tanpa konflik kode yang merusak proyek.

---

## 🛠️ 1. Persiapan Awal (Initial Setup)

### **A. Untuk Ketua Tim (The Master)**
*Lakukan ini hanya satu kali untuk membuat repositori.*

1.  **Inisialisasi Git**:
    ```powershell
    git init
    git add .
    git commit -m "chore: initial project setup"
    ```
2.  **Buat Repo di GitHub/GitLab** dan hubungkan:
    ```powershell
    git remote add origin <URL_REPO_ANDA>
    git branch -M main
    git push -u origin main
    ```
3.  **Buat Branch Utama**:
    ```powershell
    git branch develop
    git push origin develop
    ```

### **B. Untuk Anggota Tim (Collaborators)**
*Lakukan ini untuk mengambil project ke laptop masing-masing.*

1.  **Clone Project**:
    ```powershell
    git clone <URL_REPO_ANDA>
    cd requ_tubes
    ```
2.  **Install Library**:
    ```powershell
    composer install
    npm install
    ```
3.  **Setup Environment**:
    - Copy file `.env.example` menjadi `.env`
    - Jalankan:
      ```powershell
      php artisan key:generate
      php artisan migrate --seed
      php artisan storage:link
      npm run build
      ```

---

## 🌿 2. Strategi Branch (Paling Penting!)

**JANGAN PERNAH** melakukan commit langsung ke branch `main` atau `develop`.

Setiap fitur dikerjakan di branch terpisah:
- `feature/nama-fitur` (Contoh: `feature/upload-gambar`)

**Alur Kerja Harian Anggota:**
1. Update branch `develop` lokal Anda:
   ```powershell
   git checkout develop
   git pull origin develop
   ```
2. Buat branch baru untuk tugas Anda:
   ```powershell
   git checkout -b feature/tugas-saya
   ```
3. Kerjakan tugas, lalu commit:
   ```powershell
   git add .
   git commit -m "feat: menambah fitur x"
   ```
4. Push ke server:
   ```powershell
   git push origin feature/tugas-saya
   ```

---

## 🛡️ 3. Menghindari & Mengatasi Konflik (Push/Pull)

### **Cara Menghindari Konflik**
- **Selalu Pull** sebelum mulai kerja.
- **Komunikasi**: Kabari teman jika Anda mengubah file yang "berbahaya" (seperti `routes/web.php` atau `navigation.blade.php`).
- **Pintar Membagi Tugas**: Usahakan setiap orang memegang file yang berbeda.

### **Cara Mengatasi Konflik di VSCode**
Jika saat melakukan `git merge` atau `git pull` muncul pesan "Merge Conflict":

1.  Buka VSCode. File yang konflik akan berwarna merah.
2.  Di dalam file tersebut, Anda akan melihat pilihan di bagian atas kode yang bentrok:
    - **Accept Current Change**: Ambil kode versi Anda.
    - **Accept Incoming Change**: Ambil kode versi teman Anda.
    - **Accept Both Changes**: Ambil dua-duanya (Biasanya ini yang dipilih untuk file `routes` atau `navigation`).
3.  Simpan file, lalu akhiri dengan:
    ```powershell
    git add .
    git commit -m "fix: resolve merge conflict"
    ```

---

## ✅ 4. Standar Pesan Commit
Gunakan format ini agar history git rapi:
- `feat:` Untuk fitur baru (Contoh: `feat: halaman dashboard`)
- `fix:` Untuk perbaikan bug (Contoh: `fix: error upload gambar`)
- `docs:` Untuk perubahan dokumen (Contoh: `docs: update panduan git`)
- `style:` Untuk tampilan/CSS (Contoh: `style: perbaiki margin tombol`)

---

## 🚀 5. Checklist Sebelum Selesai
- [ ] Apakah saya sudah `git pull` dari `develop`?
- [ ] Apakah `npm run build` berhasil tanpa error?
- [ ] Apakah saya sudah menghapus `console.log` atau kode tes yang tidak perlu?
