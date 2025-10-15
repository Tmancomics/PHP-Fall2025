<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/Database.php';
include 'includes/header.php';

$db = new Database();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $bio = htmlspecialchars($_POST['bio']);
    $image = $_FILES['image'];

    if ($email && $image['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/images/";
        $imageName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "", basename($image["name"]));
        $imagePath = $targetDir . $imageName;

        if (move_uploaded_file($image["tmp_name"], $imagePath)) {
            $stmt = $conn->prepare("INSERT INTO user_profiles (name, email, bio, image_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $bio, $imagePath]);
            echo "<p>Profile created successfully!</p>";
        } else {
            echo "<p>Image upload failed.</p>";
        }
    } else {
        echo "<p>Invalid email or image upload error.</p>";
    }
}

// Always show profiles, even if form submission fails
try {
    $stmt = $conn->query("SELECT * FROM user_profiles ORDER BY created_at DESC");
    $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>All Profiles</h2><div class='profiles'>";
    foreach ($profiles as $profile) {
        echo "<div class='card'>
                <img src='{$profile['image_path']}' alt='Profile Image'>
                <h3>{$profile['name']}</h3>
                <p>{$profile['email']}</p>
                <p>{$profile['bio']}</p>
              </div>";
    }
    echo "</div>";
} catch (PDOException $e) {
    echo "<p>Database query error: " . $e->getMessage() . "</p>";
}

include 'includes/footer.php';
?>