<?php
namespace Src\Controllers;

use PDO;

class UserController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        header('Content-Type: application/json'); // semua respons dalam JSON
    }

    // ✅ GET /api/v1/users
    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll();

        echo json_encode([
            "success" => true,
            "message" => count($users) > 0 ? "Data user ditemukan" : "Belum ada data user",
            "data" => $users
        ]);
    }

    // ✅ GET /api/v1/users/{id}
    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user) {
            echo json_encode([
                "success" => true,
                "message" => "Data user ditemukan",
                "data" => $user
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                "success" => false,
                "message" => "User tidak ditemukan"
            ]);
        }
    }

    // ✅ POST /api/v1/users
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['username'], $data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "Semua field (username, email, password) wajib diisi"
            ]);
            return;
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$data['username'], $data['email'], $hashedPassword]);

        echo json_encode([
            "success" => true,
            "message" => "User berhasil ditambahkan",
            "data" => [
                "id" => $this->pdo->lastInsertId(),
                "username" => $data['username'],
                "email" => $data['email']
            ]
        ]);
    }

    // ✅ PUT /api/v1/users/{id}
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['username'], $data['email'])) {
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "Field username dan email wajib diisi"
            ]);
            return;
        }

        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$data['username'], $data['email'], $id]);

        echo json_encode([
            "success" => true,
            "message" => "Data user berhasil diperbarui"
        ]);
    }

    // ✅ DELETE /api/v1/users/{id}
    public function destroy($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        echo json_encode([
            "success" => true,
            "message" => "User berhasil dihapus"
        ]);
    }
}
