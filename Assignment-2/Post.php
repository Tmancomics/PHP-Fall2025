<?php
class Post {
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $email, $phone, $size, $crust, $toppings, $instructions) {
        $sql = "INSERT INTO orders (name, email, phone, size, crust, toppings, instructions)
                VALUES (:name, :email, :phone, :size, :crust, :toppings, :instructions)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":phone" => $phone,
            ":size" => $size,
            ":crust" => $crust,
            ":toppings" => implode(', ', $toppings),
            ":instructions" => $instructions
        ]);
    }
}
?>
