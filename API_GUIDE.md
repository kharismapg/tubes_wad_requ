# 🚀 Postman API Testing Guide - Req-U

Panduan ini berisi langkah-langkah untuk menghubungkan Postman dengan aplikasi Laravel Req-U untuk keperluan testing API dan penjelasan rute yang tersedia.

---

## 🛠️ 1. Persiapan Awal

### **A. Jalankan Aplikasi**
Pastikan server Laravel sudah berjalan:
```powershell
php artisan serve
```
Base URL: `http://127.0.0.1:8000` (atau sesuai konfigurasi Laragon Anda).

### **B. Headers Wajib**
Di Postman, pada tab **Headers**, selalu tambahkan:
- `Accept`: `application/json`

Ini memastikan Laravel mengirim error dalam format JSON, bukan halaman HTML.

---

## 🔗 2. Penjelasan Konfigurasi Penting

### **A. CSRF Protection (Penting!)**
Laravel memproteksi rute `POST`, `PUT`, dan `DELETE` dari serangan CSRF. Di Laravel 11, pengecualian rute diatur di `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->validateCsrfTokens(except: [
        'api/*',
        'post/store', // Rute ini bisa dipanggil di Postman tanpa Token CSRF
    ]);
})
```
> [!NOTE]
> Jika Anda ingin mengetes rute lain (seperti bookmark atau delete) tanpa ribet mengurus token, tambahkan rutenya ke daftar `except` di atas.

### **B. Authentication (Middleware 'auth')**
Hampir semua rute di aplikasi ini dibungkus middleware `auth`.
- **Cara di Postman:** Anda harus melakukan Login terlebih dahulu di browser agar session tersimpan di cookie. Postman secara otomatis akan menggunakan cookie tersebut jika berjalan di domain yang sama.
- Jika tetap terkena redirect ke halaman login, pastikan rute tersebut tidak memerlukan session baru.

---

## 📡 3. Daftar Endpoint untuk Testing

Berikut adalah rute-rute utama yang sering digunakan:

### **A. Post Management**
| Method | Endpoint | Deskripsi | Status CSRF |
| :--- | :--- | :--- | :--- |
| `GET` | `/dashboard` | Mengambil semua postingan | ✅ Aman |
| `GET` | `/my-posts` | Postingan milik user yang login | ✅ Aman |
| `POST` | `/post/store` | Membuat postingan baru | 🔓 Di-bypass |
| `GET` | `/post/{id}` | Detail postingan spesifik | ✅ Aman |
| `DELETE` | `/post/{id}` | Menghapus postingan | 🛑 Butuh bypass/token |

### **B. Interaksi (Action)**
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `POST` | `/bookmark/{id}` | Toggle bookmark (Simpan/Hapus) |
| `POST` | `/report/{postId}` | Melaporkan postingan bermasalah |
| `POST` | `/notifications/read-all` | Menandai semua notif sudah dibaca |

### **C. Admin Panel**
*(Memerlukan akun dengan role Admin)*
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/admin` | Dashboard Admin |
| `POST` | `/admin/{id}/approve` | Menyetujui postingan |
| `POST` | `/admin/{id}/reject` | Menolak postingan |

---

## 📤 4. Contoh Request POST (Store Post)
- **Method**: `POST`
- **URL**: `{{base_url}}/post/store`
- **Body** -> **form-data**:
  - `judul`: (text) `Lomba UI/UX`
  - `kategori`: (text) `Lomba`
  - `deskripsi`: (text) `Detail deskripsi...`
  - `deadline`: (date) `2025-12-31`
  - `poster`: (file) Pilih gambar poster

---

## 🛡️ 5. Tips Debugging
1. **419 Page Expired**: Berarti rute tsb butuh CSRF Token tapi belum masuk daftar `except` di `bootstrap/app.php`.
2. **401 Unauthorized**: Berarti Anda belum login atau session di Postman sudah habis.
3. **404 Not Found**: Cek kembali typo di URL atau jalankan `php artisan route:list` untuk memastikan rute terdaftar.
