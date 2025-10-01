<?php
require_once 'header.php';
require_once 'config.php';
require_once 'Database.php';
require_once 'Post.php';

$db = new Database();
$pdo = $db->getConnection();
$post = new Post($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $size = $_POST['size'] ?? '';
    $crust = $_POST['crust'] ?? '';
    $toppings = $_POST['toppings'] ?? [];
    $instructions = $_POST['instructions'] ?? '';

    $post->create($name, $email, $phone, $size, $crust, $toppings, $instructions);

    echo "<p class='confirmation'>Your pizza order has been received</p>";
}
?>

<main>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" name="phone">
        </div>

        <div class="form-group">
            <label for="size">Pizza Size:</label>
            <select name="size" required>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </div>

        <div class="form-group">
            <label>Crust Type:</label>
            <div class="radio-group">
                <label><input type="radio" name="crust" value="Thin" required> Thin</label>
                <label><input type="radio" name="crust" value="Thick"> Thick</label>
                <label><input type="radio" name="crust" value="Stuffed"> Stuffed</label>
            </div>
        </div>

        <div class="form-group">
            <label>Toppings:</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="toppings[]" value="Pepperoni"> Pepperoni</label>
                <label><input type="checkbox" name="toppings[]" value="Mushrooms"> Mushrooms</label>
                <label><input type="checkbox" name="toppings[]" value="Onions"> Onions</label>
                <label><input type="checkbox" name="toppings[]" value="Olives"> Olives</label>
            </div>
        </div>

        <div class="form-group">
            <label for="instructions">Special Instructions:</label>
            <textarea name="instructions" rows="4"></textarea>
        </div>

        <button type="submit">Place Order</button>
    </form>
</main>

<?php require_once 'footer.php'; ?>
