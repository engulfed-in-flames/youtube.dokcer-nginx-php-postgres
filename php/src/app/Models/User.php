<?php

declare(strict_types=1);

namespace App\Models;

class User extends Model
{


  public function create(string $email, string $fullName, bool $isActive = true): int
  {
    $stmt = $this->db->prepare(
      "INSERT INTO users (email, full_name, is_active) 
      VALUES (:email, :full_name, :is_active)"
    );
    $stmt->execute([
      "email" => $email,
      "full_name" => $fullName,
      "is_active" => $isActive
    ]);

    return (int) $this->db->lastInsertId();
  }
}
