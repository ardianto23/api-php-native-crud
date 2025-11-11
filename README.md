 API CRUD PHP Native

Proyek ini merupakan implementasi **RESTful API sederhana** menggunakan **PHP Native** dan **MySQL**.  
Tujuan proyek ini adalah untuk menampilkan cara kerja dasar **CRUD (Create, Read, Update, Delete)** pada data `User` tanpa menggunakan framework seperti Laravel.

---

 Teknologi yang Digunakan
- **PHP 8+**
- **MySQL / MariaDB**
- **Laragon / XAMPP (Localhost)**
- **Postman** untuk pengujian API

---

 Struktur Folder

api-php-native-crud/
├── config/
│ └── Database.php
├── public/
│ ├── index.php
│ └── .htaccess
├── src/
│ ├── Controllers/
│ │ └── UserController.php
│ ├── Models/
│ │ └── User.php
│ └── Router.php
└── README.md


---

 Fitur CRUD User
| Method | Endpoint | Deskripsi |
|--------|-----------|-----------|
| **GET** | `/api/v1/users` | Ambil semua user |
| **GET** | `/api/v1/users/{id}` | Ambil user berdasarkan ID |
| **POST** | `/api/v1/users` | Tambah user baru |
| **PUT** | `/api/v1/users/{id}` | Update data user |
| **DELETE** | `/api/v1/users/{id}` | Hapus user |

---

 Struktur Database
Gunakan SQL berikut untuk membuat tabel `users`:
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

